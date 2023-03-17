<?php

namespace App\Http\Controllers;

use App\Flat;
use App\Rent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Landlord;
use Storage;
use DB;


class LandlordController extends Controller
{
  public function create()
    {
        $today = Carbon::now();
        
        return view('landlord.create',compact('today'));
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'name' => 'required|max:100|min:4',
            'landlordType' => 'required',
            'cellNo' => 'required|max:11|min:11|unique:landlords',
            'phoneNo' => 'max:15',
            'email' => 'max:100',
            'contactPerson' => 'max:100',
            'contactPersonCellNo' => 'max:11',
            'fatherName'=> 'max:100',
            'motherName'=> 'max:100',
            'spouseName'=> 'max:100',
            'NUBAN' => 'max:10',
            'nidNo' => 'max:50',
            'passportNo' => 'max:50',
            'mailingAddress' => 'max:500',
            'presentAddress' => 'max:500',
            'permanentAddress' => 'max:500',
            'passport' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
            'photo' => 'mimes:jpeg,bmp,png,gif,svg',
            'companyName' => 'max:100',
            'designation' => 'max:100',
            'cContactPerson' => 'max:100',
            'cContactPersonCellNo' => 'max:11',
            'cCellNo' => 'max:11',
            'cPhoneNo' => 'max:15',
            'cFaxNo' => 'max:15',
            'cEmail' => 'max:100',
            'cAddress' => 'max:500',
            'cNote' => 'max:1000',
            'entryDate' => 'required',

        ]);
        $data = $request->all();
        if(request()->hasFile('photo'))
          $data['photo']=request()->file('photo')->store('landlords');

        if(request()->hasFile('birthCertificate'))
          $data['birthCertificate']=request()->file('birthCertificate')->store('landlords');

        if(request()->hasFile('passport'))
          $data['passport']=request()->file('passport')->store('landlords');
        $data['users_id'] = auth()->user()->id;
        Landlord::create($data);
        $notification= array('title' => 'Data Update', 'body' => 'Landlord created Successfully');
        return redirect()->route('landlord.create')->with('success',$notification);
    }

    public function index(Request $request)
    {
        $name = $request->has('name') ? $request->input('name') : "";
        $mobileNo = $request->has('mobileNo') ? $request->input('mobileNo') : "";
        $query = Landlord::query();

        if(strlen($name)){
            $query = $query->where('name','like','%'.$name.'%');
        }
        if(strlen($mobileNo)){
            $query = $query->Where('cellNo',$mobileNo);
        }


        $landlords = $query->orderBy('created_at','desc')->paginate(10);

        return view('landlord.index',compact('landlords','name','mobileNo','page'));
    }

    public function edit($id)
    {
        $landlord = Landlord::findOrFail($id);
        return view('landlord.edit',compact('landlord'));

    }
    public function update(Request $request,$id)
    {
        //validate form
        $this->validate($request, [
            'name' => 'required|max:100|min:4',
            'phoneNo' => 'max:15',
            'email' => 'max:100',
            'contactPerson' => 'max:100',
            'contactPersonCellNo' => 'max:11',
            'fatherName'=> 'max:100',
            'motherName'=> 'max:100',
            'spouseName'=> 'max:100',
            'NUBAN' => 'max:10',
            'nidNo' => 'max:50',
            'passportNo' => 'max:50',
            'mailingAddress' => 'max:500',
            'presentAddress' => 'max:500',
            'permanentAddress' => 'required|max:500',
            'birthCertificate' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
            'passport' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
            'photo' => 'mimes:jpeg,bmp,png,gif,svg',
            'companyName' => 'max:100',
            'designation' => 'max:100',
            'cContactPerson' => 'max:100',
            'cContactPersonCellNo' => 'max:11',
            'cCellNo' => 'max:11',
            'cPhoneNo' => 'max:15',
            'cFaxNo' => 'max:15',
            'cEmail' => 'max:100',
            'cAddress' => 'max:500',
            'cNote' => 'max:1000',
        ]);

        $landlord = Landlord::findOrFail($id);
        if($landlord->cellNo != $request->get('cellNo')){
            $existsNumber = Landlord::where('cellNo',$request->get('cellNo'))->get();
            if(count($existsNumber)){
                $errors = new MessageBag();
                $errors->add('cellNo', 'this mobile number belongs to another landlord!');
                return Redirect::back()->withErrors($errors->all());
            }
        }
        $data = $request->all();
        if(request()->hasFile('photo')) {
            Storage::Delete($landlord->photo);
            $data['photo'] = request()->file('photo')->store('landlords');
        }

        if(request()->hasFile('birthCertificate')) {
            Storage::Delete($landlord->birthCertificate);
            $data['birthCertificate'] = request()->file('birthCertificate')->store('landlords');
        }

        if(request()->hasFile('passport')) {
            Storage::Delete($landlord->passport);
            $data['passport'] = request()->file('passport')->store('landlords');
        }

       
        
        $landlord->fill($data)->update();
        $notification= array('title' => 'Data Update', 'body' => 'Landlord updated Successfully');
        return redirect()->route('landlord.index')->with('success',$notification);
        window.history.go(-1);
    }
    public function show($id){
      $landlord = Landlord::with('entry')->findOrFail($id);
      return view('landlord.show',compact('landlord'));
    }

    public function destroy($id)
    {
        $landlord = Landlord::findOrFail($id);
        $landlord->delete();
        $notification= array('title' => 'Data Remove', 'body' => 'Landlord deleted Successfully');
        return redirect()->route('landlord.index')->with('success',$notification);
    }

    public function landlordAjax ($landlordId){
        return Landlord::findOrFail($landlordId);
    }
}
