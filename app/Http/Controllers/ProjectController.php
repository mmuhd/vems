<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\project;
use App\Landlord;
use App\Area;
use Storage;
use DB;

class projectController extends Controller
{
    public function create()
    {
        $areas = Area::pluck('name','id');
        $today = Carbon::today();
        $landlords = Landlord::select(DB::raw("concat(name,'-',cellNo) as text"),"id")->where('active','Yes')->pluck('text','id');
        $landlords->prepend('','');

        return view('project.create',compact('areas','today','landlords'));
    }
    public function store(Request $request)
    {

        //validate form
        $this->validate($request, [
            'projectId' => 'required|min:2|max:255',
            'projectType' => 'required',
            'name' => 'min:2|max:255',
            'lat' => 'min:4|max:20',
            'photo' => 'mimes:jpeg,bmp,png,gif,svg',
            'lang' => 'min:4|max:20',
            'photo' => 'mimes:jpeg,bmp,png,gif,svg',
            'entryDate' => 'required',
            'areas_id' => 'required',
            'landlords_id' => 'required',
            'address' => 'min:2|max:500',
            'description' => 'max:1000',
            'storied' => 'min:2|max:500',
            'noOfUnits' => 'required|numeric',
            'noOfFloor' => 'required|numeric',
            'noOfCarParking' => 'required|numeric',
            'agencyFee' => 'required',
            'unitSize' => 'numeric',
            'lift' => 'required',
            'generator' => 'required',
        ]);
        $data = $request->all();
        if(request()->hasFile('photo'))
          $data['photo']=request()->file('photo')->store('projects');
        $data['users_id'] = auth()->user()->id;
        project::create($data);
        $notification= array('title' => 'Data Store', 'body' => 'Property Created Successfully');
        return redirect()->route('project.create')->with('success',$notification);
    }

    public function index(Request $request)
    {
        $areas = Area::pluck('name','id');
        $landlords = Landlord::pluck('name','id');
        $areas->prepend('All','All');
        $landlords->prepend('All','All');
        $name = $request->has('name') ? $request->input('name') : "";
        $lat = $request->has('lat') ? $request->input('lat') : "";
        $lang = $request->has('lang') ? $request->input('lang') : "";
        $projectType = $request->has('projectType') ? $request->input('projectType') : null;
        $area = $request->has('areas_id') ? $request->input('areas_id') : null;
        $landlord = $request->has('landlords_id') ? $request->input('landlords_id') : null;


        $query = project::query();
        if(strlen($name)){
            $query = $query->where('name','like','%'.$name.'%')->orWhere('projectId','like','%'.$name.'%');
        }
        if($projectType && $projectType != "All"){
            $query = $query->where('projectType',$projectType);
        }

        if($area && $area != "All"){
            $query = $query->where('areas_id',$area);
        }
        if($landlord && $landlord != "All"){
            $query = $query->where('landlords_id',$landlord);
        }


        $projects = $query->orderBy('created_at','desc')->with('area')->paginate(10);
        return view('project.index',compact('projects','name','projectType','area','areas'));
    }

    public function show($id)
    {
        $project = project::with('entry')->findOrFail($id);
        $lid = project::select("landlords_id")->where('id',$id)->get();
        $lidb = Landlord::select("id")->where('id', $lid)->get();
        $landlord = project::with('entry')->findOrFail($lidb);
        return view('project.show',compact('project','landlord'));
    }
    public function edit($id)
    {
        $landlords = Landlord::pluck('name','id');
        $areas = Area::pluck('name','id');
        $project = project::findOrFail($id);
        return view('project.edit',compact('project','areas','landlords'));
    }
    public function update(Request $request,$id)
    {
        //validate form
        $this->validate($request, [
            'projectId' => 'required|min:2|max:255',
            'projectType' => 'required',
            'name' => 'min:2|max:255',
            'lat' => 'min:4|max:20',
            'lang' => 'min:4|max:20',
            'entryDate' => 'required',
            'areas_id' => 'required',
            'address' => 'min:2|max:500',
            'description' => 'max:1000',
            'storied' => 'min:2|max:500',
            'noOfUnits' => 'required|numeric',
            'noOfFloor' => 'required|numeric',
            'noOfCarParking' => 'required|numeric',
            'unitSize' => 'numeric',
            'lift' => 'required',
            'generator' => 'required',
        ]);
        $project = project::findOrFail($id);
        if(request()->hasFile('photo'))
          $data['photo']=request()->file('photo')->store('projects');
        $project->fill($request->all())->update();
        $notification= array('title' => 'Data Update', 'body' => 'property updated Successfully');
        return redirect()->route('project.index')->with('success',$notification);
    }
    public function destroy($id)
    {
        $project = project::findOrFail($id);
        $project->delete();
        $notification= array('title' => 'Data Remove', 'body' => 'property deleted Successfully');
        return redirect()->route('project.index')->with('success',$notification);
    }

    public function projectByType($ptype)
    {
        return project::select('id','name AS value')->where('projectType',$ptype)->get();

    }

    public function getDisplay($id)
    {
        $project = project::with('entry')->findOrFail($id);
        $lid = project::select("landlords_id")->where('id',$id)->get();
        $lidb = Landlord::select("id")->where('id', $lid)->get();
        $landlord = project::with('entry')->findOrFail($lidb);
        return view('project.show',compact('project','landlord'));
    }
}
