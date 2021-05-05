<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Exception;

class UserController extends Controller
{
    public function getAllNotes($id) {
        return User::find($id)->notes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return User::find($id);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:50',
            'password' => 'required|max:100'
        ]);

        return User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password'])
        ]);
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
        $validated = $request->validate([
            'username' => 'required|unique:users|max:50',
            'password' => 'required|max:100'
        ]);

        $user = User::find($id);

        if (!$user) {
            abort(500, 'User with given ID doesn\'t exist');
        }

        $user->update($validated);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(500, 'User with given ID doesn\'t exist');
        }

        return (User::destroy($id) === 1) ?
            $user :
            response(['message' => 'Failed to delete user'], 500);
    }
}
