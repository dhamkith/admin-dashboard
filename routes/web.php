<?php

use Illuminate\Support\Facades\Route;

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
/* ContactUSController controller*/
Route::get('/contact', 'ContactUSController@contact')
    ->name('contact');

Route::post('/contact', 'ContactUSController@contactStore')
    ->name('contact.store');

Route::post('/contact/destroy', 'ContactUSController@contactDestroy')
    ->name('contact.destroy');
    
Route::view('/', 'welcome');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');


/* if role permission "change_password" User can change password*/
Route::get('/user/password', 'HomeController@password')
    ->name('user.password');
    // ->middleware('can:change_password');

Route::put('/user/password', 'HomeController@changePassword')
    ->name('user.change.password');
    // ->middleware('can:change_password');

/* if role permission "update_profile" User can update profile*/
Route::get('/profile/{id}','profileController@profileEdit')
    ->name('profile.edit');
    // ->middleware('can:update_profile');
    
/* if role permission "update_profile" User can update profile*/
Route::put('/profile/update/{id}','profileController@update')
    ->name('profile.update');
    // ->middleware('can:update_profile');

/* user route message*/
Route::get('/user/inbox', 'HomeController@inbox')
    ->name('user.message.inbox');
Route::get('/inbox/message/show/{id}', 'HomeController@userMessageShow')
    ->name('user.message.show');
Route::post('/user/message/markasdelete', 'HomeController@userMessagemarkAsDelete')
    ->name('user.message.markasdelete');

// user_send_messages
Route::get('/send-messages/create', 'HomeController@sendCreate')
    ->name('user.send.message.create');
Route::get('/send-messages', 'HomeController@send')
    ->name('user.send.messages');
Route::post('/send-messages/store', 'HomeController@sendMessageStore')
    ->name('user.send.message.store');
Route::get('/send-messages/show/{id}', 'HomeController@sendShow')
    ->name('user.send.message.show');
Route::post('/send-messages/destroy/selected', 'HomeController@destroySelectUserSendMessage')
    ->name('send.messages.destroy.selected');

/* user notifications */
Route::get('/notifications', 'HomeController@notifications')
    ->name('user.notifications');
Route::get('/notification/{id}', 'HomeController@notificationShow')
    ->name('user.notification.show'); 
Route::post('/notification/delete/selected', 'HomeController@destroySelectNotification')
    ->name('user.notification.delete.selected');

/* notifications message-views*/ 
Route::get('/well-come/user_id={id}', 'HomeController@wellComeMessage')
    ->name('user.wellcome');

Route::prefix('manage')->group( function() { 
    Route::get('/users', 'ManageController@users')
        ->name('manage.all.users'); 
    Route::post('/search/users','ManageController@userSearch')
        ->name('users.search');
    Route::get('/get/online/users', 'ManageController@getOnlineUsers')
        ->name('admin.get.online.users');
    
    Route::put('/user/{id}', 'ManageController@userUpdate')
        ->name('manage.user.update');
    Route::get('/user/{id}/edit', 'ManageController@userEdit')
        ->name('manage.user.edit');
    Route::post('/user/delete', 'ManageController@userDelete')
        ->name('manage.user.delete');

    Route::get('/roles', 'ManageController@roles')
        ->name('manage.all.roles');
    Route::post('/role/create', 'ManageController@rolesStore')
        ->name('role.store');
    Route::get('/role/{id}/edit', 'ManageController@rloeEdit')
        ->name('roles.edit');
    Route::put('/roles/{id}', 'ManageController@rolesUpdate')
        ->name('roles.update');
    Route::delete('/role/destroy/{id}', 'ManageController@roleDestroy')
        ->name('role.destroy');

    // api login ips
    Route::post('/api/user-id={id}/ips', 'ManageController@userLoginIps')
        ->name('user.login.ips'); 

    Route::get('/permissions', 'ManageController@permissions')
        ->name('manage.all.permissions');
    Route::post('/permission/create', 'ManageController@permissionStore')
        ->name('permission.store');
    Route::get('/permission/{id}/edit', 'ManageController@permissionEdit')
        ->name('permissions.edit');
    Route::put('/permissions/{id}', 'ManageController@permissionUpdate')
        ->name('permissions.update');
    Route::delete('/permission/destroy/{id}', 'ManageController@permissionDestroy')
        ->name('permissions.destroy');    
});


Route::prefix('admin')->group( function() { // ->middleware('auth:admin')
    
    Route::get('/register', 'Auth\AdminRegisterController@showRegistationFrom')
        ->name('admin.register.form');
    Route::post('/register', 'Auth\AdminRegisterController@create')
        ->name('admin.register');

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')
        ->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')
        ->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')
        ->name('admin.logout');

            
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')
        ->name('admin.password.email');
    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')
        ->name('admin.password.request');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')
        ->name('admin.password.reset');

    // inbox
    Route::get('/inbox', 'AdminController@inbox')
        ->name('admin.message.inbox');
    Route::get('/send', 'AdminController@send')
        ->name('admin.message.send');
    Route::get('/message/{id}', 'AdminController@messageShow')
        ->name('admin.message.view');

    // admin_send_messages
    Route::get('/reply/user_id={user_id}', 'AdminController@messageReplyView')
            ->name('admin.message.reply.veiw');
    Route::post('/reply', 'AdminController@messageReply')
            ->name('admin.message.reply');
    Route::get('/reply/{id}', 'AdminController@replyShow')
            ->name('admin.message.reply.show');
    Route::post('/reply/delete/selected', 'AdminController@destroyReply')
            ->name('admin.message.reply.delete.selected');

    // users messages
    Route::get('/user/messages', 'AdminController@userMsg')
        ->name('admin.user.messages');
    Route::get('/user/message/{id}', 'AdminController@userMsgShow')
        ->name('admin.user.message.show');
    Route::post('/user/message/delete', 'AdminController@destroyuserAndReplyMsg')
        ->name('admin.user.reply.destroy');
        
    // tags
    Route::get('/tags', 'AdminController@tags')
        ->name('admin.all.tags');
    Route::post('/tag/create', 'AdminController@tagCreate')
        ->name('admin.tag.store');
    Route::delete('/tag/destroy/{id}', 'AdminController@tagDestroy')
        ->name('admin.tag.destroy');

    //  adminNotifications 
    Route::get('/notifications', 'AdminController@adminNotifications')
        ->name('admin.notifications'); 
    Route::get('/notification/{id}', 'AdminController@adminNotificationShow')
        ->name('admin.notification.show'); 
    Route::delete('/notification/delete/{id}', 'AdminController@destroyNotification') // not use
        ->name('admin.notification.delete');
    Route::post('/notification/delete/selected', 'AdminController@destroySelectNotification')
        ->name('admin.notification.delete.selected'); 
     
    // admin settings use AdminSettingController     
    
    Route::get('/', 'AdminSettingController@dashboard')
        ->name('admin.dashboard');
    Route::get('/settings', 'AdminSettingController@settings')
        ->name('admin.settings');
    Route::post('/settings/store', 'AdminSettingController@store')
        ->name('admin.settings.store'); 


});
 
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

// user setting 
Route::get('user/settings', 'SettingController@index')
    ->name('user.settings');
Route::post('user/settings', 'SettingController@store')
    ->name('user.settings.store'); 

// comments  
Route::get('/all-comments', 'CommentController@commentsall')
->name('test.comment.all'); 