<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){

        $users = User::orderBy('id','desc')->paginate(10);
        $data['users'] = $users;
        return view('user.list',$data);
    }


    public function add(){
        return view('user.add');
    }


    public function create(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
         ]);

         $user = new User([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $user->save();

        session()->flash('success', 'User successfully added.');

        return redirect()->to('/user-add');

        //return view('user.add');
    }


    public function edit(Request $request){
        //$user = User::where('id',$request->id)->first();
        $user = User::find($request->id);;
        $data['user'] = $user;
        return view('user.edit',$data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$request->id]);

            $user_data = [
                "name" => $request->name,
                "email" => $request->email];
    
                if(isset($request->password) && !empty($request->password)){
    
                    $this->validate($request,['password' => 'min:8']);
                    $user_data['password'] = Hash::make($request->password);
                }

            User::where('id',$request->id)->update($user_data);

            session()->flash('success', 'User successfully updated.');
            return redirect()->to('/user-edit-'.$request->id);
    }


    public function delete(Request $request){
        
        $user = User::find($request->id);

        if(!empty($user)){

            $response = $user->delete(); //returns true/false

            if($response){
                session()->flash('success', 'User deleted successfully.');
            }else{
                session()->flash('errors', 'Unable to delete user.');
            }

        }else{
            session()->flash('errors', 'User not found with id: '.$request->id);
        }
        return redirect()->to('/user-list');
    }
}
