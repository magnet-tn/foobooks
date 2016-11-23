@extends('layouts.master')

@section('title')
    Delete a Book    <!-- {{ $book->title }} -->
@stop

@section('content')

    <h1>Delete this book</h2>        <!-- {{ $book->title }} </h1> -->

    <p>
        Confirm that you want to delete {{ $book->title }}
    </p>

    <p>
        <a href='/books/delete/{{$book->id}}'> confirm <.a>
    </p>

    <!-- <form method='POST' action='/books/delete/{{ $book->id }}'>

        {{ method_field('DELETE') }}

        {{ csrf_field() }}

        <input name='id' value='{{$book->id}}' type='hidden'>

        <div class='form-group'>
           <label>Title:</label>
            <input
                type='text'
                id='title'
                name='title'
                value='{{ old('title', $book->title) }}'
            >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>

        <div class='form-instructions'>
            All fields are required
        </div>

        <button type="submit" class="btn btn-primary">Delete book</button>


        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form> -->


@stop
