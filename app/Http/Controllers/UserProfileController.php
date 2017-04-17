<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use auth;
use DB;

class UserProfileController extends Controller
{
    public function index()
	{
	    $user   = User::find(auth::id());
        $title  = "View $user->name's Profile";
        $active = 'userprofile';
        $events = Event::where('user_id' , auth::id())->get();
		return view('user.userprofile',compact('user','events','title','active'));
	}

	// public function display()
 //    {
 //        $user = User::find(auth::id());
 //        $title  = "View $user->name's Profile";
 //        $active = '';
 //        $events = Event::where('user_id' , auth::id())->get();
 //        return view('user.userprofile',compact('events','title','user','active'));
 //    }


    public function viewEditProfile()     
    {
        $user   = User::find(auth::id());
        $title  = "Edit $user->name's Profile";
        $active = 'editprofile';
        return view('user.profile',compact('user', 'title', 'active'));
        // return view('editprofile',compact('user'));
    }


    public function editProfile(Request $request)
    {
        $user = User::find(auth::id());
        $title  = "Edit $user->name's Profile";
        $active = 'editprofile';
        $events = Event::where('user_id' , auth::id())->get();
        if($request->save){

            $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            ]);
            
            $user->name     = $request->name;
            $user->email    = $request->email;
            if($request->password){
            $user->password = bcrypt($request->password);
             }
            if($request->image){
            $user->image    = $request->file('image')->store('images');
             }
            $user->save();
            return view("user.userprofile",compact('user','events','title','active'));
        
        }else {
            return view("user.userprofile",compact('user','events','title','active'));
        }
        
    }

public function selectEvents($name)
    {   $user = User::find(Auth::id());
        if($name == 'accepted')
            {
            $title  = "Accepted Events";
            $active = 'eventprofileaccepted';
            $events = DB::table('events')->where('approved' ,'accepted')->where('user_id' , auth::id())->get();
            }
        if($name == 'waiting')
            {
            $title  = "Waiting Events";
            $active = 'eventprofilewaiting';
            $events = DB::table('events')->where('approved' ,'waiting')->where('user_id' , auth::id())->get();
            }
        if($name == 'rejected')
            {
            $title  = "Rejected Events";
            $active = 'eventprofilerejected';
            $events = DB::table('events')->where('approved' ,'rejected')->where('user_id' , auth::id())->get();
            }
            return view('user.selectevent', compact('events','active','title','user'));
    }

        public function viewUserProfile($id){
            $title  = " Profile";
            $active = 'editprofile';
            $events = Event::where('user_id' , $id)->get();
            $user = User::find($id);
            return view('userviewuserprofile',compact('events','user','active','title'));
        }


        public function logviewProfile($id)
            {
                $title  = " Profile";
                $active = 'editprofile';
                $events = Event::where('user_id' , $id)->get();
                $user   = User::find(Auth::id());
                return view('userviewuserprofile',compact('events','user','active','title'));
            }
        public function viewMyProfile()
            {
                $title  = " Profile";
                $active = 'editprofile';
                $events = Event::where('user_id' , Auth::id())->get();
                $user   = User::find(Auth::id());
                return view('user.userprofile',compact('events','user','active','title'));
            }

}
