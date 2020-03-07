<?php

namespace App\Http\Controllers\Dashboard;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');
        $this->middleware('role:مدير');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $admins = Admin::where('name','!=','Admin')->paginate(5);
            return view('dashboard.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $roles = Role::all();
            return view("dashboard.admin.create", compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string',
        ]);
     $user = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->roles()->sync($request['role']);
        return redirect()->route('admins.index')
            ->with('success','تم الانشاء بنجاح');
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
        $admin = Admin::find($id);
        $roles = Role::all();
        return view('dashboard.admin.edit',compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($id)],
            'role' => 'required|string',
        ]);
           $admin=Admin::find($id);
            $admin->name = $request['name'];
            $admin->email= $request['email'];
            $admin->save();
            $admin->roles()->sync($request['role']);
        return redirect()->route('admins.index')
            ->with('success','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('admin.index')
            ->with('success','تم الحذف بنجاح');
    }
    /**
    edit password
     */
    public function editPassword($id)
    {
        $admin = Admin::find($id);
        return view('dashboard.admin.editPassword',compact('admin'));
    }
    /**
     update password
     */
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
        $admin=Admin::find($id);

        $admin->password = Hash::make($request['password']);
        $admin->save();
        return redirect()->route('admin.index')
            ->with('success','تمتغير الباسورد بنجاح');
    }
}
