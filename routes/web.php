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


Route::get('/','FrontendController@index')->name('home'); /* Lecture 6 */
Route::get(trans('routes.object').'/{id}','FrontendController@object')->name('object'); /* Lecture 5 Lecture 15 {id}  */
Route::post(trans('routes.roomsearch'),'FrontendController@roomsearch')->name('roomSearch'); /* Lecture 5 Lecture 18 get->post */
Route::get(trans('routes.room').'/{id}','FrontendController@room')->name('room'); /* Lecture 6 Lecture 19 {id} */
Route::get(trans('routes.article').'/{id}','FrontendController@article')->name('article'); /* Lecture 6 Lecture 22 {id} */
Route::get(trans('routes.person').'/{id}','FrontendController@person')->name('person'); /* Lecture 6 Lecture 23 {id} */

Route::get('/searchCities', 'FrontendController@searchCities'); /* Lecture 17 */
Route::get('/ajaxGetRoomReservations/{id}', 'FrontendController@ajaxGetRoomReservations'); /* Lecture 20 */

Route::get('/like/{likeable_id}/{type}', 'FrontendController@like')->name('like'); /* Lecture 24 */
Route::get('/unlike/{likeable_id}/{type}', 'FrontendController@unlike')->name('unlike'); /* Lecture 24 */

Route::post('/addComment/{commentable_id}/{type}', 'FrontendController@addComment')->name('addComment'); /* Lecture 25 */


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){  /* Lecture 6 Lecture 7 'middleware'=>'auth' */

  Route::get('/','BackendController@index')->name('adminHome'); /* Lecture 6 */
  Route::get(trans('routes.myobjects'),'BackendController@myobjects')->name('myObjects'); /* Lecture 6 */
  Route::get(trans('routes.saveobject'),'BackendController@saveObject')->name('saveObject'); /* Lecture 6 */
  Route::get(trans('routes.profile'),'BackendController@profile')->name('profile'); /* Lecture 6 */
  Route::get(trans('routes.saveroom'),'BackendController@saveRoom')->name('saveRoom'); /* Lecture 6 */
  Route::get('/cities','BackendController@cities')->name('cities.index'); /* Lecture 6 */


});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');  /* Lecture 7 */
