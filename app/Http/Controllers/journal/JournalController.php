<?php

namespace App\Http\Controllers\journal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
     // Display a listing of the journals.
     public function index()
     {
         $journals = DB::table('jdb_journals')->get();
         return view('webpages.journal_pages.index', ['journals' => $journals]);
     }
 
     // Show the form for creating a new journal.
     public function create()
     {
         return view('webpages.journal_pages.create');
     }
 
     // Store a newly created journal in the database.
     public function store(Request $request)
     {
         // Validate the request
         $validatedData = $request->validate([
             'title' => 'required|string|max:255',
             'issn' => 'required|string|max:20',
             'impact_factor' => 'required|numeric',
             'description' => 'nullable|string',
         ]);
 
         // Insert the journal into the database using DB::insert
         DB::table('jdb_journals')->insert([
             'title' => $validatedData['title'],
             'issn' => $validatedData['issn'],
             'impact_factor' => $validatedData['impact_factor'],
             'description' => $validatedData['description'],
             'created_at' => now(),
             'updated_at' => now(),
         ]);
 
         // Redirect or show a success message
         return redirect()->route('journals.index')->with('success', 'Journal created successfully!');
     }
 
     // Show the form for editing the specified journal.
     public function edit($id)
     {
         // Implementation for edit form
     }
 
     // Update the specified journal in the database.
     public function update(Request $request, $id)
     {
         // Implementation for update
     }
 
     // Remove the specified journal from the database.
    public function destroy($id)
    {
        DB::table('jdb_journals')->where('id', $id)->delete();

        return redirect()->route('journals.index')->with('success', 'Journal deleted successfully!');
    }
}
