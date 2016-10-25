<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContactController extends Controller
{
    //
    public function __invoke() {
        return 'This page provides contact info for connecting with foobooks';//
    }
}
