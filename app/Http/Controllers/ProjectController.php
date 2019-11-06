<?php

namespace App\Http\Controllers;

use App\Project;
use App\Project_State;
use App\Project_Type;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return view('projects.index',compact('projects'));
    }

    public function create() {
        $projects_type=Project_Type::ALL();
        $projects=Project_State::ALL();
        return view('projects.create',compact('projects','projects_type'));
    }

    public function store(Request $request) {

        $this->validate($request,[
            'project_name' => 'required' ,
            'project_owner' => 'required' ,
            'owner_phone' => 'required' ,
            'project_type' => 'required' ,
            'project_units' => 'required' ,
            'project_address' => 'required' ,
            'project_location' => 'required' ,
//            'project_options' => 'required' ,
            'project_completed' => 'required' ,
            'project_complete_date' => 'required' ,
            'project_description' => 'required' ,
        ]);

        $Project = new Project();
        $Project->hp_project_name = $request->project_name;
        $Project->hp_project_owner = $request->project_owner;
        $Project->hp_project_owner_phone = $request->owner_phone;
        $Project->hp_project_type = $request->project_type;
        $Project->hp_project_units = $request->project_units;
        $Project->hp_project_address = $request->project_address;
        $Project->hp_project_location = $request->project_location;
        $Project->hp_project_options = $request->project_options;
        $Project->hp_project_completed = $request->project_completed;
        $Project->hp_project_complete_date = $request->project_complete_date;
        $Project->hp_project_description = $request->project_description;
        $Project->save();

        return json_encode(["response"=>"OK"]);

    }

    public function show($id) {

    }

    public function edit($id) {
        $projects_state=Project_State::all();
        $projects_type=Project_Type::ALL();
        $project=Project::find($id);
        return view('projects.edit',compact('project','projects_type','projects_state'));

    }

    public function update(Request $request, $id) {
        $this->validate($request,[
            'project_name' => 'required' ,
            'project_owner' => 'required' ,
            'owner_phone' => 'required' ,
            'project_type' => 'required' ,
            'project_units' => 'required' ,
            'project_address' => 'required' ,
            'project_location' => 'required' ,
//            'project_options' => 'required' ,
            'project_completed' => 'required' ,
            'project_complete_date' => 'required' ,
            'project_description' => 'required' ,
        ]);

        $Project =Project::find($id);
        $Project->hp_project_name = $request->project_name;
        $Project->hp_project_owner = $request->project_owner;
        $Project->hp_project_owner_phone = $request->owner_phone;
        $Project->hp_project_type = $request->project_type;
        $Project->hp_project_units = $request->project_units;
        $Project->hp_project_address = $request->project_address;
        $Project->hp_project_location = $request->project_location;
        $Project->hp_project_options = $request->project_options;
        $Project->hp_project_completed = $request->project_completed;
        $Project->hp_project_complete_date = $request->project_complete_date;
        $Project->hp_project_description = $request->project_description;
        $Project->save();
        return view('projects.index');
    }

    public function destroy($id)
    {
        $Project=Project::find($id);
        $Project->delete();
        return redirect()->back();

    }

}
