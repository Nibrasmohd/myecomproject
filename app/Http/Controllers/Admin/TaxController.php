<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $size = Tax::All();
        // dd($coupens->title);
        return view('admin.tax',['result'=>$size]);
    }

    public function manage_Tax(Request $request,$id='')
    {
        if($id>0){
            $model = Tax::find($id);
            $result['id']=$model->id;
            $result['tax_desc']=$model->tax_desc;
            $result['tax_value']=$model->tax_value;
        }else{
            $result['id']='';
            $result['tax_desc']='';
            $result['tax_value']='';
        }
        return view('admin.tax_manage',$result);
    }

    public function manage_Tax_process(Request $request)
    {
        
        

        
        if($request->post('taxid')>0){
            
            $model= Tax::find($request->post('taxid'));
            $mssg="succefully updated";
        }else{
            $model = new Tax;
            $model->status=1;
            $mssg="succefully added";
        }
        // dd($request->post('title'));

        $model->tax_desc =$request->post('tax_desc');
        $model->tax_value =$request->post('tax_value');
        $model->save();

        $request->session()->flash('message',$mssg);
        return redirect('admin/Tax');
    }

    public function delete_size(Request $request,$id)
    {
        $size=Tax::find($id);
        $size->delete();

        $request->session()->flash('message',"succefully deleted");
        return redirect('admin/Size');
    }

    public function status_Tax(Request $request,$status,$id)
    {
        $size=Tax::find($id);
        $size->status=$status;
        $size->save();

        $request->session()->flash('message',"Status Updated");
        return redirect('admin/Tax');
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
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        //
    }
}
