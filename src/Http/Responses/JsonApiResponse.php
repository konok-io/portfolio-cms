<?php

declare(strict_types=1);

namespace Mrh\License\Http\Responses;

use Illuminate\Http\JsonResponse;

/**
 * Canonical JSON envelope for the client package's local endpoints.
 * Mirrors the server's shape so consumers see one consistent contract:
 * { success, data, error:{code,message,details}, server_time }.
 */
class JsonApiResponse
{
    public static function success(array $data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'success'     => true,
            'data'        => $data,
            'error'       => null,
            'server_time' => now()->toIso8601String(),
        ], $status);
    }

    public static function error(
        string $code,
        string $message,
        array $details = [],
        int $status = 422,
    ): JsonResponse {
        return response()->json([
            'success'     => false,
            'data'        => null,
            'error'       => [
                'code'    => $code,
                'message' => $message,
                'details' => $details === [] ? null : $details,
            ],
            'server_time' => now()->toIso8601String(),
        ], $status);
    }
}
