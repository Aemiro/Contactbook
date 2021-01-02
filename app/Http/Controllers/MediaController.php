<?php
namespace App\Http\Controllers;
use App\Models\SocialMedia;
use App\Models\Organization;
use Illuminate\Http\Request;

class MediaController extends Controller
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
    public function showAllMedias(){
        return response()->json(SocialMedia::all());
    }
    public function getOrganMedia($id){
        return response()->json(SocialMedia::find($id));
    }
    public function create(Request $request){
        // Validation
        $this->validate($request,[
            "phone"=>"required|unique:social_media",
            "type"=>"required",
            "organization_id"=>"required"
        ]);
        // Insert to database
        $organization_id=$request->input('organization_id');
        $organ=Organization::findOrFail($organization_id);
      
        $organ->organMedia()->create([
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
        $contact=SocialMedia::findOrFail($id);
        $contact->update($request->all());
        return response()->json($contact, 200);
    }
    public function delete($id){
        SocialMedia::findOrFail($id)->delete();
        return response("Media Deleted!", 200);
    }
  
}
