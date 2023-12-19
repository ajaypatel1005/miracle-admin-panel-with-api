<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getProfile()
    {
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]); 
                try {
                    $data = new User();
                    $data->name = $request->name;
                    $data->email = $request->email;
                    $data->password =Hash::make($request->password);
                    $data->save();
                    
                    return redirect()->back()->with('success','User Created successfully');
                } catch (Exception $e) {
                    return redirect()->back()->withInput($request->input())->with("error","Error..Please try again.".$e);
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=User::where('id','=',$id)->first();
        return view('users.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
        ]); 
        try {
            $user = User::find($request->user_id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();
                return redirect()->back()->with('success','User updated successfully');
            
            } catch (Exception $e) {
                return redirect()->back()->withInput($request->input())->with("error","Error..Please try again.".$e);
            }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $user = User::find($id);
           
            if ($user == true) {
                $user = $user->delete();
                return redirect()->back()->with('success','User deleted successfully');
            } else {
                
                return redirect()->back()->with('error','Sorry!! User not exist.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something went wrong!!');
        }
    }
}
