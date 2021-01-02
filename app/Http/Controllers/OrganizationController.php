<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class OrganizationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function showAllComapny(){
        return response()->json(Organization::with('services','organContacts','organMedia')->get());
    }
    public function getCompany($id){
        $organ=Organization::with('services')->find($id);
        return response()->json($organ);
    }
    public function create(Request $request){
        // Validation
        $this->validate($request,[
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "city"=>"required"
        ]);
        // Insert to database
        $organ=Organization::create($request->all());
        return response()->json($organ, 201);
    }
    public function update($id, Request $request){
        // Validation
        $this->validate($request,[
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "city"=>"required"
        ]);
        $organ=Organization::findOrFail($id);
        $organ->update($request->all());
        return response()->json($organ, 200);
    }
    public function delete($id){
        Organization::findOrFail($id)->delete();
        return response("Organization Deleted!", 200);
    }
    public function addOrganService(Request $request){
        $this->validate($request,[
            "title"=>"required",
            "description"=>"required",
            "organization_id"=>"required"
        ]);
        $organization_id=$request->input('organization_id');
        $organ=Organization::findOrFail($organization_id);
        $organ->services()->create([
            "title"=>$request->input("title"),
            "description"=>$request->input("description"),
            "coverImage"=>$request->input("coverImage")
        ]);
        return response($organ, 200);

    }
    public function deleteService($id){
        Service::findOrFail($id)->delete();
        return response("Service Deleted!", 200);
    }
    
    public function updateService($id, Request $request){
        // Validation
        $this->validate($request,[
            "title"=>"required",
            "description"=>"required"
        ]);
        $service=Service::findOrFail($id);
        $service->update($request->all());
        return response()->json($service, 200);
    }
}
