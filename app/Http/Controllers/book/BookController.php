<?php

namespace App\Http\Controllers\book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
	public function index()
	{
	    return view('book.book.index');		
	}	
}
