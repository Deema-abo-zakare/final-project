<?php

namespace App\Http\Controllers;

use Carbon\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
class TaskController extends Controller
{
    public function index():Factory|View{
       // $tasks =    DB::table('tasks')->get();
        $tasks =   Task::all();

        return view('task', compact('tasks')); // تمرير tasks إلى الـ view
    }

    public function create(Request $request ){
       // DB::table('tasks')->insert(['name' => $task_name]);
       $task_name = $request->input('name');
       $task = new Task;
       $task->name  =$task_name;
       $task->save();
        return redirect()->back(); // إعادة التوجيه إلى الصفحة السابقة
    }
    public function destroy($id){
      //  DB::table('tasks')->where('id', $id)->delete();
      //  return redirect()->back(); // redirect the page after delete
      $task = Task::find($id);
        $task->delete(); // حذف المهمة إذا كانت موجودة
        return redirect()->route('task.index');
    }
    public function edit($id){
       // $task = DB::table('tasks')->where('id', $id)->first(); // bring the task by id
       // if ($task) {
      //    $tasks = DB::table('tasks')->get(); // bring all tasks
        //    return view('task', compact('task', 'tasks')); // pass data to view
       // }
      //  return redirect()->back()->with('error', 'Task not found');
      $task =Task::find($id);
        $tasks =   Task::all();
        return view('task', compact('task', 'tasks'));
    }
    public function update(Request $request)
{
   // $id = $request->input('id'); // bring the id
   // $task_name = $request->input('name'); // bring a new name to the task
    // update the task in DB
   // DB::table('tasks')->where('id', $id)->update(['name' => $task_name]);
    // redirect to the page after update
  //  return redirect()->route('task.index'); // replace by the url that view all the task
    // التأكد من أن الطلب يحتوي على id
    $id = $request->input('id');
    $task_name = $request->input('name');
    // تحديث أو إنشاء المهمة باستخدام updateOrCreate
    Task::updateOrCreate(
        ['id' =>  $id], // الشرط للبحث عن السجل
        ['name' => $request->input('name')],  // تحديث البيانات المطلوبة]
    );

    // إعادة التوجيه بعد التحديث
    return redirect()->route('task.index'); // غيّر المسار حسب الحاجة
}

}

