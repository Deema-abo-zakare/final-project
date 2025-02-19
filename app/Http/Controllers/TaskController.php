<?php

namespace App\Http\Controllers;

use Carbon\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class TaskController extends Controller
{
    public function index():Factory|View{
        $tasks =    DB::table('task')->get();
        return view('task', compact('tasks'));
    }

    public function create(Request $request ){
        $task_name = $request->input('name');
        DB::table('task')->insert(['name' => $task_name]);
        return redirect()->back();
    }
    public function destroy($id){
        DB::table('task')->where('id', $id)->delete();
        return redirect()->back();
    }
    public function edit($id){
        $task = DB::table('task')->where('id', $id)->first();
        if ($task) {
            $tasks = DB::table('task')->get(); // bring all tasks
            return view('task', compact('task', 'tasks'));
        }
        return redirect()->back()->with('error', 'Task not found');
    }
    public function update(Request $request)
{
    $id = $request->input('id');
    $task_name = $request->input('name');

    // update the task in DB
    DB::table('task')->where('id', $id)->update(['name' => $task_name]);

    return redirect()->route('task.index');
}

}
