<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{
    /**
     * Display the kanban board with all tasks.
     */
    public function index()
    {
        $todoTasks = Task::where('status', 'todo')->orderBy('position')->get();
        $progressTasks = Task::where('status', 'progress')->orderBy('position')->get();
        $doneTasks = Task::where('status', 'done')->orderBy('position')->get();
        $user = Auth::user();
        return view('Admin.tache', compact('todoTasks', 'user', 'progressTasks', 'doneTasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'status' => 'required|in:todo,progress,done'
    ]);

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
        'status' => $request->status,
        'user_id' => auth()->id()
    ]);

    return redirect()->back();
}

public function update(Request $request, Task $task)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'status' => 'required|in:todo,progress,done'
    ]);

    $task->update($request->all());
    return redirect()->back();
}

public function destroy(Task $task)
{
    $task->delete();
    return redirect()->back();
}
}