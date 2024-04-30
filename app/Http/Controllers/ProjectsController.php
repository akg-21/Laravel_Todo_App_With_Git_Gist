<?php

namespace App\Http\Controllers;

use App\Models\projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table=DB::table('projects')->get();
        $editdata=null;
        $completedCount=DB::table('projects')->where('status',1)->count();
        $pendingCount=DB::table('projects')->where('status',0)->count();

        return view("project",compact("table","editdata","completedCount","pendingCount"));
 
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
       $request->validate(['project_name'=>'required']);
       $projects = new Projects();
       $projects->name = $request->project_name;
       $projects->status=0;
       $projects->save();
       return redirect()->route('view');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $editdata=projects::where('id','=',$id)->first();
        return view('project',compact('editdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());   
       $request->validate(['project_name'=> 'required']);
        projects::where('id','=',$request->id)->update(['name'=> $request->project_name]);
        return redirect()->route('view');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('projects')->where('id',$id)->delete();
        return redirect()->back();
    }
    public function statusUp(string $id)
    {
        // dd($id);
        $data=projects::where('id','=',$id)->first();
        if($data->status== 0){
            projects::where('id','=',$id)->update(['status'=> 1]);
        }
        else{
            projects::where('id','=',$id)->update(['status'=> 0]);
        }
        
        return redirect()->route('view');
    }
}
