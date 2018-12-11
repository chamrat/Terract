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

Route::get('/', 'HomeController@index');

Route::get('/landloard','LandloardController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'property'], function (){
    Route::get('/new', 'PropertyController@create')->name('create_property')->middleware('can:create-property');
    Route::post('/new', 'PropertyController@save')->name('save_property')->middleware('can:create-property');
    Route::get('/', 'PropertyController@propertyList')->name('list_property')->middleware('can:view-property');
    Route::get('/{property_id}', 'PropertyController@show')->name('show_property')->middleware('can:view-property');
});

Route::group(['prefix'=>'unit'], function (){
    Route::get('/new', 'UnitController@create')->name('create_unit')->middleware('can:create-property-unit');
    Route::post('/new', 'UnitController@save')->name('save_unit');
    Route::post('/edit/{unitId}', 'UnitController@editUnit')->name('edit_unit');
    Route::get('/', 'UnitController@listUnits')->name('list_units');
});

Route::group(['prefix'=>'payment'], function (){
    Route::get('/makePayment', 'PaymentController@showPaymentForm')->name('make_payment')->middleware('can:create-payment');
    Route::post('/makePayment', 'PaymentController@savePayment')->name('save_payment')->middleware('can:create-payment');
    Route::get('/viewPayment', 'PaymentController@viewPayment')->name('view_payment')->middleware('can:view-payment');
});

Route::group(['prefix'=>'issue'], function (){
    Route::get('/new', 'IssueController@create')->name('create_issue')->middleware('can:create-issue');
    Route::post('/new', 'IssueController@save')->name('save_issue')->middleware('can:create-issue');
    Route::get('/issueList', 'IssueController@viewIssues')->name('view_issues')->middleware('can:view-issue');
});

Route::get('/inviteTenant', 'InvitationController@invitationForm')->name('invite_tenant')->middleware('can:create-property');
Route::post('/inviteTenant', 'InvitationController@sendInvitation')->name('invite_save')->middleware('can:create-property');
Route::get('/email', 'EmailController@sendEmail');

//Ajax Request Endpoints
Route::post('/propertyUnits', 'InvitationController@getUnitsForProperty')->name('property_units');
Route::post('/unitsPerProperty', 'UnitController@getPropertyUnitsPerProperty')->name('units_per_property');
Route::post('/creditCardsPerUser', 'CreditCardController@cardsPerUser')->name('cards_per_user');
