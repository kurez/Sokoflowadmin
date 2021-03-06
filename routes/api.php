<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {

   //customers
   Route::get('customers/{businessCode}', 'customersController@index');
   Route::post('customers/add-customer', 'customersController@add_customer');
   Route::get('customers/{code}/details', 'customersController@details');
   Route::get('customers/{customerID}/{businessCode}/deliveries', 'customersController@deliveries');
   Route::get('customers/delivery/{code}/details', 'customersController@delivery_details');
   Route::get('customers/{customerID}/orders', 'customersController@orders');
   Route::get('customers/order/{orderCode}/details', 'customersController@order_details');
   Route::get('customers/{customerID}/new-order/', 'customersController@new_order');

   //products
   Route::get('products/{businessCode}', 'productsController@index');

   //product categories
   Route::get('products/categories/{businessCode}', 'productCategoriesController@index');
   Route::get('products/{categoryID}/category', 'productCategoriesController@products_by_category');

   //deliveries
   Route::get('deliveries/{businessCode}/{userCode}', 'deliveryController@index');
   Route::get('delivery/{code}/{businessCode}/details', 'deliveryController@details');

   //customer checkin
   Route::post('customer/checkin/session',['uses' => 'checkinController@create_checkin_session']);
   Route::get('customer/{CustomerCode}/checkin',['uses' => 'checkinController@checkin','as' => 'customer.checkin']);
   Route::get('checkin/{checkinCode}/stock',['uses' => 'checkinController@stock','as' => 'checkin.stock']);
   Route::get('checkin/{checkinCode}/out',['uses' => 'checkinController@checkout','as' => 'check.out']);
   Route::post('checkin/{checkinCode}/add-to-cart',['uses' => 'checkinController@add_to_cart','as' => 'add.to.cart']);
   Route::get('checkin/{checkinCode}/cart',['uses' => 'checkinController@cart','as' => 'checkin.cart']);
   Route::post('checkin/{checkinCode}/order-save',['uses' => 'checkinController@save_order','as' => 'checkin.order.save']);
   Route::get('checkin/{checkinCode}/cart/{id}/delete',['uses' => 'checkinController@cart_delete','as' => 'checkin.cart.delete']);
   Route::get('checkin/{checkinCode}/orders',['uses' => 'checkinController@orders','as' => 'checkin.orders']);

   Route::post('checkin/{checkinCode}/order/edit/reason',['uses' => 'checkinController@order_edit_reason','as' => 'checkin.order.edit.reason']);
   Route::get('checkin/{checkinCode}/order/{orderID}/edit',['uses' => 'checkinController@order_edit','as' => 'checkin.order.edit']);
   Route::post('checkin/{checkinCode}/order/{itemID}/update',['uses' => 'checkinController@order_update','as' => 'checkin.order.update']);
   Route::get('checkin/{checkinCode}/order/{itemID}/delete/item',['uses' => 'checkinController@order_delete_item','as' => 'checkin.order.delete.item']);
   Route::post('checkin/checkinCode/cancel',['uses' => 'checkinController@order_cancellation','as' => 'checkin.order.cancellation']);


   Route::get('checkin/{checkinCode}/visits',['uses' => 'checkinController@visits','as' => 'checkin.visits']);
   Route::post('checkin/{checkinCode}/visit/add',['uses' => 'checkinController@visit_add','as' => 'checkin.visit.add']);

   //checkin visits
   Route::get('checkin/{checkinCode}/order/{orderID}/details',['uses' => 'checkinController@order_details','as' => 'checkin.order.details']);
   Route::get('checkin/{checkinCode}/order/{orderID}/print',['uses' => 'checkinController@order_print','as' => 'checkin.order.print']);

   /*
   |--------------------------------------------------------------------------
   | Authentication
   |--------------------------------------------------------------------------
   */
   Route::post('login',  'AuthController@userLogin');
   // Route::post('signup', 'AuthController@userSignUp');
   // Route::get('user/{phonenumber}/details', 'AuthController@user_details');


});
