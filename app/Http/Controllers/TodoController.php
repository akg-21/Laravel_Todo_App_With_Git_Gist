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
        $completedCount=DB::table('todos')->where('todo_status',1)->count();
        $pendingCount=DB::table('todos')->where('todo_status',0)->count();
        $tododata = Todo::where('project_id','=',$id)->first();
        $alltodo=DB::table('todos')->where('project_id','=',$id)->get();
        $projectdata=projects::where('project_id','=',$id)->first();
        // dd($tododata);
        $todoeditdata=null;
        return view("todo", compact("tododata","alltodo","projectdata","completedCount","pendingCount","todoeditdata"));
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
        'todoTitle'=>'required',
        'todoDescription'=>'required',
        'project_id'=>'required'
        ]);
        $todo->todo_name= $request->todoTitle;
        $todo->todo_Description= $request->todoDescription;
        $todo->project_id= $request->project_id;
        $todo->todo_status=0;
        $todo->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $todoeditdata=todo::where('todo_id','=',$id)->first();

        // // dd($todoeditdata);
        // $projectdata=null;
        return view('todo',compact('todoeditdata','projectdata'));
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
    public function update(Request $request, todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        DB::table('todos')->where('todo_id',$id)->delete();
        return redirect()->back();
    }
    public function statusUp(string $id)
    {
        // dd($id);
        $data=todo::where('todo_id','=',$id)->first();
        if($data->todo_status== 0){
            todo::where('todo_id','=',$id)->update(['todo_status'=> 1]);
        }
        else{
            todo::where('todo_id','=',$id)->update(['todo_status'=> 0]);
        }
        return redirect()->back();
    }
}
