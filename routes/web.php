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
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
//Route::get('/', function () {
//    return view('home');
//});
Route::get('/','UserController@login')->name('home');
Route::get('/login','UserController@login')->name('user.login');
Route::post('/login','UserController@postLogin');
Route::group(['middleware' => 'role'], function () {
    Route::resource('user','UserController');
    Route::get('/dashboard','DashboardController@index')->name('user.dashboard');
    Route::get('/profile','UserController@profile')->name('user.profile');
    Route::get('/logout','UserController@logout')->name('user.logout');
    Route::get('/lock','UserController@lock')->name('user.lock');
    Route::resource('area','AreaController');
    Route::resource('project','ProjectController');
    Route::get('/project/{id}', 'ProjectController@getDisplay');
    Route::get('/project-by-type/{ptype}','ProjectController@projectByType')->name('project.bytype');
    Route::resource('flat','FlatController');
    Route::get('/flats-by-project/{project}','FlatController@flatByProject')->name('flat.byproject');
    Route::resource('customer','CustomerController');
    Route::get('/customer-ajax/{customerId}','CustomerController@customerAjax')->name('customer.ajax');
    Route::get('/project-ajax/{projectId}','projectController@projectAjax')->name('project.ajax');
    Route::resource('landlord','LandlordController');
    Route::get('/landlord-ajax/{landlordId}','LandlordController@landlordAjax')->name('landlord.ajax');
    Route::resource('rent','RentController');
    Route::get('/rent/customers/{projectId}','RentController@customerByProject')->name('customer.byproject');
    Route::get('/rent/flats/{customerId}/{projectId}','RentController@flatsByCustomer')->name('flat.bycustomer');
    Route::resource('renew','RenewController');
 
    Route::get('/renew/customers/{projectId}','RenewController@customerByProject')->name('customer.byproject');
    Route::get('/renew/flats/{customerId}/{projectId}','RenewController@flatsByCustomer')->name('flat.bycustomer');
    Route::resource('collection','CollectionController');
    Route::resource('expense','ExpenseController');
    Route::resource('remittance','RemittanceController');
    Route::resource('notice','NoticeController');
    Route::resource('repairs','RepairsController');
    Route::get('/notice-ajax/{noticeId}','NoticeController@noticeAjax')->name('notice.ajax');
    Route::post('notice.log','NoticeController@log')->name('notice.log');
    Route::post('notice.send','NoticeController@send')->name('notice.send');
    Route::get('notice.logindex','NoticeController@logindex')->name('notice.logindex');

    Route::get('/report/projects','ReportController@projects')->name('report.projects');
    Route::get('/report/landlord_properties','ReportController@landlord_properties')->name('report.landlord_properties');
    Route::get('/report/flats','ReportController@flats')->name('report.flats');
    Route::get('/report/customers','ReportController@customers')->name('report.customers');
    Route::get('/report/landlords','ReportController@landlords')->name('report.landlords');
    Route::get('/report/rents','ReportController@rents')->name('report.rents');
    Route::get('/report/collections','ReportController@collections')->name('report.collections');
    Route::get('/report/collections-summary','ReportController@collectionsSummary')->name('report.collectionSummary');
    Route::get('/report/dues','ReportController@dues')->name('report.dues');
    Route::get('/report/expenses','ReportController@expenses')->name('report.expenses');
    Route::get('/report/Remittances','ReportController@Remittances')->name('report.remittances');
    Route::get('/report/balance','ReportController@balance')->name('report.balance');
    Route::get('/report/rental-status','ReportController@rentaStatus')->name('report.rentalStatus');


    Route::get('/mail-compose','DashboardController@mailCompose')->name('mail.compose');
    Route::post('/mail-send','DashboardController@mailSend')->name('mail.send');

});

Route::get('/make-link',function(){
    App::make('files')->link(storage_path('app/public'), public_path('storage'));
    return 'Done link';
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    return 'clear cache';
});
Route::get('/notification-read','DashboardController@deleteNotification')->name('notification.read');
Route::get('/notification','DashboardController@fetchAll')->name('notification.fetch.all');
