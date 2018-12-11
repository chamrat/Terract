<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\Property;
use App\PropertyUnit;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
    public function invitationForm($message = null)
    {
        $properties = $this->getInvitationFormData();
        $data['properties'] = $properties;
        return view('common.invitation')->with(compact('data'));
    }

    public function sendInvitation(Request $request, Invitation $invitation)
    {
        $emailCode = Uuid::generate()->string;
        $isValied = $this->validator($request);
        if ($isValied) {
            try {
                $invitation->tenant_email = $request->input('tenant_email');
                $invitation->property_unit_id = $request->input('property_unit_id');
                $invitation->email_code = $emailCode;
                $invitation->verified = false;
                $invitation->save();
                $emailController  = new EmailController();
                $emailController->sendEmail($invitation);
                $messsage = 'Invitation sent successfully';
            } catch (\Illuminate\Database\QueryException $e){
                $messsage = 'This tenant has already received an invitation!';
            } catch (\Exception $exception) {
                $messsage = 'Error '.$exception->getMessage();
            }
        } else {
            $messsage = 'Invalied Data submitted, Property not saved.';
        }
        $properties = $this->getInvitationFormData();
        $data = ['properties'=>$properties, 'messsage'=>$messsage];
        return view('common.invitation')
            ->with('data', $data);
    }

    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'tenant_email' => 'required|email|max:255',
            'property_unit_id' => 'required',
        ]);
    }

    public function getInvitationFormData()
    {
        $landlordId = auth()->id();
        $propertiesRaw = Property::where('landlord_id', $landlordId)->get();
        $properties = $propertiesRaw->map(function ($propertiesRaw){
            return collect($propertiesRaw->toArray())
                ->only(['id', 'property_type', 'address', 'zip_code'])
                ->all();
        });
        return $properties;
    }

    protected function getUnitsForProperty(Request $request)
    {
        $property_id = $request->propertyId;
        $propertyList = PropertyUnit::where('property_id', $property_id)->get();
        $properties = $propertyList->map(function ($propertyList){
            return collect($propertyList->toArray())
            ->only('id', 'unit_type', 'reference_name');
        });
        echo json_encode($properties);
    }
}
