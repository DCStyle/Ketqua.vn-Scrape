<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CacheService;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(CacheService $cacheService)
    {
        return view('admin.dashboard', [
            'cacheSize' => $cacheService->getTotalCacheSize(),
            'lastCacheUrl' => $cacheService->getLastCacheUrl(),
            'lastCacheTime' => $cacheService->getLastCacheTime()
        ]);
    }
}
