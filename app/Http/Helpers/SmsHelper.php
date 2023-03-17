<?php


namespace App\Http\Helpers;


use App\smsLog;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client as twilioClient;

class SmsHelper
{
    private $gateway = null;

    function __construct($gateway)
    {
        $this->gateway = $gateway;
    }

    public function sendSms($number, $message) {

        //clean message for GSM extended character
        // ~^{}[]\|
        $message = str_replace('{', '(', $message);
        $message = str_replace('}', ')', $message);
        $message = str_replace('[', '(', $message);
        $message = str_replace(']', ')', $message);
        $message = preg_replace("/[^a-zA-Z0-9\s(),\/]/mi", "", $message);
        $message = preg_replace("/\s{2,}/mi", " ", $message);


        try {

            if(!$this->gateway){
                throw new Exception('SMS gateway not defined!');
            }
            // list is here AppHelper::SMS_GATEWAY_LIST
            if($this->gateway->gateway == 1){
                return $this->sendSmsViaBulkSmsRoute($number, $message);
            }
           
            else {
                // log sms to file
                Log::channel('smsLog')->info("Send new sms to ".$number." and message is:\"".$message."\"");
                return true;
            }

        }
        catch (Exception $e) {
            //write error log
            Log::channel('smsLog')->error($e->getMessage());
        }


        return true;

    }

    private function sendSmsViaBulkSmsRoute($number, $message) {
        try {

            $client = new Client();
            $myaccount=urlencode("husnacreche@gmail.com");
                                $mypasswd=urlencode("husna123");
                                $sendBy=urlencode("BalaSabo");
                                $msg =urlencode($message);
           // $uri = "https://app.multitexter.com/v2/app/sms?api_key=".$this->gateway->user."&type=text&contacts=".$number."&senderid=".$this->gateway->sender_id."&msg=".urlencode($message);
       $uri="https://app.multitexter.com/v2/app/sms?email=".$myaccount."&password=".$mypasswd."&message=".$msg."&sender_name=".$sendBy."&recipients=".$number."&forcednd=1";

            $response = $client->get($uri);
            $status = json_decode($response->getBody());

            $isSuccess = false;
            switch ($status) {
                case "1":
                    $msg = "Ok : Message sent successful";
                    break;
                case "-2":
                    $msg = "Invalid Parameter";
                    break;
                case "-3 ":
                    $msg = "Account suspended due to fraudulent message";
                    break;
                case "-4":
                    $msg = "Invalid Display name";
                    break;
                case "-5":
                    $msg = "Invalid Message content";
                    break;
                case "-6":
                    $msg = "Invalid recipient";
                    break;
                case "-7":
                    $msg = "Insufficient unit";
                    break;
                case "-10":
                    $msg = "Unknown error";
                    break;
                case "401":
                    $msg = "Unauthenticated";
                    break;
                default:
                    $msg = 'SMS SEND';
                    $isSuccess = true;
                    break;
            }

            if($isSuccess) {

                $log = $this->logSmsToDB($number, $message, $msg);
            }
            else{
                Log::channel('smsLog')->warning($msg.". url=".$uri);
            }

            return true;

        } catch (RequestException $e) {
            throw new Exception($e->getMessage());
        }


    }

  

    private function logSmsToDB($to, $message, $status){
        //invalid cache
        Cache::forget('smsChartData');

        return smsLog::create([
            'sender_id' => urlencode("BalaSabo"),
            'to' => $to,
            'message' => $message,
            'status' => $status,
        ]);

    }

    private function parseXmlResponse($response) {
        try {
            $responseXml = simplexml_load_string($response);
            if ($responseXml instanceof \SimpleXMLElement) {
                $status = (string)$responseXml->result->status;
                return $status;
            }
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }

    }

}