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

/**
 * Show restaurant list
 */
/*Route::get('/', function () {
    $restaurants = \App\Restaurant::orderBy('title', 'asc')->get();
    //var_dump($tasks[0]->openingIntervals);

    $comments = App\Restaurant::find(1)->openingIntervals();
    //var_dump($comments);
    foreach ($comments as $comment) {
        var_dump($comment->dayInWeek);
    }

    $availability = new \App\Restaurant\Availability();
    foreach ($restaurants as $restaurant) {
        var_dump($restaurant->title);
        var_dump($availability->isOpen($restaurant));
        foreach($restaurant->openingIntervals as $i) {
            var_dump($i->day_in_week);
        }
    }


    return view('list', [
        'restaurants' => $restaurants
    ]);
});*/

Route::get('/', 'RestaurantController@listing');
Route::get('search', 'RestaurantController@search');