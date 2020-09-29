<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
	public function about()
	{
		return view('page.about');
	}

	public function articles()
	{    
		$articles = \App\Models\Article::all();
    		return view('page.articles', ['articles' => $articles]);
	}

}
