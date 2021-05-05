<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function getUser($id) {
        return Note::find($id)->user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Note::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return Note::find($id);
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
            abort(500, 'Note with given ID doesn\'t exist');
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
        $user = Note::find($id);

        if (!$user) {
            abort(500, 'Note with given ID doesn\'t exist');
        }

        return (Note::destroy($id) === 1) ?
            $user :
            response(['message' => 'Failed to delete note'], 500);
    }
}
