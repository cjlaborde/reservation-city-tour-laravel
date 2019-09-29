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


Route::get('/','FrontendController@index')->name('home'); /* Part 6 */
Route::get(trans('routes.object').'/{id}','FrontendController@object')->name('object'); /* Part 5 Part 15 {id}  */
Route::post(trans('routes.roomsearch'),'FrontendController@roomsearch')->name('roomSearch'); /* Part 5 Part 18 get->post */
Route::get(trans('routes.room').'/{id}','FrontendController@room')->name('room'); /* Part 6 Part 19 {id} */
Route::get(trans('routes.article').'/{id}','FrontendController@article')->name('article'); /* Part 6 Part 22 {id} */
Route::get(trans('routes.person').'/{id}','FrontendController@person')->name('person'); /* Part 6 Part 23 {id} */

Route::get('/searchCities', 'FrontendController@searchCities'); /* Part 17 */
Route::get('/ajaxGetRoomReservations/{id}', 'FrontendController@ajaxGetRoomReservations'); /* Part 20 */

Route::get('/like/{likeable_id}/{type}', 'FrontendController@like')->name('like'); /* Part 24 */
Route::get('/unlike/{likeable_id}/{type}', 'FrontendController@unlike')->name('unlike'); /* Part 24 */

Route::post('/addComment/{commentable_id}/{type}', 'FrontendController@addComment')->name('addComment'); /* Part 25 */
Route::post('/makeReservation/{room_id}/{city_id}', 'FrontendController@makeReservation')->name('makeReservation'); /* Part 26 */


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){  /* Part 6 Part 7 'middleware'=>'auth' */

  //for json mobile
  Route::get('/getNotifications', 'BackendController@getNotifications'); /* Part 53 */
  Route::post('/setReadNotifications', 'BackendController@setReadNotifications'); /* Part 53 */

  Route::get('/','BackendController@index')->name('adminHome'); /* Part 6 */
  Route::get(trans('routes.myobjects'),'BackendController@myobjects')->name('myObjects'); /* Part 6 */
  Route::match(['GET','POST'],trans('routes.saveobject').'/{id?}','BackendController@saveObject')->name('saveObject'); /* Part 6 Part 41 match(['GET','POST'];/{id?} */
  Route::match(['GET','POST'],trans('routes.profile'),'BackendController@profile')->name('profile'); /* Part 6  Part 39 match(['GET','POST'] */
  Route::get('/deletePhoto/{id}', 'BackendController@deletePhoto')->name('deletePhoto'); /* Part 39 */
  Route::match(['GET','POST'],trans('routes.saveroom').'/{id?}', 'BackendController@saveRoom')->name('saveRoom'); /* Part 47 */
  Route::get(trans('routes.deleteroom').'/{id}', 'BackendController@deleteRoom')->name('deleteRoom'); /* Part 47 */

  Route::get('/deleteArticle/{id}', 'BackendController@deleteArticle')->name('deleteArticle'); /* Part 44 */
  Route::post('/saveArticle/{id?}', 'BackendController@saveArticle')->name('saveArticle'); /* Part 44 */

  Route::get('/ajaxGetReservationData', 'BackendController@ajaxGetReservationData'); /* Part 30 */
  Route::get('/ajaxSetReadNotification', 'BackendController@ajaxSetReadNotification'); /* Part 50 */
  Route::get('/ajaxGetNotShownNotifications', 'BackendController@ajaxGetNotShownNotifications'); /* Part 51 */
  Route::get('/ajaxSetShownNotifications', 'BackendController@ajaxSetShownNotifications'); /* Part 52 */

  Route::get('/confirmReservation/{id}', 'BackendController@confirmReservation')->name('confirmReservation'); /* Part 33 */
  Route::get('/deleteReservation/{id}', 'BackendController@deleteReservation')->name('deleteReservation'); /* Part 33 */

  Route::resource('cities', 'CityController'); /* Part 37 */

  Route::get(trans('routes.deleteobject').'/{id}', 'BackendController@deleteObject')->name('deleteObject'); /* Part 46 */




});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');  /* Part 7 */
