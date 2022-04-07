<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = HomeBanner::All();
        // dd($coupens->title);
        return view('admin.banner',['result'=>$brand]);
    }

    public function manage_HomeBanner(Request $request,$id='')
    {
        if($id>0){
            $model = HomeBanner::find($id);
            $result['id']=$model->id;
            $result['image']=$model->image;
            $result['btntxt']=$model->btn_txt;
            $result['btnlink']=$model->btn_link;
        }else{
            $result['id']='';
            $result['image']='';
            $result['btntxt']='';
            $result['btnlink']="";
        }
        return view('admin.banner_manage',$result);
    }

    public function manage_HomeBanner_process(Request $request)
    {
        
        $request->validate([
            'bannerimage'=>'mimes:jpeg,jpg,png'
        ]);
      
      

        if($request->post('bannerid')>0){
            $model= HomeBanner::find($request->post('bannerid'));
            $mssg="succefully updated";
        }else{
            $model = new HomeBanner;
            $model->status=1;
            $mssg="succefully added";
        }

        
        
        $model->btn_txt=$request->post('btn_text');
        $model->btn_link=$request->post('btn_link');

        if( $request->hasfile('bannerimage')){
            if($request->post('bannerid')>0){
                $proArr = DB::table('home_banners')->where(['id'=>$request->post('bannerid')])->get();
                $image_name = $proArr['0']->image;
                if($image_name!= ''){
                    if(file_exists(public_path('images/banner/'.$image_name))){
                        unlink(public_path('images/banner/'.$image_name));
                      }
                }
            }
            $rand=rand('000','95484');
            $image = $request->file('bannerimage');
            $ext = $image->extension();
            $image_name = $rand.'.'.$ext;
            $image->move(public_path('images/banner/'),$image_name);
            $model->image= $image_name ;
        }
        
        $model->save();

        $request->session()->flash('message',$mssg);
        return redirect('admin/HomeBanner');
    }

    public function delete_HomeBanner(Request $request,$id)
    {
        if($id>0){
            $proArr = DB::table('home_banners')->where(['id'=>$id])->get();
            $image_name = $proArr['0']->image;
            if($image_name!= ''){
                if(file_exists(public_path('images/banner/'.$image_name))){
                    unlink(public_path('images/banner/'.$image_name));
                  }
            }
        }
        $color=HomeBanner::find($id);
        $color->delete();

        $request->session()->flash('message',"succefully deleted");
        return redirect('admin/HomeBanner');
    }

    public function status_HomeBanner(Request $request,$status,$id)
    {
        $size=HomeBanner::find($id);
        $size->status=$status;
        $size->save();

        $request->session()->flash('message',"Status Updated");
        return redirect('admin/HomeBanner');
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
     * @param  \App\Models\HomeBanner  $homeBanner
     * @return \Illuminate\Http\Response
     */
    public function show(HomeBanner $homeBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeBanner  $homeBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeBanner $homeBanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeBanner  $homeBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeBanner $homeBanner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeBanner  $homeBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeBanner $homeBanner)
    {
        //
    }
}
