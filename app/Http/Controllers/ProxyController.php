<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProxyController extends Controller
{
    public function handle(Request $request, $url)
    {
        $targetUrl = base64_decode($url);
        $method = $request->method();

        $postData = $request->all();

        $response = Http::withHeaders([
            'Accept' => '*/*',
            'Accept-Language' => 'en-US,en;q=0.9,vi;q=0.8',
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Origin' => parse_url($targetUrl, PHP_URL_SCHEME) . '://' . parse_url($targetUrl, PHP_URL_HOST),
            'Pragma' => 'no-cache',
            'Referer' => $targetUrl,
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36',
            'X-Requested-With' => 'XMLHttpRequest',
            'Cookie' => 'SID=1v4g8moi8mvk0k31p8i1pd3cv2'
        ])
            ->withOptions([
                'allow_redirects' => true,
                'verify' => false
            ]);

        try {
            if ($method === 'GET') {
                $response = $response->get($targetUrl, $postData);
            } else {
                $formData = $request->getContent();
                $response = $response->withBody($formData, 'application/x-www-form-urlencoded')
                    ->post($targetUrl);
            }

            return $response->body();
        } catch (\Exception $e) {
            Log::error('Proxy Error:', [
                'message' => $e->getMessage()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
