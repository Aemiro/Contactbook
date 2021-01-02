<?php

namespace App\Http\Controllers;
use App\Models\OrganContact;
use App\Models\Organization;
use Illuminate\Http\Request;

class ContactController extends Controller
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
    public function showAllContacts(){
        return response()->json(OrganContact::all());
    }
    public function getOrganContact($id){
        return response()->json(OrganContact::find($id));
    }
    public function create(Request $request){
        // Validation
        $this->validate($request,[
            "phone"=>"required|unique:organ_contacts",
            "type"=>"required",
            "organization_id"=>"required"
        ]);
        // Insert to database
        $organization_id=$request->input('organization_id');
        $organ=Organization::findOrFail($organization_id);
      
        $organ->organContacts()->create([
            "phone"=>$request->input("phone"),
            "type"=>$request->input("type")
        ]);
        return response()->json($organ, 201);
    }
    public function update($id, Request $request){
        // Validation
        $this->validate($request,[
            "phone"=>"required",
            "type"=>"required"
        ]);
        $contact=OrganContact::findOrFail($id);
        $contact->update($request->all());
        return response()->json($contact, 200);
    }
    public function delete($id){
        OrganContact::findOrFail($id)->delete();
        return response("Contact Deleted!", 200);
    }
  
}
