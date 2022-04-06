<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
      $result=Product::all();
      return view('admin.product',['result'=>$result]);
    }

    public function manage_Product(Request $request,$id='')
    {
      if($id>0){
        $arr=Product::where(['id'=>$id])->get();
        $product['catogory_id'] = $arr['0']->catogory_id;  
        $product['name'] = $arr['0']->name;  
        $product['image'] = $arr['0']->image;  
        $product['slug'] = $arr['0']->slug;  
        $product['brand'] = $arr['0']->brand;  
        $product['model'] = $arr['0']->model;  
        $product['shortdec'] = $arr['0']->short_desc;  
        $product['desc'] = $arr['0']->desc;  
        $product['keyword'] = $arr['0']->keywords;  
        $product['teechspec'] = $arr['0']->technical_specification;  
        $product['uses'] = $arr['0']->uses;  
        $product['warenty'] = $arr['0']->warenty;

        $product['lead_time'] = $arr['0']->lead_time;  
        $product['tax_id'] = $arr['0']->tax_id;    
        $product['is_promo'] = $arr['0']->is_promo;  
        $product['is_featured'] = $arr['0']->is_featured;  
        $product['is_discounted'] = $arr['0']->is_discounted;  
        $product['is_trending'] = $arr['0']->is_trending;    

        $product['status'] = $arr['0']->status;  
        $product['productid'] = $arr['0']->id;  
        $product['productattr']=DB::table('product_attr')->where(['product_id'=>$id])->get();
        $productimages=DB::table('product_image')->where(['product_id'=>$id])->get();
        if (!isset($productimages[0])) {
            $product['productattrimages'][0]['id']='';
            $product['productattrimages'][0]['images']='';
        }else{
            $product['productattrimages'] = $productimages;
        }
      }else{
        $product['catogory_id'] = '';  
        $product['name'] = '';  
        $product['image'] = '';  
        $product['slug'] = ''; 
        $product['brand'] = '';  
        $product['model'] = '';  
        $product['shortdec'] = '';  
        $product['desc'] = ''; 
        $product['keyword'] = '';  
        $product['teechspec'] = '';  
        $product['uses'] = ''; 
        $product['warenty'] = '';  
        $product['status'] = '';  
        $product['productid'] = '';
        $product['lead_time'] = '';  
        $product['tax_id'] = '';   
        $product['is_promo'] = '';  
        $product['is_featured'] = '';  
        $product['is_discounted'] = '';  
        $product['is_trending'] = ''; 
        $product['productattr'][0]['product_id']='';
        $product['productattr'][0]['id']='';
        $product['productattr'][0]['sku']='';
        $product['productattr'][0]['mrp']='';
        $product['productattr'][0]['price']='';
        $product['productattr'][0]['qty']='';
        $product['productattr'][0]['image']='';
        $product['productattr'][0]['size_id']=0;
        $product['productattr'][0]['color_id']=0;
        $product['productattrimages'][0]['id']='';
        $product['productattrimages'][0]['images']='';
      }

      $product['catogory']=DB::table('catogories')
                          ->where(['status'=>'1'])
                          ->get();

      $product['size']=DB::table('sizes')
                          ->where(['status'=>'1'])
                          ->get();

      $product['color']=DB::table('colours')
                          ->where(['status'=>'1'])
                          ->get();
      $product['brands']=DB::table('brands')
                          ->where(['status'=>'1'])
                          ->get();
      $product['tax']=DB::table('taxes')
                          ->where(['status'=>'1'])
                          ->get();

      return view('admin.manage_product',$product);
    }

    public function manage_Product_process(Request $request)
    {

        $ids=$request->post('productid');

        if($ids>0){
            $image_validation='mimes:jpeg,jpg,png';
        }else{
            $image_validation='required|mimes:jpeg,jpg,png';
        }
        $request->validate([
            'proname'=>'required',
            'slugs' =>'required|unique:products,slug,'.$request->post('productid'),
            'image' => $image_validation,
            'attrimage.*'=>'mimes:jpeg,jpg,png',
            'proimages.*'=>'mimes:jpeg,jpg,png',
        ]);

        $proid=$ids;
        $squ=$request->post('sku');
        $prodattrid=$request->post('proid');
        $mrp=$request->post('mrp');
        $price=$request->post('price');
        $size_id=$request->post('size');
        $color_id=$request->post('color');
        $qty=$request->post('qty');

        foreach ($squ as $key => $val) {
            $check = DB::table('product_attr')
            ->where('sku','=',$squ[$key])
            ->where('id','!=',$prodattrid[$key])
            ->get();

            if(isset($check[0])){
                $request->session()->flash('sku_error',$squ[$key].'has alereay used');
                return redirect(request()->headers->get('referer'));
            }
        }

        if($ids>0){
            $model =Product::find($ids);
            $mssg = "product updated";
           
        }else{
            $model = New Product;
            $mssg = "product Inserted";
            $model->status=1;
        }

        if($request->hasfile('image')){
            if($ids>0){
                $imagesarr =  DB::table('products')->where(['id'=>$ids])->get();
                $image=$imagesarr['0']->image;
                if(file_exists(public_path('images/'.$image))){
                    unlink(public_path('images/'.$image));
                }
            }
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name = time().$request->proname.'.'.$ext;
            $image->move(public_path('images'),$image_name);
            $model->image=$image_name;
        }

        $model->name=$request->post('proname');
        $model->slug=$request->post('slugs');
        $model->catogory_id=$request->post('catogoryid');
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('shortdesc');
        $model->desc=$request->post('desc');
        $model->keywords=$request->post('keywords');
        $model->technical_specification=$request->post('technicalspn');
        $model->uses=$request->post('uses');
        $model->warenty=$request->post('warenty');
        $model->lead_time=$request->post('lead_time');
        $model->tax_id=$request->post('tax_id');
        $model->is_promo=$request->post('is_promo');
        $model->is_featured=$request->post('is_featured');
        $model->is_discounted=$request->post('is_discounted');
        $model->is_trending=$request->post('is_trending');


        
        $model->save();
        $ids=$model->id;

        $proid=$ids;
        $squ=$request->post('sku');
        $prodattrid=$request->post('proid');
        $mrp=$request->post('mrp');
        $price=$request->post('price');
        $size_id=$request->post('size');
        $color_id=$request->post('color');
        $qty=$request->post('qty');

        foreach ($squ as $key => $val) {
            $productattr=[];
            $productattr['product_id']=$ids;
            $productattr['sku']=$squ[$key];
            $productattr['mrp']=(int)$mrp[$key];
            $productattr['price']=(int)$price[$key];
            if($qty[$key]!=''){
                $productattr['qty']=(int)$qty[$key];
            }else{
                $productattr['qty']=0;
            }
            if($size_id[$key]!=''){
                $productattr['size_id']=$size_id[$key];
            }else{
                $productattr['size_id']=0;
            }
            if($color_id[$key]!=''){
                $productattr['color_id']=$color_id[$key];
            }else{
                $productattr['color_id']=0;
            }
            if($request->hasfile("attrimage.$key")){
                if($prodattrid[$key]>0){
                    $imagesarr =  DB::table('product_attr')->where(['id'=>$prodattrid[$key]])->get();
                    $image=$imagesarr['0']->image;
                    if(file_exists(public_path('images/'.$image))){
                     unlink(public_path('images/'.$image));
                    }
                }
                $rand=rand('11111111','99999999');
                $image=$request->file("attrimage.$key");
                $ext=$image->extension();
                $image_name = $rand.'.'.$ext;
                $image->move(public_path('images'),$image_name);
                $productattr['image']=$image_name;
            }            
            if($prodattrid[$key]!=''){
                DB::table('product_attr')->where(['id'=>$prodattrid[$key]])->update($productattr);
                
            }else{
                DB::table('product_attr')->insert($productattr);
            }
            
            
        }

        $proimages=$request->post('proimgid');
        foreach ($proimages as $key => $value) {
            $productimage['product_id']=$ids;
            
          if($request->hasfile("proimages.$key")){ 
            if($proimages[$key]>0){
                $imagesarr =  DB::table('product_image')->where(['id'=>$prodattrid[$key]])->get();
                $image=$imagesarr['0']->images;
                if(file_exists(public_path('images/'.$image))){
                 unlink(public_path('images/'.$image));
                }
            }
            $rand=rand('22','998457');
            $image=$request->file("proimages.$key");
            $ext=$image->extension();
            $image_name = $rand.'.'.$ext;
            $image->move(public_path('images'),$image_name);
            $productimage['images']=$image_name;
            if($proimages[$key]!=''){
                DB::table('product_image')->where(['id'=>$proimages[$key]])->update($productimage);
            }else{
                DB::table('product_image')->insert($productimage);
            } 
          }
          
        }

        /* product images start */

        $request->session()->flash('message',$mssg);
        return redirect('/admin/Product');

    }

    public function delete_Product(Request $request,$id)
    {
       
        $proArr = DB::table('products')->where(['id'=>$id])->get();
        $image_name = $proArr['0']->image;
        if(file_exists(public_path('images/'.$image_name))){
            unlink(public_path('images/'.$image_name));
        }
        $Product=Product::find($id);
        $Product->delete();
        $request->session()->flash('message','product deleted');
        return redirect('/admin/Product');



    }
    public function delete_Product_attr(Request $request,$id,$pid)
    {
        $imagesarr =  DB::table('product_attr')->where(['id'=>$id])->get();
        $image=$imagesarr['0']->image;
        if(file_exists(public_path('images/'.$image))){
            unlink(public_path('images/'.$image));
        }

        $Product=DB::table('product_attr')->where(['id'=>$id])->delete();
        return redirect('/admin/Product/Product_manage/'.$pid);

    }

  
    public function delete_Product_image(Request $request,$id,$pid)
    {
        $imagesarr =  DB::table('product_image')->where(['id'=>$id])->get();
        $image=$imagesarr['0']->images;
        if(file_exists(public_path('images/'.$image))){
            unlink(public_path('images/'.$image));
        }
        $Product=DB::table('product_image')->where(['id'=>$id])->delete();
        return redirect('/admin/Product/Product_manage/'.$pid);

    }

    public function status_Product(Request $request,$status,$id)
    {
       
       $model = Product::find($id);
       $model->status = $status;
       $model->save();

       $request->session()->flash('message','status Updated');
        return redirect('/admin/Product');




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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
