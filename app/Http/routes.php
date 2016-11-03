<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DashboardController@showDashboard');
Route::get('admin', 'DashboardController@showDashboard');
Route::get('admin/dashboard', 'DashboardController@showDashboard');


Route::get('admin/plans', 'PlansController@showIndex');
Route::resource('api/plans', 'PlansController');

Route::get('admin/subscribers', 'SubscribersController@showIndex');
Route::resource('api/subscribers', 'SubscribersController');

Route::get('admin/users', 'UsersController@showIndex');
Route::resource('api/users', 'UsersController');


Route::get('admin/usergroups', 'UsergroupsController@showIndex');
Route::resource('api/usergroups', 'UsergroupsController');

Route::get('admin/permissions', 'PermissionsController@showIndex');
Route::resource('api/permissions', 'PermissionsController');

Route::get('admin/auditlogs', 'AuditlogsController@showIndex');


// Backend functions for Web Payphone CRM
Route::group(['prefix' => 'creds'], function () {
    Route::get('login', 'CredentialController@show_login');
    /* 
     * @params for creds/login
     * username => Username of the user
     * password => Password of the user
     */
    Route::post('login', 'CredentialController@login');
    /* 
     * @params for creds/logout
     */
    Route::get('logout', 'CredentialController@logout');
});

Route::group(['prefix' => 'prods'], function() {
    /*
     * @param for prods/edit_product
     * 'code'          => Plan Code of the Product
     * 'name'          => Plan Name of the Product,
     * 'description'   => Plan Description of the Product,
     * 'price'         => Price of the product,
     * 'product_type'  => Product Type of the Product,
     * 'call_duration' => Call duration of the product ( In Terms of Seconds ),
     * 'nominations'   => Number of Nominations of the Product,
     * 'plan_duration' => Duration of the Product ( In Terms of Days ),
     * 'product_id'    => Procuct ID of user if edited ("0" for add)
     */
    Route::get('edit_product', 'APIProductController@edit_product');
    /*
     * @param for prods/get_products
     * 'search' => Search Parameter
     */
    Route::get('get_products', 'APIProductController@get_products');
    /*
     * @param for prods/get_product_desc
     * 'product_id' => Product ID of the product
     */
    Route::get('get_product_desc', 'APIProductController@get_product_desc');
});

Route::group(['prefix' => 'subs'], function() {
    /*
     * @param for subs/get_subscribers
     * 'search' => Search Parameter
     */
    Route::get('get_subscribers', 'APISubscriberController@get_subscribers');
    /*
     * @param for subs/get_subscriber_desc
     * 'product_id' => Subscriber ID of the subscriber
     */
    Route::get('get_subscriber_desc', 'APISubscriberController@get_subscriber_desc');
    /*
     * $param for subs/get_subscriptions
     * 'subscriber_id' => Subscriber ID
     * 'product_id'    => Product ID
     */
    Route::get('get_subscriptions', 'APISubscriberController@get_subscriptions');
    /*
     * $param for subs/get_subscription_desc
     * 'subscriber_id' => Subscriber ID
     */
    Route::get('get_subscription_desc', 'APISubscriberController@get_subscription_desc');
});
