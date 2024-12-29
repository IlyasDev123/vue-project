<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function aboutUs()
    {
        return view('pages.about-us');
    }

    public function services()
    {
        return view('pages.service');
    }

    public function contactUs()
    {
        return view('pages.contact-us');
    }
}
