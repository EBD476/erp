<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return view('projects.index',['projects' => $projects]);
    }

    public function create() {
        return view('projects.create');
    }

    public function store(Request $request) {

//        $this->validate($request,[
//            'Name' => 'required' ,
//        ]);

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

        return redirect()->route('projects.index');

    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id)
    {

    }

}
