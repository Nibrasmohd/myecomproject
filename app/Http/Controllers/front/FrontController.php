<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Validator;
use Crypt;

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
                    ->select('product_attr.id','product_attr.product_id as proid','product_attr.image','product_attr.mrp','product_attr.price','product_attr.qty','sizes.id as sizeid','colours.id as colorid',
                    'colours.colour','sizes.title')
                    ->get();
                
            }
            
        }

        $result['brands'] = DB::table('brands')->where(['is_home'=>1])
        ->where(['status'=>1])->get();

        $result['featured'] = DB::table('products')->where(['is_featured'=>1])
        ->where(['status'=>1])->get();

        foreach($result['featured'] as $item){
            $result['home_products_featured'][$item->id] = DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colours','colours.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$item->id])
                ->select('product_attr.id as pattrid','product_attr.product_id as prid','product_attr.image','product_attr.price','product_attr.mrp',
                'colours.colour','sizes.title','product_attr.size_id','product_attr.color_id')
                ->get();
        }

        

        $result['discount'] = DB::table('products')->where(['is_discounted'=>1])
        ->where(['status'=>1])->get();

        foreach($result['discount'] as $item){
            $result['home_products_discount'][$item->id] = DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colours','colours.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$item->id])
                ->select('product_attr.id as pattrid','product_attr.product_id as prid','product_attr.image','product_attr.price','product_attr.mrp',
                'colours.colour','sizes.title','product_attr.size_id','product_attr.color_id')
                ->get();
        }

        $result['trend'] = DB::table('products')->where(['is_trending'=>1])
        ->where(['status'=>1])->get();

        foreach($result['trend'] as $item){
            $result['home_products_trend'][$item->id] = DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colours','colours.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$item->id])
                ->select('product_attr.id as pattrid','product_attr.product_id as prid','product_attr.image','product_attr.price','product_attr.mrp',
                'colours.colour','sizes.title','product_attr.size_id','product_attr.color_id')
                ->get();
        }

        $result['homebanner'] = DB::table('home_banners')->where(['status'=>1])
        ->get();

        
        
       return view('front.index',$result);
    }

    public function product(Request $request,$slug)
    {
       
        
        $produts=[];
        $produts['products']=DB::table('products')
        ->where(['products.slug'=>$slug])
        ->where(['products.status'=>1])
        ->get();

        $catogoryid=$produts['products'][0]->catogory_id;
        $proid=$produts['products'][0]->id;
        $produts['productrelated']=DB::table('products')
        ->where(['catogory_id'=>$catogoryid])
        ->where('slug','!=',$slug)
        ->where(['status'=>1])
        ->get();
        // prx($produts['productrelated']);
        // die();
        foreach($produts['products'] as $val){
           
            $produts['productsattr']= DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colours','colours.id','=','product_attr.color_id')
            ->where(['product_attr.product_id'=>$val->id])
            ->get();
            $produts['productsimg']=DB::table('product_image')->where(['product_id'=>$val->id])
            ->get();
        }
        
       
        foreach($produts['productrelated'] as $val){
           
            $produts['productrelatedattr'][$val->id]= DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colours','colours.id','=','product_attr.color_id')
            ->where(['product_attr.product_id'=>$val->id])
            ->get();
        }
        
        
        
       return view('front.product',$produts);
    }

    public function search(Request $request,$str)
    {
       
        $produts['products']=DB::table('products')
        ->where(['products.status'=>1])
        ->where('name','like',"%$str%")
        ->orwhere('model','like',"%$str%")
        ->orwhere('short_desc','like',"%$str%")
        ->orwhere('desc','like',"%$str%")
        ->orwhere('keywords','like',"%$str%")
        ->orwhere('uses','like',"%$str%")
        ->orwhere('technical_specification','like',"%$str%")
        ->get();

        foreach($produts['products'] as $val){           
            $produts['productsattr'][$val->id]= DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colours','colours.id','=','product_attr.color_id')
            ->where(['product_attr.product_id'=>$val->id])
            ->select('product_attr.id as pattrid','product_attr.product_id as prid','product_attr.image','product_attr.price','product_attr.mrp',
             'colours.colour','sizes.title','product_attr.size_id','product_attr.color_id')
            ->get();
        }
        

        
       return view('front.search',$produts);
    }

    public function category(Request $request,$slug)
    {
        
        $sort='';
        $sort_text='';
        $pricestart='';
        $priceend='';
        $sortcolor='';
        $sortcolorArr=[]; 
        if($request->get('sort')!=null){
            $sort=$request->get('sort');
        }
        if($request->get('setcolor')!=null){
            $sortcolor=$request->get('setcolor');
            $sortcolorArr=explode(':',$sortcolor);
            $sortcolorArr=array_filter($sortcolorArr);
        
        }
        
        $result['catogories'] = DB::table('catogories')->where(['status'=>1])
        ->where(['is_home'=>1])
        ->get();

        $result['colour'] = DB::table('colours')
                             ->where(['status'=>1])
                             ->get();

        $query = DB::table('products');
            $query =$query-> leftJoin('catogories','catogories.id','=','products.catogory_id');
            $query =$query-> leftJoin('product_attr','products.id','=','product_attr.product_id');
            $query =$query-> where(['catogories.catogory_slug'=>$slug]);
            $query =$query ->where(['products.status'=>1]);
            if( $sortcolor!=null ){
                $query =$query-> where(['product_attr.color_id'=>$sortcolorArr]);
        }
            if($sort=='name'){
                $query =$query-> orderBy('products.name','desc');
                $sort_text="Product Name";
            }
            if($sort=='price-desc'){
                $query =$query-> orderBy('product_attr.price','desc');
                $sort_text="Price - DESC";
            }
            if($sort=='price-asc'){
                $query =$query-> orderBy('product_attr.price','asc');
                $sort_text="Price - ASC";
            }
            if($sort=='date'){
                $query =$query-> orderBy('products.id','desc');
                $sort_text="DATE";
            }
            if( $request->get('pricestart')!=null && $request->get('priceend')!=null ){
                $pricestart=$request->get('pricestart');
                $priceend=$request->get('priceend');
                $sort_text="Price - Filter";
                if($pricestart > 0 && $priceend > 0 ){
                    $query =$query-> whereBetween('product_attr.price',[$pricestart,$priceend]);
                } 
            }
            
     
            $query = $query->distinct()->select('product_attr.price','products.id as pid','products.name','products.image',
                        'catogories.catogory_name','catogories.catogory_slug','catogories.catogory_image',
                        'catogories.id as cat_id','products.slug');
                  
            $query =$query ->get();
           
            $result['catogoryproducts'] =$query;

        foreach($result['catogoryproducts'] as $item){
            $result['catogoryproducts_attribute'][$item->pid] = DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colours','colours.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$item->pid])
                ->select('product_attr.id as pattrid','product_attr.product_id as prid','product_attr.image','product_attr.price','product_attr.mrp',
                'colours.colour','sizes.title','product_attr.size_id','product_attr.color_id')
                ->get();
        }
 
        $result['slug']=$slug;
        $result['sort']=$sort;
        $result['sort_text']=$sort_text;
        $result['pricestart']=$pricestart;
        $result['priceend']=$priceend;
        $result['sortcolour'] = $sortcolor;
        return view('front.catogory',$result);
    }

    public function add_to_cart(Request $request)
    {
       if ($request->session()->has('FRONT_USER_LOGIN')) {
           $uid=$request->session()->get('FRONT_USER_LOGIN');
           $user_type='reg';
       }else{
           $uid=getUserTempId();
           $user_type="not_reg";
       }
       


    
        $produtsAttr= DB::table('product_attr')
        ->select(['product_attr.id'])
        ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
        ->leftJoin('colours','colours.id','=','product_attr.color_id')
        ->where(['sizes.title'=>$request->post('sizeid')])
        ->where(['colours.colour'=>$request->post('colorid')])
        ->get();
 
        $prod_attrid=$produtsAttr[0]->id;
    
        
       

       $check=DB::table('cart')
        ->where(['user_id'=>$uid])
        ->where(['user_type'=>$user_type])
        ->where(['product_id'=>$request->post('product_id')])
        ->where(['product_attr_id'=>$prod_attrid])
        ->get();

        if (isset($check[0]->id)) {
            $update_id=$check[0]->id;
            DB::table('cart')
            ->where(['id'=>$update_id])
            ->update(['quantity'=>$request->post('productqty')]);
            $msg="Updated";
        }else{
            DB::table('cart')->insertgetId([
                'user_id'=>$uid,
                'user_type'=>$user_type,
                'product_id'=>$request->post('product_id'),
                'product_attr_id'=>$prod_attrid,
                'quantity'=>$request->post('productqty'),
                'added_on'=>date('Y-m-d h:i:s')
            ]);
            $msg="inserted";
           
        }

        $result=DB::table('cart')
         ->leftJoin('products','products.id','=','cart.product_id')
         ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
         ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
         ->leftJoin('colours','colours.id','=','product_attr.color_id')
         ->where(['user_id'=>$uid])
         ->where(['user_type'=>$user_type])
         ->select('cart.id as cartid','cart.quantity','products.name','products.image','sizes.title','colours.colour',
          'product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id')
         ->get();

        return response()->json(['msg'=>$msg,'data'=>$result,'cartqaunt'=>count($result)]);
       
    }

    public function registration(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN')!= null){
            return redirect('/'); 
        }
        return view('front.registration');
    }

    public function registration_process(Request $request)
    {
        $valid = Validator::make($request->all(),[
           "name"=>'required',
           "email"=>'required|email|unique:costomers,email',
           "password"=>'required|min:4',
           "mobile"=>'required|numeric|digits:10'
        ]);
        if(! $valid->passes()){
            return response()->json(['status'=>'error','error'=>$valid->errors()->toArray()]);
        }else{
  
            $arr=[
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Crypt::encrypt($request->password),
                'mobile'=>$request->mobile,
                'status'=>1,
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s')
            ];
            $query=DB::table('costomers')->insert($arr);
            if($query){
                return response()->json(['status'=>'success','msg'=>'Register succecfulluy']);
            }else{
                return response()->json(['status'=>'not sussess','msg'=>'somthing went wrong']);
            }
        }
    }

    public function login_process(Request $request)
    {
        $costomer = DB::table('costomers')
                    ->where(['email'=>$request->str_login_email])
                    ->get();

        if( isset($costomer[0])){
            $db_pwd=Crypt::decrypt($costomer[0]->password);
            if($db_pwd == $request->str_login_password ){
                if($request->rememberme == null){
                    setcookie('login_email',$request->str_login_email,time(),100);
                    setcookie('login_pwd',$request->str_login_password ,time(),100); 
                }else{
                   setcookie('login_email',$request->str_login_email,time()+60*60*24*100);
                   setcookie('login_pwd',$request->str_login_password ,time()+60*60*24*100);
                } 
                $request->session()->put('FRONT_USER_LOGIN','true');
                $request->session()->put('FRONT_USER_ID',$costomer[0]->id);
                $request->session()->put('FRONT_USER_NAME',$costomer[0]->name);
                $status='success';
                $msg='Login successfully';
            }else{
                $status='error';
                $msg='please enter valid password';
            }
        }else{
            $status='error';
            $msg='please enter valid Email id';
        }

        return response()->json(['status'=>$status,'msg'=>$msg]);
    }

    public function delete_cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid=$request->session()->get('FRONT_USER_LOGIN');
            $user_type='reg';
        }else{
            $uid=getUserTempId();
            $user_type="not_reg";
        }
        $cartid= $request->post('cartids');
        DB::table('cart')
            ->where(['id'=>$cartid])
            ->delete();
            $msg="deleted";

        $result=DB::table('cart')
        ->leftJoin('products','products.id','=','cart.product_id')
        ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
        ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
        ->leftJoin('colours','colours.id','=','product_attr.color_id')
        ->where(['user_id'=>$uid])
        ->where(['user_type'=>$user_type])
        ->select('cart.id as cartid','cart.quantity','products.name','products.image','sizes.title','colours.colour',
            'product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id')
        ->get();

        return response()->json(['msg'=>$msg,'data'=>$result,'cartqaunt'=>count($result)]);    
       
    }

    public function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid=$request->session()->get('FRONT_USER_LOGIN');
            $user_type='reg';
        }else{
            $uid=getUserTempId();
            $user_type="not_reg";
        }

        $result['list']=DB::table('cart')
         ->leftJoin('products','products.id','=','cart.product_id')
         ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
         ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
         ->leftJoin('colours','colours.id','=','product_attr.color_id')
         ->where(['user_id'=>$uid])
         ->where(['user_type'=>$user_type])
         ->select('cart.id as cartid','cart.quantity','products.name','products.image','sizes.title','colours.colour',
          'product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id')
         ->get();
        return view('front.card',$result);
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
