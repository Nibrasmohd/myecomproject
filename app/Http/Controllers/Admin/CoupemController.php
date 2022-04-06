<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupem;
use Illuminate\Http\Request;

class CoupemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupens = Coupem::All();
        // dd($coupens->title);
        return view('admin.coupen',['result'=>$coupens]);
    }

    public function manage_coupen(Request $request,$id='')
    {
        if($id>0){
            $model = Coupem::find($id);
            $result['id']=$model->id;
            $result['title']=$model->title;
            $result['code']=$model->code;
            $result['value']=$model->value;
            $result['type']=$model->type;
            $result['min_order_amt']=$model->min_order_amt;
            $result['is_one_time']=$model->is_one_time;
        }else{
            $result['id']='';
            $result['title']='';
            $result['code']='';
            $result['value']='';
            $result['type']='';
            $result['min_order_amt']='';
            $result['is_one_time']='';
        }
        return view('admin.manage_coupen',$result);
    }

    public function manage_coupen_process(Request $request)
    {

        $request->validate([
            'title'=>'required',
            'code'=>'required|unique:coupems,code,'.$request->post('coupenid'),
            'value'=>'required',
        ]);

        if($request->post('coupenid')>0){
            $model= Coupem::find($request->post('coupenid'));
            $mssg="succefully updated";
        }else{
            $model = new Coupem;
            $model->status=1;
            $mssg="succefully added";
        }
        

        $model->title=$request->post('title');
        $model->code=$request->post('code');
        $model->value=$request->post('value');
        $model->type=$request->post('type');
        $model->min_order_amt=$request->post('min_order_amt');
        $model->is_one_time=$request->post('is_one_time');
        $model->save();

        $request->session()->flash('message',$mssg);
        return redirect('admin/Coupem');
    }

    public function delete_colum(Request $request,$id)
    {
        $coupen=Coupem::find($id);
        $coupen->delete();

        $request->session()->flash('message',"succefully deleted");
        return redirect('admin/Coupem');
    }

    public function status_coupen(Request $request,$status,$id)
    {
        $coupen=Coupem::find($id);
        $coupen->status=$status;
        $coupen->save();

        $request->session()->flash('message',"Status Updated");
        return redirect('admin/Coupem');
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
     * @param  \App\Models\Coupem  $coupem
     * @return \Illuminate\Http\Response
     */
    public function show(Coupem $coupem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupem  $coupem
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupem $coupem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupem  $coupem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupem $coupem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupem  $coupem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupem $coupem)
    {
        //
    }
}
