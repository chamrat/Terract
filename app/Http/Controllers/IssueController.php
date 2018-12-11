<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function create()
    {
        if($this->getPropertyUnitId()){
            $propertyUnit = $this->getPropertyUnitId();
            return view('issue/new')->with(compact('propertyUnit'));
        }
        return view('issue/new');
    }

    private function getPropertyUnitId()
    {
        $user = Auth::user();
        if(isset($user->propertyUnits()->get()[0]->id)){
            $propertyUnit = $user->propertyUnits()->get()[0]->id;
            return $propertyUnit;
        }
        return false;
    }

    public function save(Request $request, Issue $issue)
    {
        $isValied = $this->validator($request);
        if ($isValied) {
            try{
                $issue->title = $request->input('title');
                $issue->description = $request->input('description');
                $issue->property_unit_id = $request->input('unit_id');
                $issue->tenant_id = Auth::user()->id;
                $issue->save();
                $messsage = 'Issue reported successfully';
            } catch (\Exception $exception) {
                $messsage = 'Error '.$exception->getMessage();
            }
        } else {
            $messsage = 'Invalied Data submitted, Issue not saved.';
        }
        $data['message'] = $messsage;
        if($this->getPropertyUnitId()){
            $propertyUnit = $this->getPropertyUnitId();
            return view('issue/new')->with(compact('propertyUnit'))->with(compact('messsage'));
        }
        return view('issue/new');
    }

    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);
    }

    public function viewIssues()
    {
        $issues = [];
        $issuesItems = Issue::all();
        foreach ($issuesItems as $issue) {
            $issueItem = [];
            $issueItem['id'] = $issue->id;
            $issueItem['title'] = $issue->title;
            $issueItem['description'] = $issue->description;
            $issueItem['propertyUnit'] = $issue->propertyUnit()->get()[0]->reference_name;
            $issues[] = $issueItem;
        }
        return view('issue/list')->with(compact('issues'));
    }
}
