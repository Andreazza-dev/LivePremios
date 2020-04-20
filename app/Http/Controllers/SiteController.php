<?php

namespace App\Http\Controllers;

use App\Models\LiveCoder;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){

        return view('site.home');
    }
}
