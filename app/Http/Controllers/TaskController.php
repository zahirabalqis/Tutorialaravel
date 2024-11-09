<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
    //validation
    $request->validate([
    'title' => 'required|max:255',
    'description' => 'required',
    'type' => 'required',
    'duedate' => 'required',
    'user_id' => 'required|exists:users,id'
    ]);
    // Task::create($request->all()); #for all request
    Task::create([
    'title' => $request->title, //request dari atas validation
    'description' => $request->description,
    'type' => $request->type,
    'duedate' => $request->duedate,
    'user_id' => $request->user_id
    ]);
    return redirect()->route('task.create')->with('success', 'Task Created successfully.');
    }

    public function create()
    {
        $users = User::all();
        return view('task.create', compact('users'));
    }
    public function index()
    {
         #call the orm with user() method on model Task
        $tasks = Task::with('user')->get();
        return view('task.index', compact('tasks'));
    }
    public function show($id)
    {
        $tasks = Task::find($id);
        return view('task.show', compact('tasks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'type' => 'required',
            'duedate' => 'required',
        ]);
        $task = Task::find($id);
        // $task->update($request->all()); #for all
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'duedate' => $request->duedate,
            'user_id' => $request->user_id
        ]);
        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }
    public function edit($id)
    {
        $task = Task::find($id);
        $users = User::all();
        return view('task.edit', compact('task', 'users'));
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task Deleted successfully');
    }
}
