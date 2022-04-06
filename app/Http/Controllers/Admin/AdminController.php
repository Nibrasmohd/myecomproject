<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function auth(Request $request)
    {
      $email = $request->email;
      $pass = $request->password;
      
    //   $result = Admin::where(['email'=>$email,'password'=>$pass])->get();
    $result = Admin::where(['email'=>$email])->first();
    
      if($result){
         if(Hash::check($request->post('password'), $result->password)) {
            $request->session()->put('ADMIN_LOGIN',true);
            $request->session()->put('ADMIN_id',$result->id);
            return redirect('admin/dashboard');
         }else{
            $request->session()->flash('error','please enter correct password');
            return redirect('/admin');
         }
        
      }else{
        $request->session()->flash('error','please enter valid logon details');
        return redirect('/admin');
      }
      
    }
    //   if(isset($result['0']->id)){
    //        $request->session()->put('ADMIN_LOGIN',true);
    //        $request->session()->put('ADMIN_id',$result['0']->id);
    //        return redirect('admin/dashboard');
    //   }else{
    //       $request->session()->flash('error','please enter valid logon details');
    //       return redirect('/admin');
    //   }

    
    public function dashboard()
    {
      return view('admin.dashboard');
    }

   

   


    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
