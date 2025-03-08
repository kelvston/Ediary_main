<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Http\JsonResponse;


class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }


    public function store(Request $request): JsonResponse
    {
        $request->validate(['contents' => 'required']);

        $note = Note::create([
            'content' => $request->contents,
            'x_position' => 100, // Default position
            'y_position' => 100,
            'color'=>$request->color,
            'reminder_at' => $request->reminder_at ? Carbon::parse($request->reminder_at) : null,
        ]);


        return response()->json($note);
    }

    public function destroy(Note $note): JsonResponse
    {
        $note->delete();
        return response()->json(['message' => 'Note deleted']);
    }

    public function updatePosition(Request $request, Note $note): JsonResponse
    {
        $note->update([
            'x_position' => $request->x_position,
            'y_position' => $request->y_position
        ]);

        return response()->json(['message' => 'Position updated']);
    }

    public function updateColor($id, Request $request)
    {
        $note = Note::findOrFail($id);
        $note->color = $request->color;
        $note->save();

        return response()->json(['success' => true]);
    }

    public function update($id, Request $request)
    {
        // Find the note by ID
        $note = Note::findOrFail($id);

        // Validate the incoming request
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        // Update the note's content
        $note->content = $validated['content'];

        // Optionally update the color or other fields
        if ($request->has('color')) {
            $note->color = $request->color;
        }

        $note->save();

        return response()->json(['message' => 'Note updated successfully.']);
    }

}
