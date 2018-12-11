<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PropertyController extends Controller
{
    /**
     * @return $this
     * Rendering Add New Property Page
     */
    public function create()
    {
        $data = $this->getPropertyData();
        return view('property/new')->with('data', $data);
    }

    public function getPropertyData()
    {
        $propertyTypes = ["Co-Op", "Condo", "Multi-Family", "Building"];
        $landlordId = Auth::id();
        $data = ['propertyTypes' => $propertyTypes, 'landlordId' => $landlordId];
        return $data;
    }

    /**
     * Handling Add New Property Post Request
     */
    public function save(Request $request, Property $property)
    {
        $isValied = $this->validator($request);
        if ($isValied) {
            try{
                $property->property_type = $request->input('property_type');
                $property->address = $request->input('address');
                $property->zip_code = $request->input('zip_code');
                $property->description = $request->input('description');
                $property->number_of_units = $request->input('number_of_units');
                $property->landlord_id = 1;
                $property->save();
                $messsage = 'Property saved successfully';
            } catch (\Exception $exception) {
                $messsage = 'Error '.$exception->getMessage();
            }
        } else {
            $messsage = 'Invalied Data submitted, Property not saved.';
        }
        $data = $this->getPropertyData();
        $data['message'] = $messsage;
        return view('property.new')->with(compact('data'));
    }

    public function propertyList()
    {
        $properties = Property::all();
        return view('property.list')->with(compact('properties'));
    }

    public function show(Request $request)
    {
        $propertyId = $request->property_id;
        $property = Property::find($propertyId);
        return view('property.show')->with(compact('property'));
    }

    public function addUnit()
    {

    }

    public function edit()
    {

    }

    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'property_type' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'number_of_units' => 'required',
        ]);
    }
}
