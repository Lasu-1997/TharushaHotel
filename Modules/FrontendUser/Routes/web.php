<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\FrontendUser\Http\Controllers\FrontendUserController;
use Modules\SystemCore\Http\Controllers\BlogController;
use Modules\SystemCore\Http\Controllers\BookingController;
use Modules\SystemCore\Http\Controllers\GalleryController;
use Modules\SystemCore\Http\Controllers\RoomsController;
use Modules\SystemCore\Http\Controllers\SystemCoreController;
use Modules\SystemCore\Http\Controllers\UserController;

Route::get('/', [FrontendUserController::class, 'index'])->name('frontenduser.index');
Route::get('/about', [FrontendUserController::class, 'about'])->name('frontenduser.about');
Route::get('/accomodation', [FrontendUserController::class, 'accomodation'])->name('frontenduser.accomodation');
Route::get('/gallery', [FrontendUserController::class, 'gallery'])->name('frontenduser.gallery');
Route::get('/contact', [FrontendUserController::class, 'contact'])->name('frontenduser.contact');
Route::get('/blog', [FrontendUserController::class, 'blog'])->name('frontenduser.blog');
Route::get('/blog/{slug}', [FrontendUserController::class, 'blogSingle'])->name('frontenduser.blogSingle');


Route::post('/check-availability', [BookingController::class, 'checkAvailability'])
    ->name('booking.checkAvailability');


Route::prefix('accomodation')->group(function () {
    Route::get('/{slug}', [FrontendUserController::class, 'acomodationSingle'])
        ->name('frontenduser.acomodationSingle');
});


Route::prefix('accomodation')->middleware(['auth'])->group(function () {
    Route::get('/{slug}/book-accomodation', [FrontendUserController::class, 'bookAccomodation'])
        ->name('frontenduser.bookAccomodation');
    Route::post('/{slug}/book-accomodation', [BookingController::class, 'userCreate'])
        ->name('booking.store');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [SystemCoreController::class, 'dashboard'])->name('dashboard');

    Route::prefix('bookings')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('booking');
        Route::get('/{id}', [BookingController::class, 'viewBooking'])->name('booking.viewBooking');
        Route::get('/{id}/admin-approve', [BookingController::class, 'adminApprove'])->name('booking.adminApprove');
        Route::get('/{id}/admin-decline', [BookingController::class, 'adminDecline'])->name('booking.adminDecline');
        Route::get('/{id}/admin-mark-as-paid', [BookingController::class, 'markAsPaid'])->name('booking.markAsPaid');
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin-hold-booking', [BookingController::class, 'adminHoldBookingsIndex'])->name('booking.adminHoldBookingsIndex');
        Route::get('/create-admin-hold-booking', [BookingController::class, 'adminHoldBookingsCreate'])->name('booking.adminHoldBookingsCreate');
        Route::post('/admin-hold-booking', [BookingController::class, 'adminHoldBookingsStore'])->name('booking.adminHoldBookingsStore');
        Route::get('/admin-remove-booking-hold/{id}', [BookingController::class, 'destroyBookingHoldDate'])->name('booking.destroyBookingHoldDate');
        Route::get('/admin-create-booking', [BookingController::class, 'adminCreate'])->name('booking.adminCreate');
        Route::post('/admin-store-booking', [BookingController::class, 'adminStore'])->name('booking.adminStore');

        Route::prefix('room_category')->group(function () {
            Route::get('/', [RoomsController::class, 'index'])->name('room_category');
            Route::get('/create', [RoomsController::class, 'create'])->name('room_category.create');
            Route::get('/{slug}/images', [RoomsController::class, 'roomCategoryImages'])->name('room_category.roomCategoryImages');
            Route::post('/{slug}/update_images', [RoomsController::class, 'roomCategoryUpdateImages'])->name('room_category.roomCategoryUpdateImages');
            Route::get('/{id}/delete_image', [RoomsController::class, 'roomCategoryDeleteImage'])->name('room_category.roomCategoryDeleteImage');
            Route::post('/store', [RoomsController::class, 'store'])->name('room_category.store');
            Route::get('/{slug}/edit', [RoomsController::class, 'edit'])->name('room_category.edit');
            Route::post('/{slug}/update', [RoomsController::class, 'update'])->name('room_category.update');
            Route::post('/{slug}/add_feature', [RoomsController::class, 'addRoomCategoryFeature'])->name('room_category.addRoomCategoryFeature');
            Route::get('/{id}/delete_feature', [RoomsController::class, 'deleteRoomCategoryFeature'])->name('room_category.deleteRoomCategoryFeature');
            Route::get('/{id}/delete', [RoomsController::class, 'destroy'])->name('room_category.destroy');
        });

        Route::prefix('admin-blog')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('blog');
            Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
            Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
            Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
            Route::post('/{id}/update', [BlogController::class, 'update'])->name('blog.update');
            Route::get('/{id}/delete', [BlogController::class, 'destroy'])->name('blog.destroy');
            Route::get('/{id}/toggle_publish', [BlogController::class, 'togglePublish'])->name('blog.togglePublish');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('/{id}/delete', [UserController::class, 'usersDestroy'])->name('users.destroy');
        });

        Route::get('/gallery_images', [GalleryController::class, 'editGallery'])->name('editGallery');
        Route::post('/update_images', [GalleryController::class, 'updateGallery'])->name('updateGallery');
        Route::get('/{id}/delete_image', [GalleryController::class, 'deleteGalleryImage'])->name('deleteGalleryImage');

        Route::get('/site_preferences', [SystemCoreController::class, 'sitePreferences'])->name('site_preferences');
        Route::post('/site_preferences', [SystemCoreController::class, 'updateSitePreferences'])->name('site_preferences.update');
    });
});
