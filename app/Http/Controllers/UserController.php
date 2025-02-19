<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // View all the users
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    // make a new user
    public function create(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'user add successfuly');
    }

    //View user edit form
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $users = User::all();
        return view('edit', compact('user'));
    }


   // update a user data
public function update(Request $request, $id)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'nullable|string|min:8',
    ]);

    $user = User::findOrFail($id);  //

    // update the user data
    $data = [
        'name'  => $request->name,
        'email' => $request->email,
    ];


    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('users.index')->with('success', 'The data of the user was updated');
}

    // delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'the user was deleted successfuly');
    }
}

