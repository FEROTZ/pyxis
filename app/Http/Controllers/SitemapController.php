<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class SitemapController extends Controller
{
    public function index(Request $request){
        $menus = Menu::orderBy('id', 'desc')->where('status', 1)->get();
        
        // return $request;
        return response()->view('sitemap', compact('menus'))
            ->header('Content-Type', 'text/xml');
        }
    
}
