<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();

        return response()->json([
            'data' => $notes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $note = new Note;
        $note->title = $validated['title'];
        $note->content = $validated['content'];
        $note->save();

        return $note;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::findOrFail($id);

        return $note;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = Note::findOrFail($id);

        $validated_field = $request->validate([
            'title' => 'sometimes|string',
            'content' => 'sometimes|string',
        ]);

        if (array_key_exists('title', $validated_field)) {
            $note->title = $validated_field['title'];
        }

        if (array_key_exists('content', $validated_field)) {
            $note->content = $validated_field['content'];
        }

        $note->save();

        return $note;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);

        $note->delete();

        return response()->noContent();
    }
}
