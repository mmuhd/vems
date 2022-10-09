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
use App\Notice;
use App\Noticelog;
use DB;
use Storage;


class NoticeController extends Controller
{
  public function create()
    {
        $today = Carbon::now();
        $noticeTotal = DB::table('notices')->count()+1;
        $noticeNo = "NTC";
        if($noticeTotal<10){
            $noticeNo .= "00".(string)$noticeTotal;
        }
        elseif($noticeTotal<100){
            $noticeNo .= "0".(string)$noticeTotal;
        }
        else{
            $noticeNo .= (string)$noticeTotal;
        }

        return view('notice.create',compact('today','noticeNo'));
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'format' => 'required',
            'noticeType' => 'required',
            'name' => 'max:100|min:4',
            'subject' => 'max:100',
            'message' => 'max:5000',
            'entryDate' => 'required',
          //  'noticeNo' => 'required',
        ]);
        $data = $request->all();
        $data['users_id'] = auth()->user()->id;
        Notice::create($data);
        $notification= array('title' => 'Data Update', 'body' => 'Notice created Successfully');
        return redirect()->route('notice.create')->with('success',$notification);
    }

    public function index(Request $request)
    {
        $name = $request->has('name') ? $request->input('name') : "";
        $subject = $request->has('subject') ? $request->input('subject') : "";
        $query = Notice::query();

        if(strlen($name)){
            $query = $query->where('name','like','%'.$name.'%');
        }
        if(strlen($subject)){
            $query = $query->Where('subject',$subject);
        }


        $notices = $query->orderBy('created_at','desc')->paginate(10);

        return view('notice.index',compact('notices','name','subject','page'));
    }

    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('notice.edit',compact('notice'));

    }
    public function update(Request $request,$id)
    {
        //validate form
        $this->validate($request, [
           'format' => 'required',
            'noticeType' => 'required',
            'name' => 'max:100|min:4',
            'subject' => 'max:100',
            'message' => 'max:5000',
            'entryDate' => 'required',
          //  'noticeNo' => 'required', 
        ]);

        $notice = Notice::findOrFail($id);
        if($notice->subject != $request->get('subject')){
            $existsSubject = Notice::where('subject',$request->get('subject'))->get();
            if(count($existsSubject)){
                $errors = new MessageBag();
                $errors->add('subject', 'this Notice Subject already exist!');
                return Redirect::back()->withErrors($errors->all());
            }
        }
        $data = $request->all();
        
        $notice->fill($data)->update();
        $notification= array('title' => 'Data Update', 'body' => 'Notice updated Successfully');
        return redirect()->route('notice.index')->with('success',$notification);
    }
    public function show($id){
        $today = Carbon::now();
      $notice = Notice::with('entry')->findOrFail($id);
      $customers = Customer::select(DB::raw("concat(name, companyName,'-',cellNo, cCellNo, '-',email,cEmail) as text"),"id")->where('active','Yes')->pluck('text','id');
        $customers->prepend('','','');
        $landlords = Landlord::select(DB::raw("concat(name, companyName,'-',cellNo, cCellNo, '-',email,cEmail) as text"),"id")->where('active','Yes')->pluck('text','id');
        $landlords->prepend('','','');
        
      return view('notice.show',compact('today','notice', 'customers', 'landlords'));
    }

    public function log(Request $request)
    {
        //validate form
        $this->validate($request, [
            'format' => 'required',
            'noticeType' => 'required',
            'name' => 'max:100|min:4',
            'notices_id' => 'required',
            'customers_id' => '',
            'landlords_id' => '',
            'subject' => 'max:100',
            'message' => 'max:5000',
            'entryDate' => 'required',
          //  'noticeNo' => 'required',
        ]);
        $data = $request->all();
        
      
           if($data['format']=='SMS'){
                        $phonenumber = $data['cellNo'];
                        //$sender = $data['sender'];
                        $msg =rawurlencode($data['message']);
                        $subject =rawurlencode($data['subject']);
                        $url= "sms:/*+234".$phonenumber."*/?&body=".$subject."%0A".$msg."";
                        $data['users_id'] = auth()->user()->id;               
        $data['status'] = 'Sent';
        Noticelog::create($data);
        $notification= array('title' => 'Data Update', 'body' => 'Notice Pushed Successfully');
                        return Redirect::away($url);
                        }
            elseif($data['format']=='WhatsApp'){
                $phonenumber = $data['cellNo'];
                        //$sender = $data['sender'];
                        $msg =rawurlencode($data['message']);
                        $subject =rawurlencode($data['subject']);
                        $url= "https://wa.me/+234".$phonenumber."?&text=*".$subject."*%0A".$msg."";
                        $data['users_id'] = auth()->user()->id;               
        $data['status'] = 'Sent';
        Noticelog::create($data);
        $notification= array('title' => 'Data Update', 'body' => 'Notice Pushed Successfully');
                        return Redirect::away($url);
                            }
            else{
                        $email = $data['email'];
                        //$sender = $data['sender'];
                        $msg =rawurlencode($data['message']);
                        $subject =rawurlencode($data['subject']);
                        $url= "mailto:".$email."?&subject=".$subject."&body=".$msg."";
                        $data['users_id'] = auth()->user()->id;               
        $data['status'] = 'Sent';
        Noticelog::create($data);
        $notification= array('title' => 'Data Update', 'body' => 'Notice Pushed Successfully');
                        return Redirect::away($url);
                        
                            }
                        
        
        $notification= array('title' => 'Data Update', 'body' => 'Notice Push Failed');
        return redirect()->route('notice.index')->with('error',$notification);
    }

    public function logindex(Request $request)
    {
        $cellNo = $request->has('cellNo') ? $request->input('cellNo') : "";
        $email = $request->has('email') ? $request->input('email') : "";
        $query = Noticelog::query();

        if(strlen($cellNo)){
            $query = $query->where('cellNo','like','%'.$cellNo.'%');
        }
        if(strlen($email)){
            $query = $query->Where('email',$email);
        }


        $noticelogs = $query->orderBy('created_at','desc')->paginate(10);

        return view('notice.logindex',compact('noticelogs','cellNo','email','page'));
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();
        $notification= array('title' => 'Data Remove', 'body' => 'Notice deleted Successfully');
        return redirect()->route('notice.index')->with('success',$notification);
    }

    public function noticeAjax ($noticeId){
        return Notice::findOrFail($noticeId);
    }
}
