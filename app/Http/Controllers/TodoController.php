<?php

namespace App\Http\Controllers;

use App\Models\projects;
use App\Models\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $completedCount = DB::table('todos')->where('todo_status', 1)->where('deleted', 0)->count();
        $pendingCount = DB::table('todos')->where('todo_status', 0)->where('deleted', 0)->count();
        $tododata = Todo::where('project_id', '=', $id)->first();
        $alltodo = DB::table('todos')->where('project_id', '=', $id)->get();
        $projectdata = projects::where('project_id', '=', $id)->first();
        // dd($tododata);
        $todoeditdata = null;
        return view("todo", compact("tododata", "alltodo", "projectdata", "completedCount", "pendingCount", "todoeditdata"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $todo = new Todo();
        $request->validate([
            'todoTitle' => 'required',
            'todoDescription' => 'required',
            'project_id' => 'required'
        ]);
        $todo->todo_name = $request->todoTitle;
        $todo->todo_Description = $request->todoDescription;
        $todo->project_id = $request->project_id;
        $todo->todo_status = 0;
        $todo->deleted = 0;
        $todo->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $todo_id)
    {
        $todoeditdata = todo::where('todo_id', '=', $todo_id)->first();
        // dd($todoeditdata);
        $projectdata = null;
        // return route('view_todo', $todoeditdata);

        return view('todo', compact('todoeditdata', 'projectdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'todoTitle' => 'required',
            'todoDescription' => 'required',
            'project_id' => 'required',
            'todo_id' => 'required'
        ]);
        todo::where('todo_id', '=', $request->todo_id)->update(['todo_name' => $request->todoTitle, 'todo_Description' => $request->todoDescription, 'project_id' => $request->project_id,]);
        return redirect()->route('view_todo', $request->project_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        // DB::table('todos')->where('todo_id', $id)->delete();
        todo::where('todo_id', '=', $id)->update(['deleted' => 1]);
        return redirect()->back();
    }
    public function statusUp(string $id)
    {
        // dd($id);
        $data = todo::where('todo_id', '=', $id)->first();
        if ($data->todo_status == 0) {
            todo::where('todo_id', '=', $id)->update(['todo_status' => 1]);
        } else {
            todo::where('todo_id', '=', $id)->update(['todo_status' => 0]);
        }
        return redirect()->back();
    }
    public function setdeleted(string $id)
    {
        $data = todo::where('todo_id', '=', $id)->first();
        if ($data->deleted == 0) {
            todo::where('todo_id', '=', $id)->update(['deleted' => 1]);
        } else {
            todo::where('todo_id', '=', $id)->update(['deleted' => 0]);
        }

        return redirect()->route('view');
    }
}
