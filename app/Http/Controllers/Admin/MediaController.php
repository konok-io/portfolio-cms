<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query();
        
        // Filter by type
        if ($request->filled('type')) {
            $type = $request->type;
            if ($type === 'image') {
                $query->where('mime_type', 'like', 'image/%');
            } elseif ($type === 'video') {
                $query->where('mime_type', 'like', 'video/%');
            } elseif ($type === 'document') {
                $query->where('mime_type', 'application/pdf');
            }
        }
        
        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $media = $query->orderBy('created_at', 'desc')->paginate(24);
        
        return view('admin.media.index', compact('media'));
    }
    
    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => ['required', 'file', 'max:10240'], // 10MB max per file
        ]);
        
        $uploaded = [];
        
        foreach ($request->file('files') as $file) {
            $path = $file->store('media', 'public');
            $originalName = $file->getClientOriginalName();
            $name = pathinfo($originalName, PATHINFO_FILENAME);
            
            $media = Media::create([
                'name' => $name,
                'file_name' => $originalName,
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
            
            $uploaded[] = $media;
        }
        
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => count($uploaded) . ' file(s) uploaded successfully.',
                'media' => $uploaded,
            ]);
        }
        
        return back()->with('success', count($uploaded) . ' file(s) uploaded successfully.');
    }
    
    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:500'],
        ]);
        
        $media->update($validated);
        
        return back()->with('success', 'Media updated successfully.');
    }
    
    public function destroy(Media $media)
    {
        $media->deleteFile();
        $media->delete();
        
        return back()->with('success', 'Media deleted successfully.');
    }
    
    public function getLibrary()
    {
        $media = Media::orderBy('created_at', 'desc')->limit(50)->get();
        
        return response()->json($media);
    }
}
