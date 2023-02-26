<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\GuestRegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();

//*********** Backend Route Start ***********

// Dashboard page view
Route::get('/home', [HomeController::class, 'index'])->name('home');

//User
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/user/delete/{user_idta}', [UserController::class, 'user_delete'])->name('user.delete');
Route::get('/edit/profile', [UserController::class, 'profile_edit'])->name('profile.edit');
Route::post('/update/profile', [UserController::class, 'update_profile'])->name('update.profile');
Route::post('/photo/update', [UserController::class, 'photo_update'])->name('photo.update');
Route::post('/user/delete/check', [UserController::class, 'delete_check'])->name('delete.check');
Route::get('/trashuser', [UserController::class, 'trash'])->name('trash');
Route::get('/user/restore/{user_idta}', [UserController::class, 'user_restore'])->name('user.restore');
Route::get('/user/delete/hard/{userhard_idta}', [UserController::class, 'user_hard_delete'])->name('user.delete.hard');
Route::post('/user/delete_parmanent/check', [UserController::class, 'delete_parmanent_check'])->name('delete_parmanent.check');

//category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{cat_del_idta}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/edit/{cat_edit_idta}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');

//Tag
Route::get('/tags', [TagController::class, 'tag'])->name('tag');
Route::post('/tag/store', [TagController::class, 'tag_store'])->name('tag.store');
Route::get('/tag/delete/{tag_del_idta}', [TagController::class, 'tag_delete'])->name('tag.delete');

//Role
Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/remove/role/{user_idta}', [RoleController::class, 'remove_role'])->name('remove.role');
Route::get('/edit/rolewith_permission/{user_idta}', [RoleController::class, 'edit_rolewith_permission'])->name('edit.rolewith_permission');
Route::post('/permission/update', [RoleController::class, 'permission_update'])->name('permission.update');

// Post
Route::get('/add/post/new', [PostController::class, 'add_post'])->name('add.post');
Route::post('/blog/post/store', [PostController::class, 'post_store'])->name('post.store');
Route::get('/mypost', [PostController::class, 'my_post'])->name('my.post');
Route::get('/post/view/{post_idta}', [PostController::class, 'post_view'])->name('post.view');
Route::get('/post/delete/{post_idta}', [PostController::class, 'post_delete'])->name('post.delete');
Route::get('/post/edit/{post_idta}', [PostController::class, 'post_edit'])->name('post.edit');
Route::post('/post/update', [PostController::class, 'post_update'])->name('post.update');
Route::get('/all/postpage', [PostController::class, 'all_post'])->name('all.post');
//*********** Backend Route End ***********

//*********** Fontend Route Start ***********

//Home Page Content
Route::get('/', [FrontendController::class, 'welcome'])->name('index');
Route::get('category/post/{category_idta}', [FrontendController::class, 'category_post'])->name('category.post');
Route::get('author/post/{author_idta}', [FrontendController::class, 'author_post'])->name('author.post');
Route::get('author/list', [FrontendController::class, 'author_list'])->name('author.list');
Route::get('post/details/{slug}', [FrontendController::class, 'post_details'])->name('post.details');

// Guest Register page view
Route::get('/guest/register', [GuestRegisterController::class, 'guest_register'])->name('guest.register');
Route::get('/guest/login', [GuestRegisterController::class, 'guest_login'])->name('guest.login');

//Guest Register Request
Route::post('/guest/register/store', [GuestRegisterController::class, 'guest_register_store'])->name('guest.register.store');

//Guset Login Request
Route::post('/guest/login/request', [GuestLoginController::class, 'guest_login_request'])->name('guest.login.request');

// Guest Logout
Route::get('/guest/logout',[GuestLoginController::class, 'guest_logout'])->name('guest.logout');

//github login
Route::get('/github/redirect', [GithubController::class, 'redirect_provider'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'provider_to_application'])->name('github.callback');

//Google login
Route::get('/google/redirect', [GoogleController::class, 'redirect_provider'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'provider_to_application'])->name('google.callback');

//Guest Password Reset Page view
Route::get('/guest/pass/reset/req', [GuestController::class, 'guest_pass_reset_req'])->name('guest.pass.reset.req');
//Guest Password Reset message send
Route::post('/guest/pass/reset/req/send', [GuestController::class, 'guest_pass_reset_req_send'])->name('guest.pass.reset.req.send');
//Guest Password Reset and new password Page view
Route::get('/guest/pass/reset/form/{tokenta}', [GuestController::class, 'guest_pass_reset_form'])->name('guest.pass.reset.form');
//Guest Password Reset form data pass_reset_form.blade.php
Route::post('/guest/pass/reset', [GuestController::class, 'guest_pass_reset'])->name('guest.pass.reset');


//Email Verify
Route::get('/verify/mail/confirm/{token}', [GuestRegisterController::class, 'verify_mail'])->name('verify.mail.confirm');

// Verify korte vole gese
Route::get('/verify/mail/req', [GuestRegisterController::class, 'mail_verify_req'])->name('mail.verify.req');
Route::post('/verify/mail/again', [GuestRegisterController::class, 'mail_verify_again'])->name('mail.verify.again');
//*********** Fontend Route End ***********
