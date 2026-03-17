<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8'
        ]);

        User::create([
            'nom' => $request->nom,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User créé !');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.form', ['user' => $user]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:player,admin',
            'password' => 'nullable|string|min:8'
        ]);

        $user = User::findOrFail($id);
        $data = $request->except('password');
    
        if($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User modifié !');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User supprimé !');
    }

    public function ban(string $id) 
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned;
        $user->save();

        $message = $user->is_banned ? 'User banni !' : 'User débanni !';
        return redirect()->route('users.index')->with('success', $message);
    }
}
