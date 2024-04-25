<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;
use App\Jobs\SendTempLoginEmail;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // showing list of user without super admin
        $users = User::where('role', '!=', 'superAdmin')->latest()->paginate(10);
        
        if(auth()->user()->role == 'superAdmin'){
            $roles = Role::whereNotIn('role_name',['superAdmin','normalEmployee'])->latest()->get();
        }elseif(auth()->user()->role == 'teamLeader'){
            $roles = Role::whereNotIn('role_name',['superAdmin','teamLeader'])->latest()->get();
        }else{
            $roles = array();
        }
        
        return view('dashboard.user.list',compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {   
        try
        {
            $input = $request->validated();
            $user = new User;
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            // Mail the user with temp login
            $emailData = [
                'first_name'=>$request->fname,
                'email'=>$request->email,
                'password'=>$request->password
            ];
            

            // Send email via queue
            dispatch(new SendTempLoginEmail($emailData));

            
            return response()->json(['success'=> true]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=> $e],500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if ($user)
        {
            $response = [
                'result' => 1,
                'user' => $user,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try
        {
            $user->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            return response()->json(['success'=> true]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=> $e],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try
        {
            $user->delete();
            return response()->json(['success'=> true]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=> $e],500);
        }
    }
}
