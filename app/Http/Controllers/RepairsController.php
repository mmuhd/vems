<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Landlord;
use App\Flat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Repairs;
use DB;
use Storage;


class RepairsController extends Controller
{
  public function create()
    {
        $today = Carbon::now();
        $customers = Customer::select(DB::raw("concat(name,'-',cellNo) as text"),"id")->where('active','Yes')->pluck('text','id');
        $customers->prepend('','');
        $repairsTotal = DB::table('repairs')->count()+1;
        $repairsNo = "RPS";
        if($repairsTotal<10){
            $repairsNo .= "00".(string)$repairsTotal;
        }
        elseif($repairsTotal<100){
            $repairsNo .= "0".(string)$repairsTotal;
        }
        else{
            $repairsNo .= (string)$repairsTotal;
        }

        return view('repairs.create',compact('today','customers','repairsNo'));
    }
    public function store(Request $request)
    {
        //validate form
        //dd($request->all());
        $this->validate($request, [
            'projects_id' => 'required',
            'flats_id' => 'required',
            'customers_id' => 'required',
            'format' => 'required',
            'repairsType' => 'required',
            'subject' => 'max:100',
            'message' => 'max:5000',
            'entryDate' => 'required',
          //  'repairsNo' => 'required',
        ]);
        $data = $request->all();
        if(request()->hasFile('photo'))
          $data['photo']=request()->file('photo')->store('repairs');
        $data['users_id'] = auth()->user()->id;
        Repairs::create($data);
        $notification= array('title' => 'Data Saved', 'body' => 'Repairs created Successfully');
        return redirect()->route('repairs.create')->with('success',$notification);
    }

    public function index(Request $request)
    {
        $name = $request->has('name') ? $request->input('name') : "";
        $subject = $request->has('subject') ? $request->input('subject') : "";
        $query = Repairs::query();

        if(strlen($name)){
            $query = $query->where('name','like','%'.$name.'%');
        }
        if(strlen($subject)){
            $query = $query->Where('subject',$subject);
        }


        $repairss = $query->orderBy('created_at','desc')->with('project')->with('flat')->with('entry')->paginate(10);

        return view('repairs.index',compact('repairss','name','subject','page'));
    }

    public function edit($id)
    {
        $repairs = Repairs::findOrFail($id);
        return view('repairs.edit',compact('repairs'));

    }
    public function update(Request $request,$id)
    {
        //validate form
        $this->validate($request, [
           'format' => 'required',
            'repairsType' => 'required',
            'name' => 'max:100|min:4',
            'subject' => 'max:100',
            'message' => 'max:5000',
            'entryDate' => 'required',
          //  'repairsNo' => 'required', 
        ]);

        $repairs = Repairs::findOrFail($id);
        if($repairs->subject != $request->get('subject')){
            $existsSubject = Repairs::where('subject',$request->get('subject'))->get();
            if(count($existsSubject)){
                $errors = new MessageBag();
                $errors->add('subject', 'this Repairs Subject already exist!');
                return Redirect::back()->withErrors($errors->all());
            }
        }
        $data = $request->all();
        
        $repairs->fill($data)->update();
        $notification= array('title' => 'Data Update', 'body' => 'Repairs updated Successfully');
        return redirect()->route('repairs.index')->with('success',$notification);
    }
    public function show($id){
        $today = Carbon::now();
      $repairs = Repairs::with('entry')->findOrFail($id);
      $customers = Customer::select(DB::raw("concat(name, companyName,'-',cellNo, cCellNo, '-',email,cEmail) as text"),"id")->where('active','Yes')->pluck('text','id');
        $customers->prepend('','','');
        $landlords = Landlord::select(DB::raw("concat(name, companyName,'-',cellNo, cCellNo, '-',email,cEmail) as text"),"id")->where('active','Yes')->pluck('text','id');
        $landlords->prepend('','','');
        
      return view('repairs.show',compact('today','repairs', 'customers', 'landlords'));
    }

    public function destroy($id)
    {
        $repairs = Repairs::findOrFail($id);
        $repairs->delete();
        $notification= array('title' => 'Data Remove', 'body' => 'Repairs deleted Successfully');
        return redirect()->route('repairs.index')->with('success',$notification);
    }

    public function repairsAjax ($repairsId){
        return Repairs::findOrFail($repairsId);
    }
}
