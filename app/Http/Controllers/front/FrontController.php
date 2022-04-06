<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       $result['home_catogories'] = DB::table('catogories')->where(['status'=>1])
                             ->where(['is_home'=>1])
                             ->get();
        foreach($result['home_catogories'] as $list){
            $result['home_catogories_products'][$list->id] = DB::table('products')->where(['status'=>1])
            ->where(['catogory_id'=>$list->id])
            ->get();

            foreach($result['home_catogories_products'][$list->id] as $list1){
                $result['home_products_attr'][$list1->id] = DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftJoin('colours','colours.id','=','product_attr.color_id')
                    ->where(['product_attr.product_id'=>$list1->id])
                    ->get();
                
            }
        }
        // echo "<pre>";
        //   print_r($result['home_catogories_products']);
        // echo "</pre>";
        // die();
        
        
       return view('front.index',$result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

  
    //   if(isset($result['0']->id)){
    //        $request->session()->put('ADMIN_LOGIN',true);
    //        $request->session()->put('ADMIN_id',$result['0']->id);
    //        return redirect('admin/dashboard');
    //   }else{
    //       $request->session()->flash('error','please enter valid logon details');
    //       return redirect('/admin');
    //   }

    

   


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
