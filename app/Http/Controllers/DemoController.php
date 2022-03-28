<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function Home(){
        return view('home');
    }

    public function About(){
        return view('about');
    }

    public function Contact(){
        return view('contact');
    }
}
