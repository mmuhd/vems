<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Rent;
use App\RentCollection;
use App\Flat;
use DB;
use Storage;
use App\project;
use App\MyNotify;


class RenewController extends Controller
{
    public function index()
    {
        $rents = Rent::orderBy('deedEnd','asc')->with('project')->with('flat')->with('entry')->paginate(10);
        
        return view('renew.index',compact('rents'));
    }

    public function show($id)
    {
        $rent = Rent::with('project')->with('flat')->with('entry')->findOrFail($id);
        return $rent;
    }
    public function edit($id)
    {
        $rent = Rent::with('flat')->findOrFail($id);
        $today = Carbon::today();
        $cid = Rent::select('customers_id')->where('id', $id)->first();
        $pid = Rent::select('projects_id')->where('id', $id)->first();
        $fid = Rent::select('flats_id')->where('id', $id)->first();
        
        $customer = Customer::select(DB::raw("concat(name, companyName,'-',cellNo, cCellNo) as text"),"id")->where('active','Yes')->where('id',$cid->customers_id)->first('text','id');

        $project = project::select(DB::raw("concat(name, '-',projectType) as text"),"id")->where('id',$pid->projects_id)->first('text','id');

        $flat = Flat::select(DB::raw("concat(description) as text"),"id")->where('id',$fid->flats_id)->first('text','id');


        $End= Rent::select('deedEnd')->where('id', $id)->first();
        $newDeedEnd = date('d/m/Y', strtotime("+12 months $End->deedEnd"));

        $Start= Rent::select('deedStart')->where('id', $id)->first();
        $newDeedStart = date('d/m/Y', strtotime("+12 months $Start->deedStart"));

        $rentTotal = DB::table('rents')->count()+1;
        $rentNo = "R";
        if($rentTotal<10){
            $rentNo .= "00".(string)$rentTotal;
        }
        elseif($rentTotal<100){
            $rentNo .= "0".(string)$rentTotal;
        }
        else{
            $rentNo .= (string)$rentTotal;
        }
        return view('renew.edit',compact('rent','rentNo','today','flat','project','customer','newDeedStart','newDeedEnd'));
    }
    public function update(Request $request,$id)
    {
        //validate form
        $this->validate($request, [
            'projects_id' => 'required',
            'flats_id' => 'required',
            'customers_id' => 'required',
            'entryDate' => 'required',
            'deedStart' => 'required',
            'deedEnd' => 'required',
            'rentNo' => 'required',
            'rent' => 'required|numeric',
            'securityMoney' => 'numeric',
            'advanceMoney' => 'numeric',
            'monthlyDeduction' => 'numeric',
            'monthlyDeductionTax' => 'numeric',
            'utilityCharge' => 'numeric',
            'serviceCharge' => 'numeric',
            'delayCharge' => 'numeric',
            'note' => 'max:1000',
            'deedPaper' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
            'othersPaper' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
        ]);
        $data = $request->all();
        $data['users_id'] = auth()->user()->id;
        if(request()->hasFile('deedPaper')) {
            $data['deepPaper'] = request()->file('deedPaper')->store('rents');
        }
        if(request()->hasFile('othersPaper')) {
            $data['othersPaper'] = request()->file('othersPaper')->store('rents');
        }

        $rent = Rent::findOrFail($id);
        $rent->delete();
        Rent::create($data);
        $flat = Flat::where('id',$data['flats_id'])->first();
        $flat->status = 1;
        $flat->save();
        $notification= array('title' => 'Data Update', 'body' => 'Rent Renewed Successfully');
        return redirect()->route('renew.index')->with('success',$notification);
    }

    public function destroy($id)
    {
        $rent = Rent::findOrFail($id);
        $flat = Flat::where('id',$rent->flats_id)->first();
        $flat->status = 0;
        $rent->delete();
        $flat->save();
        if($flat->status == 0){
            //notification code
            $project = project::where('id',$flat->projects_id)->first();
            $myNoti = new MyNotify();
            $myNoti->title = $project->name;
            $myNoti->value = $flat->description;
            $myNoti->notiType = "tolet";
            $myNoti->save();
            //end mynoti
        }
        $notification= array('title' => 'Data Remove', 'body' => 'Rent Terminated Successfully');
        return redirect()->route('renew.index')->with('success',$notification);
    }

    public function customerByproject ($projectId){
        $rents = Rent::with('customer')->where('projects_id',$projectId)->where('status',1)->get();
        $rentedCustomers = [];
        foreach ($rents as $rent){
            $rentCustomer = [
              'value' =>$rent->customer->id,
                'text' => $rent->customer->name."[".$rent->customer->cellNo."]"
            ];
            array_push($rentedCustomers,$rentCustomer);
        }
        return $rentedCustomers;

    }
    public function flatsByCustomer ($customerId,$projectId){
        $rents = Rent::with('flat')->where('customers_id',$customerId)->where('projects_id',$projectId)->where('status',1)->get();
        $rentedFlats = [];
        foreach ($rents as $rent){
            $rentFlat = [
              'value' => $rent->id,
                'text' => $rent->flat->description
            ];
            array_push($rentedFlats,$rentFlat);
        }
        return $rentedFlats;

    }
}
