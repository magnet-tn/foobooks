<?php

/*
* Book resource
*/
Route::get('/books', 'BookController@index')->name('books.index');
Route::get('/books/create', 'BookController@create')->name('books.create');
Route::post('/books', 'BookController@store')->name('books.store');
Route::get('/books/{book}', 'BookController@show')->name('books.show');
Route::get('/books/{book}/edit', 'BookController@edit')->name('books.edit');
Route::put('/books/{book}', 'BookController@update')->name('books.update');
Route::delete('/books/{book}', 'BookController@destroy')->name('books.destroy');

# or I could have used one line:
# Route::resource('books', 'BookController');


/**
* Misc Pages
* A way to display simple staic pages that dont need their own controller
*/
Route::get('/help', 'PageController@help')->name('page.help');
Route::get('/faq', 'PageController@faq')->name('page.faq');


/**
* Contact page
* Single action controller tht contains a __invoke method, so no action is specified
* This page could also be taken care of via the PageController, it's up to you/
*/
Route::get('/contact', 'ContactController@faq')->name('contact');


/**
* Log Viewer
* Package loaded for a nice log viewing package
*/
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


/**
* A quick and dirty way to set up a whole bunch of practice routes
* that I'll use in lecture.
*/
Route::get('/practice', 'PracticeController@index')->name('practice.index');
for($i = 0; $i < 100; $i++) {
    Route::get('/practice/'.$i, 'PracticeController@example'.$i)->name('practice.example'.$i);
}

/**
* Main homepage
*/
Route::get('/', function () {
    return view('welcome');
});
