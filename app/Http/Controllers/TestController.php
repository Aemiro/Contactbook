<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class TestController extends Controller
{
    public function test(){
       $response = Http::get('https://jsonplaceholder.typicode.com/todos/');
       return $response;
    }
}
