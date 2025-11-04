<?php

namespace App\Http\Controllers;


use App\Models\Financebook;
use Illuminate\Http\Request;

class FinancebookController extends Controller
{

    public function index(Request $request)
    {
        
        $search = $request->input('search');
        $query = Financebook::query();


        if ($search) {
            
            $query->where('description', 'like', '%' . $search . '%');
            
        }


        $notes = $query->get();
        
        return view('financebook.index', compact('notes'));
    }

    public function create()
    {
        return view('financebook.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|integer|min:0',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string|max:1000',
        ]);

        Financebook::create($validated);
        
        return redirect()->route('financebook.index')
                         ->with('success', 'Catatan keuangan berhasil ditambahkan!');
    }

    public function show(string $id) 
    {
    
        $note = Financebook::findOrFail($id);
        return view('financebook.show', compact('note'));
    }

    public function edit(string $id) 
    {

        $note = Financebook::findOrFail($id);
        return view('financebook.edit', compact('note'));
    }


    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|integer|min:0',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string|max:1000',
        ]);
        

        $note = Financebook::findOrFail($id);
        $note->update($validated);
        

        return redirect()->route('financebook.index')
                         ->with('success', 'Catatan keuangan berhasil diupdate!');
    }

  
    public function destroy(string $id) 
    {
       
        $note = Financebook::findOrFail($id);
        $note->delete();

        return redirect()->route('financebook.index')
                         ->with('success', 'Catatan keuangan berhasil dihapus!');
    }
}