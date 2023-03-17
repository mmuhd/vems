<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Remittance;
use App\RemittanceItem;
use App\project;
use App\Landlord;
use Carbon\Carbon;
use DB;
class RemittanceController extends Controller
{
    public function create()
    {
        // landlord queryBuilder invoker from remittance
        $landlords = Landlord::select(DB::raw("concat(name,'-',cellNo) as text"),"id")->where('active','Yes')->pluck('text','id');
        $landlords->prepend('','');
        // agencyFee queryBuilder invoker from remittance
        // $projects = project::pluck('agencyFee')->where('projects_id',$projects_id);

        $today = Carbon::today();        
        $remittanceTotal = Remittance::count()+1;
        $remittanceNo = "RT";
        if($remittanceTotal<10){
            $remittanceNo .= "00".(string)$remittanceTotal;
        }
        elseif($remittanceTotal<100){
            $remittanceNo .= "0".(string)$remittanceTotal;
        }
        else{
            $remittanceNo .= (string)$remittanceTotal;
        }
        return view('remittance.create',compact('today','remittanceNo','landlords'));
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'projects_id' => 'required|integer',
            'landlords_id' => 'required',
            'remittanceNo' => 'required',
            'entryDate' => 'required',
            'items' => 'required',
            'amounts' => 'required'
        ]);

        $items = $request->get('items');
        $amounts = $request->get('amounts');
        $data = $request->all();
        $data['users_id'] = auth()->user()->id;

        DB::beginTransaction();
        try {
            try {
                $remittance = remittance::create($data);
            }catch(\Exception $e)
            {
                DB::rollback();
                throw $e;
            }

            $totalAmount = 0;
            $dataItems = [];
            foreach ($items as $index => $item){
                $dataItem = [
                    'remittances_id' => $remittance->id,
                    'name' => $item,
                    'amount' => $amounts[$index]
                ];
                $totalAmount += $amounts[$index];
                array_push($dataItems,$dataItem);
            }
            $remittance->amount = $totalAmount;
            $remittance->save();

            try{
                RemittanceItem::insert($dataItems);
            }catch(\Exception $e)
            {
                DB::rollback();
                throw $e;
            }

        }
        catch(\Exception $e){
            $trimmed = str_replace(array("\r", "\n","'","`"), ' ', $e->getMessage());
            $notification= array('title' => 'Data Store Failed', 'body' => $trimmed);
            return redirect()->route('remittance.create')->with("error",$notification);
        }
        DB::commit();

        $notification= array('title' => 'Data Store', 'body' => 'remittance added successfully');
        return redirect()->route('remittance.index')->with('success',$notification);
    }

     public function index(Request $request)
    {
        $landlords = Landlord::pluck('name','id');
        $landlords->prepend('All','All');
        $name = $request->has('name') ? $request->input('name') : "";
        $projectType = $request->has('projectType') ? $request->input('projectType') : null;
        $landlord = $request->has('landlords_id') ? $request->input('landlords_id') : null;


        $query = project::query();
        if(strlen($name)){
            $query = $query->where('name','like','%'.$name.'%');
        }
        if($projectType && $projectType != "All"){
            $query = $query->where('projectType',$projectType);
        }

        if($landlord && $landlord != "All"){
            $query = $query->where('landlords_id',$landlord);
        }

        $remittances = remittance::orderBy('created_at','desc')->with('project')->with('entry')->paginate(10);
        return view('remittance.index',compact('remittances'));
    }

    public function show($id)
    {
        $remittance = remittance::with('item')->findOrFail($id);
        return $remittance;
    }

    public function destroy($id)
    {
        $remittance = remittance::findOrFail($id);
        $remittance->delete();
        $notification= array('title' => 'Data Remove', 'body' => 'remittance deleted Successfully');
        return redirect()->route('remittance.index')->with('success',$notification);
    }

    public function agencyFeeByProject($project)
    {
        return project::select('id','description AS value')->where('agencyFee',$project)->where('status',0)->get();

    }

 
  
}
