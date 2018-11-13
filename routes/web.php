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

Route::get('/', function () {
    
    if(!Auth::check()){
        return redirect()->to("login");
    }else{
    return view('home.feed');
    }
});

Auth::routes();

Route::get('/importSites', 'HomeController@importSites')->name('importSites');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/places', 'PlaceController@places')->name('places');
Route::post('/processYoutube/', 'HomeController@processYoutube');
Route::post('/processWebSite/', 'HomeController@processWebSite');

Route::resource('comments', 'CommentController');
Route::post('/getCommentsBySourceAndType', 'CommentController@getCommentsBySourceAndType');

Route::resource('feeds', 'FeedController');
Route::post('/feedWall', 'FeedController@feedWall');
Route::post('/feedAattachment', 'FeedController@feedAattachment');


Route::resource('friends', 'FriendController');

Route::post('/addFriend', 'FriendController@addFriend');
Route::post('/deleteFriend', 'FriendController@deleteFriend');

Route::resource('likes', 'LikeController');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/profile/{name}', 'ProfileController@index')->name('profile');
    Route::resource('announcements', 'AnnouncementController');

});
    Route::post('/upload', 'FileController@upload');
    Route::get('/dumpsites', 'PlaceController@dumpsites');
    Route::get('/importUsers', 'HomeController@importUsers');
    Route::post('/getServicesAndSpaces', 'PlaceController@getServicesAndSpaces');
    Route::post('/searchSpace', 'PlaceController@searchSpace');
    Route::post('/findById', 'PlaceController@findById');
    Route::post('/filterPlaces', 'PlaceController@filterPlaces');
    Route::post('/findNeighborhood', 'PlaceController@findNeighborhood');
    Route::post('/reservation', 'PlaceController@reservation');

    Route::get('/setNeiborhood', 'PlaceController@setNeiborhood');
    Route::get('confirmation', 'HomeController@confirmation');

    Route::get('{slug}', 'PlaceController@profile');

    
    
    
    