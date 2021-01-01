<?php

use Illuminate\Support\Facades\Route;


Route::prefix('dashboard')->name('dashboard.')->middleware(['auth' , 'role:admin|super_admin'])->group(function (){
    //welocome route
    Route::get('/' , 'WelcomeController@index')->name('welcome');

   //cateogry route
    Route::resource('categories' , 'CategoryController');

    Route::resource('movies' , 'MovieController');



    //Route contoller route
    Route::resource('roles' , 'RoleController');
    Route::resource('users' , 'UserController');
    Route::get('settings/social_login' , 'SettingController@social_login')->name('settings.social_login');
    Route::get('settings/social_links' , 'SettingController@social_links')->name('settings.social_link');
    Route::post('settings/' , 'SettingController@store')->name('settings.store');

});


Route::get('/home', 'HomeController@index')->name('home');
