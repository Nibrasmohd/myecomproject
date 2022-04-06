<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Colour;
use Illuminate\Http\Request;

class ColourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colour = Colour::All();
        // dd($coupens->title);
        return view('admin.colour',['result'=>$colour]);
    }

    public function manage_Colour(Request $request,$id='')
    {
        if($id>0){
            $model = Colour::find($id);
            $result['id']=$model->id;
            $result['title']=$model->colour;
        }else{
            $result['id']='';
            $result['title']='';
        }
        return view('admin.colour_manage',$result);
    }

    public function manage_Colour_process(Request $request)
    {
        
        $request->validate([
            'color'=>'required|unique:colours,colour,'.$request->post('colorid')
        ]);

        if($request->post('colorid')>0){
            
            $model= Colour::find($request->post('colorid'));
            $mssg="succefully updated";
        }else{
            $model = new Colour;
            $model->status=1;
            $mssg="succefully added";
        }
        // dd($request->post('title'));

        $model->colour=$request->post('color');
        $model->save();

        $request->session()->flash('message',$mssg);
        return redirect('admin/Colour');
    }

    public function delete_Colour(Request $request,$id)
    {
        $color=Colour::find($id);
        $color->delete();

        $request->session()->flash('message',"succefully deleted");
        return redirect('admin/Colour');
    }

    public function status_Colour(Request $request,$status,$id)
    {
        $size=Colour::find($id);
        $size->status=$status;
        $size->save();

        $request->session()->flash('message',"Status Updated");
        return redirect('admin/Colour');
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
     * @param  \App\Models\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function show(Colour $colour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function edit(Colour $colour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colour $colour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colour $colour)
    {
        //
    }
}
