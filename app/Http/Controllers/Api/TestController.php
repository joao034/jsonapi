<?php

use App\Http\Controllers\Controller;
use App\Models\Article;

class TestController extends Controller{
    public function index(){
        return Article::all()->json();
    }
}