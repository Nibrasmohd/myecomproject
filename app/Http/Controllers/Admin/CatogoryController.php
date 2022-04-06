<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Catogory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatogoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
      $result=Catogory::all();
      return view('admin.catogory',['result'=>$result]);
    }

    public function manage_category(Request $request,$id='')
    {
      if($id>0){
        $arr=Catogory::where(['id'=>$id])->get();
        $catogory['catogory_name'] = $arr['0']->catogory_name;  
        $catogory['catogory_slug'] = $arr['0']->catogory_slug;  
        $catogory['parent_catogory_id'] = $arr['0']->parent_catogory_id;  
        $catogory['catogory_image'] = $arr['0']->catogory_image;  
        $catogory['is_home'] = $arr['0']->is_home;  
        $catogory['id'] = $arr['0']->id;  

        $catogory['catogories']= DB::table('catogories')->where(['status'=>1])
        ->where('id','!=',$id)
        ->get();

      }else{
        $catogory['catogory_name'] ='';  
        $catogory['catogory_slug'] ='';
        $catogory['parent_catogory_id'] ='';  
        $catogory['catogory_image'] = '';    
        $catogory['is_home'] = 0;    
        $catogory['id'] ='';  

        $catogory['catogories']= DB::table('catogories')->where(['status'=>1])->get();
      }

      


      return view('admin.manage_category',$catogory);
    }

    public function manage_category_process(Request $request)
    {

        $request->validate([
            'catogory'=>'required',
            'catogory_slug'=>'required|unique:catogories,catogory_slug,'.$request->post('id'),
            'catogory_image'=>'mimes:jpeg,jpg,png'
        ]);

        $ids = $request->post('id');
        if($ids>0){
            $model =Catogory::find($ids);
        }else{
            $model = New Catogory;
        }

        if($request->hasfile('catogory_image')){
            if($ids>0){
                $proArr = DB::table('catogories')->where(['id'=>$ids])->get();
                $image_name = $proArr['0']->catogory_image;
                if($image_name!= ''){
                    if(file_exists(public_path('images/catogory/'.$image_name))){
                        unlink(public_path('images/catogory/'.$image_name));
                      }
                }
            }
            $image=$request->file('catogory_image');
            $ext=$image->extension();
            $image_name = time().'.'.$ext;
            $image->move(public_path('images/catogory'),$image_name);
            $model->catogory_image=$image_name;
        }

        $model->catogory_name=$request->post('catogory');
        $model->catogory_slug=$request->post('catogory_slug');
        $model->parent_catogory_id=$request->post('parent_catogory_id');
        $model->is_home=0;
        if($request->post('is_home')!=NULL){
            $model->is_home=1;
        } 
        $model->status=1;
        $model->save();

        $request->session()->flash('message','catogory inserted');
        return redirect('/admin/Catogory');

    }

    public function delete_catogory(Request $request,$id)
    {
        $proArr = DB::table('catogories')->where(['id'=>$id])->get();
        $image_name = $proArr['0']->catogory_image;
        if(file_exists(public_path('images/catogory/'.$image_name))){
          unlink(public_path('images/catogory/'.$image_name));
        }
        $catogory=Catogory::find($id);
        $catogory->delete();
        $request->session()->flash('message','catogory deleted');
        return redirect('/admin/Catogory');



    }

    public function status_catogory(Request $request,$status,$id)
    {
       
       $model = Catogory::find($id);
       $model->status = $status;
       $model->save();

       $request->session()->flash('message','status Updated');
        return redirect('/admin/Catogory');




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
     * @param  \App\Models\Catogory  $catogory
     * @return \Illuminate\Http\Response
     */
    public function show(Catogory $catogory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catogory  $catogory
     * @return \Illuminate\Http\Response
     */
    public function edit(Catogory $catogory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catogory  $catogory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catogory $catogory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catogory  $catogory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catogory $catogory)
    {
        //
    }
}
