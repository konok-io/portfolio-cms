<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class BackupController extends Controller
{
    protected $backupPath;

    public function __construct()
    {
        $this->backupPath = storage_path('app/backups');
        
        if (!File::exists($this->backupPath)) {
            File::makeDirectory($this->backupPath, 0755, true);
        }
    }

    public function index()
    {
        $backups = $this->getBackupList();
        $diskUsed = $this->getDiskUsage();
        
        return view('admin.backup.index', compact('backups', 'diskUsed'));
    }

    public function create()
    {
        try {
            $filename = 'backup-' . Carbon::now()->format('Y-m-d-H-i-s') . '.sql';
            $filepath = $this->backupPath . '/' . $filename;

            // Get database connection config
            $connection = config('database.default');
            $host = config("database.connections.{$connection}.host");
            $port = config("database.connections.{$connection}.port");
            $database = config("database.connections.{$connection}.database");
            $username = config("database.connections.{$connection}.username");
            $password = config("database.connections.{$connection}.password");

            // Try mysqldump
            $mysqldump = env('MYSQL_DUMP_PATH', 'mysqldump');
            $command = sprintf(
                '%s --user=%s --password=%s --host=%s --port=%s %s > %s 2>&1',
                $mysqldump,
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($database),
                escapeshellarg($filepath)
            );

            exec($command, $output, $returnCode);

            // Fallback if mysqldump fails
            if ($returnCode !== 0 || !file_exists($filepath) || filesize($filepath) === 0) {
                $this->createSimpleBackup($filepath);
            }

            // Compress the backup
            $compressedPath = $filepath . '.gz';
            if (file_exists($filepath)) {
                $gzipCommand = "gzip -c " . escapeshellarg($filepath) . " > " . escapeshellarg($compressedPath);
                exec($gzipCommand);
                if (file_exists($compressedPath)) {
                    unlink($filepath);
                    $filepath = $compressedPath;
                }
            }

            return redirect()->route('admin.backup.index')
                ->with('success', 'Backup created successfully!');

        } catch (\Exception $e) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }

    protected function createSimpleBackup($filepath)
    {
        $connection = config('database.default');
        $database = config("database.connections.{$connection}.database");
        
        $sql = "-- Database Backup\n";
        $sql .= "-- Database: {$database}\n";
        $sql .= "-- Generated: " . Carbon::now()->format('Y-m-d H:i:s') . "\n\n";
        
        $tables = DB::select('SHOW TABLES');
        $tableKey = 'Tables_in_' . $database;
        
        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
            if (!empty($createTable)) {
                $sql .= "\n\n" . $createTable[0]->{'Create Table'} . ";\n\n";
            }
            
            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $values = [];
                foreach ((array)$row as $value) {
                    $values[] = $value !== null ? "'" . addslashes($value) . "'" : 'NULL';
                }
                $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(', ', $values) . ");\n";
            }
        }
        
        file_put_contents($filepath, $sql);
    }

    public function download($filename)
    {
        $filepath = $this->backupPath . '/' . $filename;
        
        if (!file_exists($filepath)) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'Backup file not found!');
        }

        return Response::download($filepath, $filename, [
            'Content-Type' => 'application/octet-stream',
        ]);
    }

    public function destroy($filename)
    {
        $filepath = $this->backupPath . '/' . $filename;
        
        if (!file_exists($filepath)) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'Backup file not found!');
        }

        unlink($filepath);

        return redirect()->route('admin.backup.index')
            ->with('success', 'Backup deleted successfully!');
    }

    public function downloadAll()
    {
        $backups = $this->getBackupList();
        
        if ($backups->isEmpty()) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'No backups available!');
        }

        $zipFilename = 'backups-' . Carbon::now()->format('Y-m-d') . '.zip';
        $zipPath = storage_path('app/' . $zipFilename);
        
        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($backups as $backup) {
                $filepath = $this->backupPath . '/' . $backup['filename'];
                if (file_exists($filepath)) {
                    $zip->addFile($filepath, $backup['filename']);
                }
            }
            $zip->close();
        }

        return Response::download($zipPath, $zipFilename, [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }

    protected function getBackupList()
    {
        $files = File::files($this->backupPath);
        
        $backups = collect($files)->map(function ($file) {
            return [
                'filename' => $file->getFilename(),
                'size' => $file->getSize(),
                'size_formatted' => $this->formatBytes($file->getSize()),
                'created' => Carbon::createFromTimestamp($file->getMTime()),
                'created_formatted' => Carbon::createFromTimestamp($file->getMTime())->format('M d, Y H:i'),
            ];
        })->sortByDesc('created')->values();

        return $backups;
    }

    protected function getDiskUsage()
    {
        $totalSize = 0;
        $files = File::files($this->backupPath);
        
        foreach ($files as $file) {
            $totalSize += $file->getSize();
        }
        
        return [
            'count' => count($files),
            'total' => $this->formatBytes($totalSize),
        ];
    }

    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
