<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * @return View
     */
    public function create()
    {
        $dataArray = $this->getUnitData();
        $landlord = $dataArray['landlordId'];
        $unitTypes = $dataArray['unitTypes'];
        $properties = $dataArray['properties'];
        return view('unit.new')
            ->with(compact('landlord'))
            ->with(compact('unitTypes'))
            ->with(compact('properties'))
            ->with(compact('message'));
    }

    /**
     * @return array $data
     */
    protected function getUnitData()
    {
        $landlordId = Auth::id();
        $unitTypes = ["Studio", "1BR", "2BR","3BR","4BR", "5BR"];
        $propertiesRaw = Property::where('landlord_id', $landlordId)->get();
        $properties = $propertiesRaw->map(function ($propertiesRaw){
            return collect($propertiesRaw->toArray())
                ->only(['id', 'property_type', 'address', 'zip_code'])
                ->all();
        });
        $data = ['landlordId' => $landlordId, 'unitTypes' => $unitTypes, 'properties'=>$properties];
        return $data;
    }

    /**
     * @param Request $request
     * @param PropertyUnit $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, PropertyUnit $unit)
    {
        $isValied = $this->validator($request);
        if ($isValied) {
            try{
                $unit->unit_type = $request->input('unit_type');
                $unit->reference_name = $request->input('reference_name');
                $unit->description = $request->input('description');
                $unit->property_id = $request->input('property_id');
                $unit->save();
                $message = 'Property unit saved successfully';
            } catch (\Exception $exception) {
                $message = 'Error '.$exception->getMessage();
            }
        } else {
            $message = 'Invalied Data submitted, Property not saved.';
        }
        $dataArray = $this->getUnitData();
        $landlord = $dataArray['landlordId'];
        $unitTypes = $dataArray['unitTypes'];
        $properties = $dataArray['properties'];
        return view('unit.new')
            ->with(compact('landlord'))
            ->with(compact('unitTypes'))
            ->with(compact('properties'))
            ->with(compact('message'));
    }

    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'property_id' => 'required',
            'unit_type' => 'required'
        ]);
    }

    public function listUnits()
    {
        $user = Auth::user();
        $role = $user->roles()->get()->first();
        if($role['name'] == 'Tenant') {
            $propertyUnits = $user->propertyUnits()->get();
            return view('unit.list_tenant')->with(compact('propertyUnits'));
            $abc = '';
        } elseif ($role['name'] == 'Landlord') {
            $userId = Auth::id();
            $propertiesRaw = Property::where('landlord_id', $userId)->get();
            $properties = $propertiesRaw->map(function ($propertiesRaw){
                return collect($propertiesRaw->toArray())
                    ->only(['id', 'property_type', 'address', 'zip_code'])
                    ->all();
            });
            return view('unit.list')->with(compact('properties'));
        } else {
            //TODO: view for Admin
        }
    }

    public function getPropertyUnitsPerProperty(Request $request)
    {
        $property_id = $request->propertyId;
        $propertyList = PropertyUnit::where('property_id', $property_id)->get();
        $properties = $propertyList->map(function ($propertyList){
            return collect($propertyList->toArray())
                ->only('id', 'unit_type', 'reference_name', 'description');
        });
        echo json_encode($properties);
    }
}
