<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;
use App\Author;
use App\Tag;
use Session;

class BookController extends Controller
{

    /**
    *
    */
    public function index()
    {
        $books = Book::all();
        // dump($books);
        // dump($books->first());
        return view('book.index')->with(['books' => $books]);
    }

    /**
    * Get
    */
    public function create()
    {
        return view('book.create');
    }

    /**
    *
    */
    public function store(Request $request)
    {

        # Validate
        $this->validate($request, [
            'title' => 'required|min:3',
            'published' => 'required|min:4|numeric',
            'cover' => 'required|url',
            'purchase_link' => 'required|url',
        ]);

        # If there were errors, Laravel will redirect the
        # user back to the page that submitted this request
        # The validator will tack on the form data to the request
        # so that it's possible (but not required) to pre-fill the
        # form fields with the data the user had entered

        # If there were NO errors, the script will continue...

        # Get the data from the form
        #$title = $_POST['title']; # Option 1) Old way, don't do this.
        $title = $request->input('title'); # Option 2) USE THIS ONE! :)

        $book = new Book();
        $book->title = $request->input('title');
        $book->published = $request->input('published');
        $book->cover = $request->input('cover');
        $book->purchase_link = $request->input('purchase_link');
        $book->save();

        Session::flash('flash_message','Your book '.$book->title.' was added.');
        return redirect('/books');

    }


    /**
    *
    */
    public function show($id)
    {
        return view('book.show')->with('title', $id);
    }


    /**
    *
    */
    public function edit($id)
    {
        $book = Book::find($id);
        #dump($book);

        # Author
        $authors = Author::orderBy('last_name', 'ASC')->get();


        # Organize the authors into an array where the key = author id
        # and value = author name
        $authors_for_dropdown = [];
        foreach($authors as $author) {
            $authors_for_dropdown[$author->id] = $author->last_name.', '.$author->first_name;
        }

        # Tags
        $tags = Tag::orderBy('name', 'ASC')->get();
        $tags_for_checkboxes = [];
        foreach($tags as $tag) {
            $tags_for_checkboxes[$tag->id] = $tag->name;
        }

        # Just the tags for this book
        $tags_for_this_book = [];
        foreach($book->tags as $tag) {
            $tags_for_this_book[] = $tag->name;
        }

        # dump($tags_for_this_book);

        # Make sure $authors_for_dropdown is passed to the view
        if(is_null($book)) {
            Session::flash('flash_message','Book not found');
            return redirect('/books');
        } else {
            return view('book.edit')->with(
            [
                'book' => $book,   // passing the book info to pre-fill the field for editing
                'authors_for_dropdown' => $authors_for_dropdown,
                'tags_for_checkboxes' => $tags_for_checkboxes,
                'tags_for_this_book' => $tags_for_this_book,
            ]
        );
    }
}

/**
*
*/
public function update(Request $request, $id)
{

    # Validate
    $this->validate($request, [
        'title' => 'required|min:3',
        'published' => 'required|min:4|numeric',
        'cover' => 'required|url',
        'purchase_link' => 'required|url',
    ]);

    //dump($request->all());
    # Find and update book
    $book = Book::find($request->id);

    $book->title = $request->title;
    $book->cover = $request->cover;
    $book->published = $request->published;
    $book->author_id = $request->author_id;
    $book->purchase_link = $request->purchase_link;
    $book->save();

    # dd($request->tags); //to show you what is updated...

    # If there were tags selected...
    if($request->tags) {
        $tags = $request->tags;
    }
    # If there were no tags selected (i.e. no tags in the request)
    # default to an empty array of tags
    else {
        $tags = [];
    }

    # Above if/else could be condensed down to this: $tags = ($request->tags) ?: [];

    # Sync tags
    $book->tags()->sync($tags);
    $book->save();

    Session::flash('flash_message','Your changes to '.$book->title.' were saved.');
    return redirect('/books');
}

/**
*
*/
public function destroy($id) {
    //dump($request->all());
    $book = Book::find($id);

    if(is_null($book)) {
        Session::flash('flash_message','Book not found');
        return redirect('/books');
    }

    $book->delete();
    Session::flash('flash_message','The book '.$book->title.' was removed.');
    return redirect('/books');

}


/**
* This was example code I wrote in Lecture 7
* It shows, roughly, what a controller action for your P3 might look like
* It is not at all related to the Book resource.
*/
public function getLoremIpsumText(Request $request)
{

    # Validate the request....

    # Generate the lorem ipsum text
    $howManyParagraphs = $request->input('howManyParagraphs');

    # Logic...
    $loremenator = \SBuck\Loremenator();
    $text = $loremenator->getParagraphs($howManyParagraphs);

    # Display the results...
    return view('lorem')->with(['text', $text]);

}
}
