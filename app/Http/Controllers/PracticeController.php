<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Rych\Random\Random;
use joshtronic\LoremIpsum;
use DB;
use Carbon;
use App\Book;
use App\Author;

class PracticeController extends Controller
{
    /**
    *
    */
    public function example21() {
    //
    }

    /**
    *
    */
    public function example20() {
        # With *eager loading*
        $books = Book::with('tags')->get();
        # Now without *eager loading*
        // $books = Book::get();

        foreach($books as $book) {
            dump($book->title.' is tagged with: ');
            foreach($book->tags as $tag) {
                dump($tag->name);
            }
        }
    }

    /**
    *
    */
    public function example19() {
        $book = Book::where('title', '=', 'The Great Gatsby')->first();

        dump($book->title);

        foreach($book->tags as $tag) {
            dump($tag->name);
        }
    }

    /**
    *
    */
    public function example18() {
        # Eager load the author with the book
        $books = Book::with('author')->get(); //The 'author' relationship method is needed here.
        # This is a basic query without eager loading, Try both.
        // $books = Book::get();

        # When you loop below,
        # The Eager method (getting the related author data with the query)
        # means you don't go back to query for each book tp get the author.


        foreach($books as $book) {
            echo $book->author->first_name.' '.$book->author->last_name.' wrote '.$book->title.'<br>';
        }

        dump($books->toArray());
    }

