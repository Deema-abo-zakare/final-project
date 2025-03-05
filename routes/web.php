<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Carbon\Factory;
//use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', action:function (): Factory|View{
    return view('welcome');
});
Route::get(uri:'/about',action:function(): Factory|View{
    $name = 'Heba';
    $departments = [
       '1' => 'Technical',
       '2' => 'Financial',
       '3' => 'Sales'
    ];
    //return View('about',['name' => $name]);
    //return View('about')->with('name',$name);
    return view('about',data:compact('name','departments'));

 });
Route::post(uri:'/about',action:function(): Factory|View{
   $name= $_POST['name'];
   $departments = [
     '1' => 'Technical',
     '2' => 'Financial',
     '3' => 'Sales'
   ];
   //return view(view:'about',data:compact(var_name:'name'));
   //return view('about',['name'=>$name]);
   //return view(about)->with('name',$name)
   return view('about',compact('name','departments'));
});
// Route::get('task',action:function(): Factory|View{
//     $task = DB::table(table:'task')->get();
//    return view(view:'task',data:compact(var_name:'task'));
// });
// Route::get(uri:'create',action:function(){
//     $task_name = $_POST['name'];
//     DB::table(table:'task')->insert(values:['name' => $task_name]);
//     return redirect()->back();
// });


// Route::post('delete/{id}', action:function ($id){

//     DB::table('task')->where('id', $id)->delete();
//     return redirect()->back();
// });

// Route::post('edit/{id}', function ($id) {
//     // جلب السجل باستخدام ID
//     $task = DB::table('task')->where('id', $id)->first();
//     // التحقق مما إذا كان السجل موجودًا
//     if ($task) {
//         // إذا تم العثور على السجل، يمكنك إرسال البيانات إلى الـ view
//         $tasks = DB::table('task')->get(); // جلب كل السجلات من جدول task
//         return view('task', compact('task', 'tasks'));
//     } else {
//         // إذا لم يتم العثور على السجل، إعادة التوجيه مع رسالة خطأ
//         return redirect()->back()->with('error', 'we dont find the record');
//     }
// });
// use App\Models\User;

// Route::get('/users', function () {
//     $users = User::all();
//     foreach ($users as $user) {
//         echo $user->id;  // عرض الـ id لكل مستخدم
//     }
// });

// Route::get(uri:'edit/{id}',action:function($id):Factory|View{
//     $task = DB::table('task')->where('id',"=",$id)->first();
//     $tasks = DB::table(table:'task')->get();
//     return view('task',data:compact(var_name:'task',var_names:'tasks'));
// });
// Route::get(uri:'update',action:function($id){
//      $id = $_POST['id'];
//      DB::table('task')->where('id',"=",$id)->update(['name'=>$_POST['name']]);
//      return redirect()->to('task');
// });

// //view task
// Route::get('task', [TaskController::class,'index']);

// // add a new task
// Route::post('create',[TaskController::class,'create']);

// // حذف مهمة
// Route::post('delete/{id}',[TaskController::class,'destroy']);

// // Edit task
// Route::get('edit/{id}', [TaskController::class,'edit']);

// // update task
// Route::post('update',[TaskController::class,'update']);



// view tasks
Route::get('task', [TaskController::class, 'index'])->name('task.index');

// add a new task
Route::post('create', [TaskController::class, 'create'])->name('task.create');

// delete a task
Route::post('delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');

// edit a task
Route::get('edit/{id}', [TaskController::class, 'edit'])->name('task.edit');

// update a task
Route::post('update', [TaskController::class, 'update'])->name('task.update');


// View A user menu
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Add a new user
Route::post('/users', [UserController::class, 'create'])->name('users.create');

// delete a user
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Edit a user data
Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');

//Update a user data
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');



Route::get('app',action:function(){
     return view(view:'layouts.app');
});
?>

