<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptimizeImages
{
    /**
     * Handle an incoming request.
     * 
     * This middleware adds headers and response headers for image optimization.
     * For production, consider using:
     * - Image CDN (Cloudflare, imgix, cloudinary)
     * - WebP/AVIF format conversion
     * - Responsive images with srcset
     * - Lazy loading with loading="lazy"
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add caching headers for images
        if ($this->isImageRequest($request)) {
            // Cache images for 1 year (immutable assets)
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
            
            // Add Vary header for content negotiation
            $response->headers->set('Vary', 'Accept');
            
            // Add image optimization headers
            $response->headers->set('X-Content-Type-Options', 'nosniff');
        }

        return $response;
    }

    /**
     * Check if the request is for an image
     */
    protected function isImageRequest(Request $request): bool
    {
        $path = $request->getPathInfo();
        
        // Check if path is in storage/images or public/images
        if (str_contains($path, '/storage/') || str_contains($path, '/images/')) {
            // Check file extension
            $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif', 'svg', 'ico'];
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            
            return in_array($extension, $extensions);
        }
        
        return false;
    }
}
