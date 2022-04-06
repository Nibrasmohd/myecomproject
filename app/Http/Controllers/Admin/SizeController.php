<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $size = Size::All();
        // dd($coupens->title);
        return view('admin.size',['result'=>$size]);
    }

    public function manage_size(Request $request,$id='')
    {
        if($id>0){
            $model = Size::find($id);
            $result['id']=$model->id;
            $result['title']=$model->title;
        }else{
            $result['id']='';
            $result['title']='';
        }
        return view('admin.size_manage',$result);
    }

    public function manage_size_process(Request $request)
    {
        
        $request->validate([
            'title'=>'required|unique:sizes,title,'.$request->post('sizeid')
        ]);

        
        if($request->post('sizeid')>0){
            
            $model= Size::find($request->post('sizeid'));
            $mssg="succefully updated";
        }else{
            $model = new Size;
            $model->status=1;
            $mssg="succefully added";
        }
        // dd($request->post('title'));

        $model->title=$request->post('title');
        $model->save();

        $request->session()->flash('message',$mssg);
        return redirect('admin/Size');
    }

    public function delete_size(Request $request,$id)
    {
        $size=Size::find($id);
        $size->delete();

        $request->session()->flash('message',"succefully deleted");
        return redirect('admin/Size');
    }

    public function status_size(Request $request,$status,$id)
    {
        $size=Size::find($id);
        $size->status=$status;
        $size->save();

        $request->session()->flash('message',"Status Updated");
        return redirect('admin/Size');
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
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        //
    }
}
