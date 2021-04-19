<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Maincontroller;
use App\Http\Controllers\Admincontroller;


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

/*______________Home___________________*/

Route::get('/', function () {
    return view('welcome');
});


/*______________user___________________*/
Route::get('User/signup', function () {
    return view('User.signup');
})->name('usersignup');


Route::get('User/forgotpass', function () {
    return view('User.forgotpass');
})->name('userforgotpass');


Route::post('User/save', [Maincontroller::class, 'save'])->name('user.save');
Route::post('User/check', [Maincontroller::class, 'check'])->name('user.check');
Route::get('User/Logout', [Maincontroller::class, 'logoutuser'])->name('user.logoutuser');
Route::post('User/forgotpass', [Maincontroller::class, 'password'])->name('user.password');
Route::get('User/reset-password/{token}', [Maincontroller::class, 'resetpassword'])->name('user.reset-password');
Route::post('User/reset-password', [Maincontroller::class, 'resetnewpassword'])->name('user.resetnewpassword');

Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('User/login', function () {
        return view('User.login');
    })->name('userlogin');



    Route::get('User/Dashboard', [Maincontroller::class, 'dashboard'])->name('user.dashboard');
    Route::get('User/edit/{id}', [Maincontroller::class, 'edit']);
    Route::post('User/edit/{id}', [Maincontroller::class, 'update']);
    Route::get('User/delete/{id}', [Maincontroller::class, 'delete']);
    Route::get('User/Add', [Maincontroller::class, 'add'])->name('user.add');
    Route::post('User/Addnewcar', [Maincontroller::class, 'addnewcar'])->name('user.addnewcar');
    Route::get('User/info', [Maincontroller::class, 'myinfo'])->name('user.myinfo');
    Route::post('User/Newinfo', [Maincontroller::class, 'newinfo'])->name('user.newinfo');
    Route::post('User/Newpass', [Maincontroller::class, 'newpass'])->name('user.newpass');
});



/*______________Admin___________________*/
Route::get('Admin/login', function () {
    return view('Admin.login');
})->name('adminlogin');

Route::group(['middleware' => ['AdminCheck']], function () {
Route::post('Admin/check', [Admincontroller::class, 'check'])->name('admin.check');
Route::post('Admin/changeStatus', [Admincontroller::class, 'changeStatus'])->name('admin.changeStatus');
Route::get('Admin/Logout', [Admincontroller::class, 'logoutadmin'])->name('admin.logout');
Route::get('Admin/Dashboard', [Admincontroller::class, 'dashboard'])->name('Admin.dashboard');
Route::get('Admin/delete/{id}', [Admincontroller::class, 'delete']);

});

