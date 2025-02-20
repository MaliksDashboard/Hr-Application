<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;

class TitleController extends Controller
{
    public function index()
    {
        $titles = Title::orderBy('rank')->get();
        return view('titles.index', compact('titles'));
    }

    public function create()
    {
        return view('titles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:manager,employee',
        ]);

        $title = Title::create($validated);

        return response()->json([
            'success' => 'Title added successfully!',
            'title' => [
                'id' => $title->id,
                'name' => $title->name,
                'category' => $title->category,
            ],
        ]);
    }


    public function edit(Title $title)
    {
        return view('titles.edit', compact('title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:manager,employee',
        ]);

        $title = Title::findOrFail($id);
        $title->update($request->all());

        return response()->json(['success' => 'Title updated successfully!']);
    }

    public function destroy($id)
    {
        try {
            $title = Title::findOrFail($id);
            $title->delete();

            return response()->json(['success' => 'The title has been deleted.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the title.'], 500);
        }
    }


    public function updateRanks(Request $request)
    {
        $titles = $request->titles;

        foreach ($titles as $rank => $id) {
            Title::where('id', $id)->update(['rank' => $rank]);
        }

        return response()->json(['success' => 'Ranks updated successfully!']);
    }

    public function show($id)
    {
        $title = Title::findOrFail($id);

        return response()->json([
            'title' => $title,
        ]);
    }

    public function getTitleData(){
        $titles=Title::all();
        return response()->json($titles);
    }
}
