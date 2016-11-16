<!DOCTYPE html>
<html>
<head>
    <title>
        {{-- Yield the title if it exists, otherwise default to 'Foobooks' --}}
        @yield('title','Foobooks')
    </title>

    <meta charset='utf-8'>

    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/lumen/bootstrap.min.css' rel='stylesheet'>

    <link href='/css/foobooks.css' type='text/css' rel='stylesheet'>

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>

    @if(Session::get('flash_message') != null)
        <div class='flash_message'>{{ Session::get('flash_message') }}</div>
    @endif


    <header>
        <a href='/'>
        <img
        src='http://making-the-internet.s3.amazonaws.com/laravel-foobooks-logo@2x.png'
        alt='Foobooks Logo'
        width='300px'
        class='logo'>
        </a>
    </header>

    <nav>
        <ul>
            <li><a href='/books'>View all books</a></li>
            <li><a href='/books/create'>Add a new book</a></li>
        </ul>
    </nav>


    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>

    <footer>
     &copy; {{ date('Y') }} &nbsp;&nbsp;
     <a href='https://github.com/magnet-tn/foobooks' target='_blank'><i class='fa fa-github'></i> View on Github</a> &nbsp;&nbsp;
     <a href='http://foobooks.troubleu.com' target='_blank'><i class='fa fa-link'></i> View Live</a>
 </footer>

    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')

</body>
</html>
