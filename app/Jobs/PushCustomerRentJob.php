<?php

namespace App\Jobs;

use App\AppMeta;
use App\Http\Helpers\AppHelper;
use App\Mail\CustomerRent;
use App\Customer;
use App\Notice;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PushCustomerRentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $customerIds = [];
    private $deedstart = '';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customerIds, $deedstart)
    {
        $this->customerIds = $customerIds;
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
        $sendNotification = 1;
        if($sendNotification != "0") {

            if($sendNotification == "1"){
                //then send sms notification
                //get sms gateway information
                $gateway = 1;
                if(!$gateway){
                    Log::channel('customerrentlog')->error("SMS Gateway not setup!");
                    return;
                }

                $this->makeNotificationJob($gateway);
                $this->makeNotificationJob();

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
            $gateway = 1;
        }

        $deedstart = date('d/m/Y', strtotime($this->deedstart));
        //pull students
        $customers = $this->getCustomer();

        //get sms template information
         $template = Notice::where('NoticeType', 'tenant')->where('name', 'RENT')->where('format', 'SMS')->first();
        if(!$template){
            Log::channel('customerrentlog')->error("Template not setup!");
            return;
        }


        foreach ($customers as $customer){
            $keywords['firstname'] = $customer->firstname;
            $keywords['lastname'] = $customer->lastname;
            $keywords['flat'] = $customer->flat->name;
            $keywords['project'] = $customer->project->name;
            $keywords['rent'] = $customer->rent->rent;
            $customerData = $customer->toArray();
            $keywords = array_merge($keywords ,$customerData['customer']);
            $keywords['date'] = $deedstart;

             $msg = $template->message;
            $subject = $template->subject;
            $message= "".$subject."%0A".$msg."";

       //     $message = $template->content;
            foreach ($keywords as $key => $value) {
                $message = str_replace('{{' . $key . '}}', $value, $message);
            }

            if($gateway) {
                $cellNumber = $customerData['customer']['cellNo'];
                if ($cellNumber) {
                    //send to a job handler
                    ProcessSms::dispatch($gateway, $cellNumber, $message)->onQueue('sms');
                } else {
                    Log::channel('smsLog')->error("Invalid Cell No! " . $customerData['customer']['cellNo']);
                }
                // make email notification jobs here
                //check if have email for this tenant
                if(strlen($customerData['customer']['email'])){
                    //send to a job handler
                    $emailBody = (new CustomerRent($message))
                        ->onQueue('email');

                    Mail::to($customerData['customer']['email'])
                        ->queue($emailBody);
                }
                else{
                    Log::channel('customerrentlog')->error("Customer \" ".$customerData['customer']['firstname'] ."\" has no email address!");
                }
            }
            else{
                // make email notification jobs here
                //check if have email for this tenant
                if(strlen($customerData['customer']['email'])){
                    //send to a job handler
                    $emailBody = (new CustomerRent($message))
                        ->onQueue('email');

                    Mail::to($customerData['customer']['email'])
                        ->queue($emailBody);
                }
                else{
                    Log::channel('customerrentlog')->error("Customer \" ".$customerData['customer']['firstname'] ."\" has no email address!");
                }
            }
        }
    }

    private function getCustomers(){

        return Customer::whereIn('id', $this->customerIds)
            ->where('status', 'active')
            ->with(['flat' => function($query) {
                $query->select('name','id');
            }])
            ->with(['property' => function($query) {
                $query->select('name','id');
            }])
            ->with(['rent' => function($query) {
                $query->select('rent','id');
            }])
         //   ->with('customer')
            ->select('*')
            ->get();
    }
}
