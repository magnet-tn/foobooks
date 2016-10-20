<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    //
    public function help()
    {
        return 'This is the help or support page';//
    }

    public function faq()
    {
        return 'This page has answers to common questions';//
    }
}
