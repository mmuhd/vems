<?php

namespace App\Jobs;

// use App\AppMeta;
use App\Landlord;
use App\Http\Helpers\AppHelper;
use App\Mail\LandlordRent;
use App\Notice;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PushLandlordRentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $landlordIds = [];
    private $deedstart = '';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($landlordIds, $deedstart)
    {
        $this->landlordIds = $landlordIds;
        $this->deedstart = $deedstart;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //check if notification need to send?
        $sendNotification = AppHelper::getAppSettings('landlord_rent_notification', true);
        if($sendNotification != "0") {

            if($sendNotification == "1"){
                //then send sms notification
                //get sms gateway information
                $gateway = AppMeta::where('id', AppHelper::getAppSettings('landlord_rent_gateway', true))->first();
                if(!$gateway){
                    Log::channel('landlordrentlog')->error("SMS Gateway not setup!");
                    return;
                }

                $this->makeNotificationJob($gateway);

            }

            if($sendNotification == "2"){
                //then send email notification
                $this->makeNotificationJob();
            }
        }
    }


    private function makeNotificationJob($gateway=null) {

        //decode if have $gateway
        if($gateway){
            $gateway = json_decode($gateway->meta_value);
        }

        $deedstart = date('d/m/Y', strtotime($this->$deedstart));
        //pull students
        $landlords = $this->getLandlords();

        //get sms template information
        $template = Notice::where('NoticeType', 'landlord')->where('name', 'RENT')->where('format', 'SMS')->first();
        if(!$template){
            Log::channel('landlordrentlog')->error("Template not setup!");
            return;
        }


        foreach ($landlords as $landlord){

            $keywords = $landlord->toArray();
            $keywords['date'] = $deedstart;
            $keywords['flat'] = $customer->flat->name;
            $keywords['project'] = $customer->project->name;
            $keywords['rent'] = $customer->rent->rent;
            $keywords['landlord'] = $keywords['firstname']['lastname'];
            unset($keywords['firstname']);

            $msg = $template->message;
            $subject = $template->subject;
            $message= "".$subject."%0A".$msg."";


         //   $message = $template->content;
            foreach ($keywords as $key => $value) {
                $message = str_replace('{{' . $key . '}}', $value, $message);
            }

            if($gateway) {
                $cellNumber = AppHelper::validateCellNo($landlord->cellNo);
                if ($cellNumber) {
                    //send to a job handler
                    ProcessSms::dispatch($gateway, $cellNumber, $message)->onQueue('sms');
                } else {
                    Log::channel('smsLog')->error("Invalid Cell No! " . $landlord->cellNo);
                }
            }
            else{
                // make email notification jobs here
                //check if have email for this employee
                if(strlen($landlord->email)){
                    //send to a job handler
                    $emailBody = (new LandlordRent($message))
                        ->onQueue('email');

                    Mail::to($landlord->email)
                        ->queue($emailBody);
                }
                else{
                    Log::channel('landlordrentlog')->error("Landlord \" ".$landlord->firstname ."\" has no email address!");
                }
            }
        }
    }

    private function getLandlords(){

        return Landlord::whereIn('id', $this->landlordIds)
            ->where('status', AppHelper::ACTIVE)
            ->with(['flat' => function($query) {
                $query->select('name','id');
            }])
            ->with(['property' => function($query) {
                $query->select('name','id');
            }])
            ->with(['rent' => function($query) {
                $query->select('name','id');
            }])
         //   ->with('user')
            ->select('*')
            ->get();
    }
}
