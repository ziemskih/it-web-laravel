<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Exception;

class UserController extends Controller
{
    public function getAllNotes($id) {
        $user = User::find($id);

        if (!$user) {
            return response(['message' => 'User not found'], 404);
        }
        if ($user->notes->isEmpty()) {
            return response(['message' => 'User\'s notes not found'], 404);
        }

        return $user->notes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $users->isEmpty() ?
            response(['message' => 'Users not found'], 404) :
            $users;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = User::find($id);

        return !$user ?
            response(['message' => 'User not found'], 404) :
            $user;
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
            return response(['message' => 'User not found'], 404);
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
            return response(['message' => 'User not found'], 404);
        }

        return (User::destroy($id) === 1) ?
            $user :
            response(['message' => 'Failed to delete user'], 500);
    }
}
