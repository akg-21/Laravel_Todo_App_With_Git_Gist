<?php

namespace App\Http\Controllers;

use App\Models\recycle;
use App\Models\projects;
use App\Models\todo;
use Illuminate\Http\Request;

class RecycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = projects::where("deleted", 1)->get();
        $todos = todo::where("deleted", 1)->get();
        return view("recycle", compact("todos", "projects"));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(recycle $recycle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(recycle $recycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, recycle $recycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(recycle $recycle)
    {
        //
    }
    public function restoreproject(string $id)
    {
        projects::where('project_id', '=', $id)->update(['deleted' => 0]);
        return redirect()->back();
    }
    public function restoretodos(string $id)
    {
        todo::where('todo_id', '=', $id)->update(['deleted' => 0]);
        return redirect()->back();
    }
    public function restoreall()
    {
        todo::where('deleted', '=', 1)->update(['deleted' => 0]);
        projects::where('deleted', '=', 1)->update(['deleted' => 0]);
        return redirect()->back();
    }
    public function deleteall()
    {
        todo::where('deleted', '=', 1)->update(['deleted' => 2]);
        projects::where('deleted', '=', 1)->update(['deleted' => 2]);
        return redirect()->route('view');
    }
}
