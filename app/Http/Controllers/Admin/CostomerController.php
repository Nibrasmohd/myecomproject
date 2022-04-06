<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Costomer;
use Illuminate\Http\Request;

class CostomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costomer = Costomer::All();
        // dd($coupens->title);
        return view('admin.costomer',['result'=>$costomer]);
    }

    
    public function view_Costomer(Request $request,$id)
    {
        $costomer = Costomer::find($id);
        return view('admin/costomer_view',['result'=>$costomer]);
    }

    public function delete_Costomer(Request $request,$id)
    {
        $size=Costomer::find($id);
        $size->delete();

        $request->session()->flash('message',"succefully deleted");
        return redirect('admin/Size');
    }

    public function status_Costomer(Request $request,$status,$id)
    {
        $size=Costomer::find($id);
        $size->status=$status;
        $size->save();

        $request->session()->flash('message',"Status Updated");
        return redirect('admin/Costomer');
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
     * @param  \App\Models\Costomer  $costomer
     * @return \Illuminate\Http\Response
     */
    public function show(Costomer $costomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Costomer  $costomer
     * @return \Illuminate\Http\Response
     */
    public function edit(Costomer $costomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Costomer  $costomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Costomer $costomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Costomer  $costomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Costomer $costomer)
    {
        //
    }
}
