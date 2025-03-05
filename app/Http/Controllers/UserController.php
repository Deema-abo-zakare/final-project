<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
//use lluminate\Http\Request::id;
class UserController extends Controller
{
    // View all the users
    public function index()
    {
       // $users = DB::table('users')->get();
        $users = User::all();
        return view('users', compact('users'));
    }

    // make a new user
    public function create(Request $request)
    {
        // DB::table('users')->insert(['name' => $users_name]);
       // DB::table('users')->insert(['email => $users_email]);
      // DB::table('users')->insert(['name' => $users_password]);

        $user_name = $request->input('name');
        $user_email = $request->input('email');
        $user_password = $request->input('password');
        $user = new User;
        $user->name =  $user_name;
        $user->email =  $user_email;
        $user->password=  $user_password;
        $user->save();
        return redirect()->back();
    }

    // delete a user
    public function destroy($id)
    {
        //  DB::table('users')->where('id', $id)->delete();
      //  return redirect()->back(); // redirect the page after delete
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'the user was deleted successfuly');
    }

    //View user edit form
    public function edit($id)
    {
        // $user = DB::table('users')->where('id', $id)->first();
       // $users = DB::table('users')->get();
        //    return view('users', compact('user', 'users'));
       $user  = User::find($id);
       $users = User::all(); // to view all the user in the table
       return view('edit', compact('user', 'users'));
}
    public function update(Request $request, $id)
    {
        // $id = $request->input('id'); // bring the id
   // $user_name = $request->input('name'); // bring a new name to the task
   // $user_email = $request->input('email');
   // $user_password = $request->input('password');
    // update the task in DB
   // DB::table('tasks')->where('id', $id)->update(['name' => $task_name]['email=>$useremail']['password'=>$$user_password]);
    // redirect to the page after update
  //  return redirect()->route('users.index');

        $request->validate([
           'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',  // Validate password only if provided
        ]);

        $user = User::findOrFail($id);  //

        // update the user data
        $data = [
          'name'  => $request->name,
        'email' => $request->email,
        ];

        // if a password is a new
       if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);  //update a password
        }

        $user->update($data);  // update the data

       return redirect()->route('users.index')->with('success', 'The data of the user was updated');
    }
}
//
