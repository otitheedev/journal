<?php

namespace App\Http\Controllers\journal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageUserController extends Controller
{
     // Display a listing of the journals.
     public function index()
     {
         $journals = DB::table('jdb_journals')->get();
         $article = DB::table('jdb_articles')->where('status', 1)->paginate(2);
 
         return view('webpages.users.homepage', 
         [
            'journals' => $journals,
            'article' => $article,
        ]);
     }

     public function article(Request $request, $articleId) {
         $article = DB::table('jdb_articles')->where('id', $articleId)->first(); 
        
         $keywords = DB::table('jdb_article_keywords')->where('article_id', $articleId)
         ->join('jdb_keywords', 'jdb_article_keywords.keyword_id', '=', 'jdb_keywords.id')
         ->get(); 
         return view('webpages.users.page', 
         [
            'article' => $article,
            'keywords' => $keywords,
         
         ]);
     }
 
    
}
