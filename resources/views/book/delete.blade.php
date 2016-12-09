@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $book->title }}
@endsection

@section('content')

    <h1>Confirm deletion</h1>
    <form method='POST' action='/books/{{ $book->id }}'>

        {{ method_field('DELETE') }}

        {{ csrf_field() }}

        <h2>Are you sure you want to delete <em>{{ $book->title }}</em>?</h2>

        <input type='submit' value='Yes'>

    </form>

@endsection
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
