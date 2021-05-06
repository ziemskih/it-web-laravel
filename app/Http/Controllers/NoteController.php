<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function getUser($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response(['message' => 'Note not found'], 404);
        }
        if (!$note->user) {
            return response(['message' => 'Note\'s user not found'], 404);
        }

        return $note->user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();

        return $notes->isEmpty() ?
            response(['message' => 'Notes not found'], 404) :
            $notes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validated = $request->validate([ // TODO
//            'user_id' => 'required|unique:users|max:50',
//            'name' => 'required|max:255',
//            'text' => 'required|max:100'
//        ]);

        return Note::create([
            'user_id' => $request->input('userId'),
            'name' => $request->input('name'),
            'text' => $request->input('text')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $note = Note::find($id);

        return !$note ?
            response(['message' => 'Note not found'], 404) :
            $note;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response(['message' => 'Note not found'], 404);
        }

        $note->update($request->all());
        return $note;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response(['message' => 'Note not found'], 404);
        }

        return (Note::destroy($id) === 1) ?
            $note :
            response(['message' => 'Failed to delete note'], 500);
    }
}
