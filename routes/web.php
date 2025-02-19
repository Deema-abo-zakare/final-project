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
    $name = 'deema';
    $departments = [
       '1' => 'Technical',
       '2' => 'Financial',
       '3' => 'Sales'
    ];

    return view('about',data:compact('name','departments'));

 });
Route::post(uri:'/about',action:function(): Factory|View{
   $name= $_POST['name'];
   $departments = [
     '1' => 'Technical',
     '2' => 'Financial',
     '3' => 'Sales'
   ];

   return view('about',compact('name','departments'));
});


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
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

//Update a user data
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');



Route::get('app',action:function(){
     return view(view:'layouts.app');
});
?>

