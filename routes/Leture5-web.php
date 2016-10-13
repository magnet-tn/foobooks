<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', 'BookController@index')->name('books.index');



Route::get('/books/create', function(){

    $view  = '<form method="POST" action="/books/create">';
    #$view .= '<input type="hidden" value="'.csrf_field().'">'; # This will be explained more later
    $view .= '<input type="text" name="title">';
    $view .= csrf_field(); # This will be explained more later
    $view .= '<input type="submit">';
    $view .= '</form>';

        return $view;


});

Route::post('/books/create', function() {
        return "Process adding the book...";

});

Route::get('/books/{title?}', function($title = '') { # {title} can be {anything}. I noticed that this works even withouth the leading '/'

    if($title == '') {
        return 'You did not include a title.';
    }

    return "You requested the book:".$title;
});
