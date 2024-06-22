<?php

namespace App\Http\Controllers\journal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use Auth;



class ArticleController extends Controller
{

    public function index(){
        $articles = DB::table('jdb_articles')
            ->join('jdb_journals', 'jdb_articles.journal_id', '=', 'jdb_journals.id')
            ->select('jdb_articles.*', 'jdb_journals.title as journal_title')
            ->get();

        $keywords = DB::table('jdb_keywords')->get();

        return view('webpages.articles_pages.index', [
            'articles' => $articles,
            'keywords' => $keywords
        ]);

    }



    // Method to add keywords to an article
    public function addKeywords(Request $request, $id){
        $validatedData = $request->validate([
            'keywords' => 'required|array',
            'keywords.*' => 'exists:jdb_keywords,id',
        ]);

        foreach ($validatedData['keywords'] as $keywordId) {
            DB::table('jdb_article_keywords')->insert([
                'article_id' => $id,
                'keyword_id' => $keywordId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('articles.index')->with('success', 'Keywords added successfully!');
    }

    // Method to add an editorial decision to an article
    public function addEditorialDecision(Request $request, $id){
        $validatedData = $request->validate([
            'decision' => 'required|string',
        ]);

        DB::table('jdb_editorial_decisions')->insert([
            'article_id' => $id,
            'decision' => $validatedData['decision'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Editorial decision added successfully!');
    }

    // Method to delete a keyword from an article
    public function removeKeyword($articleId, $keywordId){
        DB::table('jdb_article_keywords')
            ->where('article_id', $articleId)
            ->where('keyword_id', $keywordId)
            ->delete();

        return redirect()->route('articles.index')->with('success', 'Keyword removed successfully!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $journals = DB::table('jdb_journals')->get();
        $keywords = DB::table('jdb_keywords')->get();
        return view('webpages.articles_pages.create', [
            'journals' => $journals,
            'keywords' => $keywords,
        ]);
        

    }

    /**
     * Store a newly created resource in storage.
     */
     // Store a newly created article in the database.
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'title' => 'required|string|max:255',
             'slug_url' => 'required|string|max:255|unique:jdb_articles,slug_url',
             'abstract' => 'required|string',
             'journal_id' => 'required|exists:jdb_journals,id',
             'keywords' => 'required|array',
             'editorial_decision' => 'required|string',
             'upload_pdf.*' => 'required|file|mimes:pdf,doc,docx|max:2048',
         ]);
    

    $filePaths = [];
      if ($request->hasFile('upload_pdf')) {
           foreach ($request->file('upload_pdf') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $filePaths[] = 'uploads/' . $filename;
        }
      }

    // Sanitize the slug to ensure it follows the correct format
    $slug = Str::slug($request->input('slug_url'));
     
         $articleId = DB::table('jdb_articles')->insertGetId([
             'title' => $validatedData['title'],
             'slug_url' => $slug,
             'abstract' => $validatedData['abstract'],
             'journal_id' => $validatedData['journal_id'],
             'upload_pdf' => json_encode($filePaths),
             'submission_date' => now(),
             'created_at' => now(),
             'updated_at' => now(),
         ]);
     
         foreach ($validatedData['keywords'] as $keyword) {
             $keywordId = is_numeric($keyword) ? $keyword : DB::table('jdb_keywords')->insertGetId([
                 'keyword' => $keyword,
                 'created_at' => now(),
                 'updated_at' => now(),
             ]);
     
             DB::table('jdb_article_keywords')->insert([
                 'article_id' => $articleId,
                 'keyword_id' => $keywordId,
             ]);
         }
     
         DB::table('jdb_editorial_decisions')->insert([
             'article_id' => $articleId,
             'editor_id' => auth()->user()->id ?? 1,
             'decision_date' => now(),
             'decision' => $validatedData['editorial_decision'],
             'created_at' => now(),
             'updated_at' => now(),
         ]);
     
         return redirect()->route('articles.index')->with('success', 'Article created successfully!');
     }

     
    /**
     * Display the specified resource.
     */
    public function show(string $id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $article = DB::table('jdb_articles')->find($id);
        $journals = DB::table('jdb_journals')->get();

        if (!$article) {
            abort(404, 'Article not found');
        }

        return view('articles.edit', compact('article', 'journals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){

     $article = DB::table('jdb_articles')->find($id);
    // Assuming upload_pdf field is stored as a JSON array
    $filePaths = json_decode($article->upload_pdf, true);
    // Delete each file from the filesystem
    if (is_array($filePaths)) {
        foreach ($filePaths as $filePath) {
            $fullPath = public_path($filePath);
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }
    }

        // Delete the article from the database
        DB::table('jdb_articles')->where('id', $id)->delete();
        // Redirect to the index route with a success message
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }
 
    # search keywords
    public function search(Request $request) {
    $search = $request->get('q');
    $keywords = DB::table('jdb_keywords')->where('keyword', 'LIKE', "%{$search}%")->get();

    return response()->json($keywords->map(function($keyword) {
        return [
            'id' => $keyword->id,
            'text' => $keyword->keyword
        ];
    }));
}


}
