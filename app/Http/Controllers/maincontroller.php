<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class maincontroller extends Controller
{
    public function index()
    {
        $json = file_get_contents(public_path('news.json'));
        $news = json_decode($json, true);

        return view('home', ['news' => $news]);
    }

    public function gallery($id)
    {
        $json = file_get_contents(public_path('news.json'));
        $news = json_decode($json, true);

        $item = collect($news)->firstWhere('id', (int) $id);

        return view('gallery', ['item' => $item]);
    }
}
