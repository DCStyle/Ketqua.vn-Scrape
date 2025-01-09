<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Redirect to Dashboard
    Route::redirect('/', '/admin/dashboard');

    // Article Management
    Route::resource('articles', ArticleController::class);

    // Settings
    Route::controller(SettingsController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings');
        Route::put('/settings', 'update')->name('settings.update');
    });

    // Users Management
    Route::resource('users', UserController::class)->except(['show']);

    // Menu Management
    Route::resource('menus', MenuController::class)->except(['show']);
    Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');

    // Footer Management
    Route::prefix('footer')->controller(FooterController::class)->name('footer.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/column', 'storeColumn')->name('column.store');
        Route::post('/column/{column}/item', 'storeColumnItem')->name('column.item.store');
        Route::post('/setting', 'updateSetting')->name('setting.update');

        // AJAX routes
        Route::post('/column/update-order', 'updateColumnOrder')->name('column.updateOrder');
        Route::post('/item/update-order', 'updateItemOrder')->name('item.updateOrder');
        Route::post('/item/update-parent', 'updateItemParent')->name('item.updateParent');
        Route::post('/update', 'updateFooter')->name('update');
        Route::delete('/delete', 'deleteFooter')->name('delete');
    });
});

// Articles
Route::get('/tin-tuc', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/tin-tuc/{article:slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Images
Route::post('images/upload', [ImageController::class, 'store'])->name('images.upload');

// Proxy
Route::any('/proxy/{url}', [\App\Http\Controllers\ProxyController::class, 'handle'])->where('url', '.*');

// Content
Route::match(['get', 'post'], '/do-ve-so', [\App\Http\Controllers\CheckLotteryTicketController::class, 'checkTicket'])
    ->name('lottery.check-ticket');

Route::get('/{path?}', [ContentController::class, 'show'])->where('path', '.*')->name('content.show');
