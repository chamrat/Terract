<?php

namespace App\Http\Controllers;

use App\PropertyUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail($emailData)
    {
        $data = [];
        $data['senderName'] = 'Hello From Terract';
        $data['senderEmail'] = env('SENDER_EMAIL', 'terractmgmt@gmail.com');
        $data['toName'] = 'This is a Test';
        $data['toEmail'] = $emailData->tenant_email;
        $data['subject'] = 'Join Our Application As A Tenant';
        $siteUrl = env('APP_URL', 'http://127.0.0.1:8000');
        $emailCode = $emailData->email_code;
        $data['registerLink'] = $siteUrl.'/register?emailCode='.$emailCode;
        $propertyUnitId = $emailData->property_unit_id;
        $propertyUnitObj = PropertyUnit::find($propertyUnitId);
        $data['propertyUnit'] = $propertyUnitObj['reference_name'];

        try{
            Mail::send('property.invitation',
                $data,
                function ($message) use ($data) {
                    $message->to($data['toEmail'], $data['toName'])
                        ->subject($data['subject']);
                    $message->from($data['senderEmail'], $data['senderName']);
                });

            return true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::notice('============ Invitation Email Sending Fails =============');
            return false;
        }
    }
}
