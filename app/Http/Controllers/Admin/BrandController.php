<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::All();
        // dd($coupens->title);
        return view('admin.brand',['result'=>$brand]);
    }

    public function manage_Brand(Request $request,$id='')
    {
        if($id>0){
            $model = Brand::find($id);
            $result['id']=$model->id;
            $result['name']=$model->name;
            $result['image']=$model->image;
            $result['is_home']=$model->is_home;
        }else{
            $result['id']='';
            $result['name']='';
            $result['image']='';
            $result['is_home']='';
        }
        return view('admin.manage_brand',$result);
    }

    public function manage_Brand_process(Request $request)
    {
        
        $request->validate([
            'namebrand'=>'required|unique:brands,name,'.$request->post('brandid'),
            'brandimg'=>'mimes:jpeg,jpg,png',
        ]);
      
      

        if($request->post('brandid')>0){
            $model= Brand::find($request->post('brandid'));
            $mssg="succefully updated";
        }else{
            $model = new Brand;
            $model->status=1;
            $mssg="succefully added";
        }

        
        
        $model->name=$request->post('namebrand');
        if( $request->hasfile('brandimg')){
            if($request->post('brandid')>0){
                $proArr = DB::table('brands')->where(['id'=>$request->post('brandid')])->get();
                $image_name = $proArr['0']->image;
                if($image_name!= ''){
                    if(file_exists(public_path('images/'.$image_name))){
                        unlink(public_path('images/'.$image_name));
                      }
                }
            }
            $rand=rand('000','95484');
            $image = $request->file('brandimg');
            $ext = $image->extension();
            $image_name = $rand.'.'.$ext;
            $image->move(public_path('images'),$image_name);
            $model->image= $image_name ;
        }
        $model->is_home=0;
        if($request->post('is_home')!=NULL){
            $model->is_home=1;
        } 
        $model->save();

        $request->session()->flash('message',$mssg);
        return redirect('admin/Brand');
    }

    public function delete_Brand(Request $request,$id)
    {
        if($id>0){
            $proArr = DB::table('brands')->where(['id'=>$id])->get();
            $image_name = $proArr['0']->image;
            if($image_name!= ''){
                if(file_exists(public_path('images/'.$image_name))){
                    unlink(public_path('images/'.$image_name));
                  }
            }
        }
        $color=Brand::find($id);
        $color->delete();

        $request->session()->flash('message',"succefully deleted");
        return redirect('admin/Brand');
    }

    public function status_Brand(Request $request,$status,$id)
    {
        $size=Brand::find($id);
        $size->status=$status;
        $size->save();

        $request->session()->flash('message',"Status Updated");
        return redirect('admin/Brand');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