    /**
    *
    */
    public function example17() {
        # Get the first book as an example
    $book = Book::first();
    #$book = Book::where('id', '=', 3)->first();  //can try this too, but *get* doesn't work

    # Get the author from this book using the "author" dynamic property
    # "author" corresponds to the the relationship method defined in the Book model
    $author = $book->author;
    #This *author* is a dynamic property - saying to be aware of an relationship
    #Note that the above is different than the below which returns the relationship
    # $author = $book->author();
    #dd($author); returns the object in the first case, and the relationship in the second.
    #dd($author);

    # Output
    #dump($book->title.' was written by '.$author->first_name.' '.$author->last_name);
    dump($book->toArray());
    }
    /**
    *
    */
    public function example16() {
        # To do this, we'll first create a new author:
        $author = new Author;
        $author->first_name = 'J.K';
        $author->last_name = 'Rowling';
        $author->bio_url = 'https://en.wikipedia.org/wiki/J._K._Rowling';
        $author->birth_year = '1965';
        $author->save();
        dump($author->toArray());

        # Then we'll create a new book and associate it with the author:
        $book = new Book;
        $book->title = "Harry Potter and the Philosopher's Stone";
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9781582348254_p0_v1_s118x184.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harrius-potter-et-philosophi-lapis-j-k-rowling/1102662272?ean=9781582348254';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());

    }
    /**
    *
    */
    public function example15() {
        /*
    2 separate queries on the database:
    */
    // $books = Book::orderBy('id','descending')->get(); # Query DB
    // $first_book = Book::orderBy('id','descending')->first(); # Query DB
    // dump($books);

    /*
    1 query on the database, 1 query on the collection (better):
    */
    $books = Book::orderBy('id','descending')->get(); # Query DB
    $first_book = $books->first(); # Query Collection
    dump($books);
    dump($first_book);
    }
    /**
    *
    */
    public function example14() {
        $books = Book::all();
        foreach($books as $book) {
            #echo $book->title.'<br>';
            echo $book['title'];
        }
    }
    /**
    *   Remove any books by the author “J.K. Rowling”.
    */
    public function example106() {

        Book::where('title','LIKE','Harry Potter')->delete();

        return "Deleted all books with title Harry Potter.";
    }
    /**
    *   Find any books by the author Bell Hooks
    *   and update the author name to be bell hooks (lowercase).
    */
    public function example105() {
        # First get a book to update
        $books = Book::where('author', 'LIKE', '%Bell Hooks%')->get();

        # If we found the book, update it
        if($books) {
            # change each author in books
            foreach($books as $book) {
                # change author to lowercase
                $book->author = 'bell hooks';
                echo $book->title.'<br>';
            }
            # Save the changes
            $book->save();

            echo "Update complete; check the database to see if your update worked...";
        }
        else {
            echo "Book not found, can't update.";
        }
    }
    /**
    *   Retrieve all the books in descending order according to
    *   published date.
    */
    public function example104() {
        $books = Book::orderBy('published', 'desc')->get();

        #
        if(!$books->isEmpty()) {

            # Output the books
            foreach($books as $books) {
                echo $books->title.'<br>';
            }
        }
        else {
            echo 'No books found';
        }
    }
    /**
    *   Retrieve all the books in alphabetical order by title.
    */
    public function example103() {
        $books = Book::orderBy('title')->get();

        #
        if(!$books->isEmpty()) {

            # Output the books
            foreach($books as $books) {
                echo $books->title.'<br>';
            }
        }
        else {
            echo 'No books found';
        }
    }
    /**
    *   Retrieve all the books published after 1950.
    */
    public function example102() {
        $books = Book::where('published', '>', 1950)->get();

        #
        if(!$books->isEmpty()) {

            # Output the books
            foreach($books as $books) {
                echo $books->title.'<br>';
            }
        }
        else {
            echo 'No books found';
        }
    }
    /**
    *  Retrieve the last 5 books that were added to the books table.
    */
    public function example101() {
        $books = Book::latest()->get();

        #
        if(!$books->isEmpty()) {

            # Output the books
            $count = 0;
            foreach($books as $books) {
                if($count <5){
                    echo $books->title.'<br>';
                    $count++;
                }
                else {
                    continue;
                }
            }
        }
        else {
            echo 'No books found';
        }
    }
    /**
    *
    */
    public function example13() {
        # First get a book to delete
        $books = Book::where('author', 'LIKE', '%Rowling%')->get();

        # If we found the book, delete it
        if($books) {

            # Goodbye!
            $books->delete();

            return "Deletion complete; check the database to see if it worked...";

        }
        else {
            return "Can't delete - Book not found.";
        }
    }
    /**
    *
    */
    public function example12() {
        # First get a book to update
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        # If we found the book, update it
        if($book) {

            # Give it a different title
            $book->title = 'The Really Great Gatsby';

            # Save the changes
            $book->save();

            echo "Update complete; check the database to see if your update worked...";
        }
        else {
            echo "Book not found, can't update.";
        }
    }
    /**
    *
    */
    public function example11() {
        $books = Book::all();

        # Make sure we have results before trying to print them...
        #Note, no where is the books table mentioned. If follows from
        #convention of having a table named 'foobars,' then the model is
        #'Foobar'
        if(!$books->isEmpty()) {

            # Output the books
            foreach($books as $book) {
                echo $book->title.'<br>';
            }
        }
        else {
            echo 'No books found';
        }
    }
    /**
    *
    */
    public function example10() {
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = 'Harry Potter';
//        $book->author = 'J.K. Rowling';
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent save() method
        # This will generate a new row in the `books` table, with the above data
        $book->save();

        echo 'Added: '.$book->title;
    }
    /**
    *
    */
    public function example9() {

        # This was how I wrote it in lecture and it wasn't working:
        //$book = DB::table('books')->find(2)->update(['title' => 'foobar']);
        # This does work:
        $book = DB::table('books')->where('id','=','2')->update(['title' => 'THE BELL JAR']);
        # Upon closer inspection, it appears that update has to work on a "Builder" instance
        # The following two dumps demonstrate the difference
        dump(DB::table('books')->find(2)); # Gets a Object with the book data
        dump(DB::table('books')->where('id','=','2')); # Gets a Builder instance

    }
    /**
    *
    */
    public function example8() {
        DB::table('books')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'Am I a woman\?: Black women \and feminism',
            'author' => 'Bell Hooks',
            'published' => 1925,
            'cover' => 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG',
            'purchase_link' => 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565',
        ]);//
        echo 'Added a new book';
    }
    /**
    *
    */
    public function example7() {
        # Use the QueryBuilder to get all the books
        $books = DB::table('books')->get();

        # Output the results
        foreach ($books as $book) {
            echo $book->title;
        }
    }
    /**
    *
    */
    public function example6() {
        $numberOfUsers = 5;
        $count = 0;
        for ($j = 0; $j < 8; $j++){
            $gen = new \RandomUser\Generator();
            $user = $gen->getUser();
            if($count==$numberOfUsers){
                break;
            } else {
                if(ctype_alpha ( $user->getFirstName() )){
                    echo $user->getFirstName(). ' ';
                    $count++;
                } else{
                    continue;
                }
                echo $user->getLastName() . ', ';
                echo $user->getGender() . ', ';
                echo $user->getDateOfBirth() . ', ';
                echo $user->getUsername() . ', ';
                echo $user->getSalt() . '<br>';
            }
        }
    }

    /**
    *
    */
    public function example5() {
        $lipsum = new LoremIpsum();
        echo '3 words: ' . $lipsum->words(3) . "---------";
        echo '1 sentence:  ' . $lipsum->sentence() . "-------";
        echo '2 paragraphs: ' . $lipsum->paragraphs(2) . "+++";
    }
    /**
    *
    */
    public function example4() {
        $random = new Random();
        $soRandom = new Random();
        return $random->getRandomString(8)." ".$soRandom->getRandomInteger(100, 1000);
    }
    /**
    *
    */
    public function example3() {
        echo \App::environment();
        echo 'App debug:  '.config('app.debug');
    }
    /**
    *
    */
    public function example2() {
        $fruits = ['pineapple', 'orange', 'kiwi'];
        dd($fruits);
    }

    /**
    *
    */
    public function example1() {
        return 'This is the example 1';
    }

    //
}
