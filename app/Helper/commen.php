<?php
use Illuminate\Support\Facades\DB;


function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}
function getTopNavCat(){
    $result=DB::table('catogories')
                ->where(['status'=>1])
                ->get();
    $arr=[];
    foreach($result as $row){
        $arr[$row->id]['category_name']=$row->catogory_name;
        $arr[$row->id]['parent_id']=$row->parent_catogory_id;
        $arr[$row->id]['category_slug']=$row->catogory_slug;
    }
    $str=buildTreeView($arr,0);
    return $str;
}

function getAddtocartTotalitem(){
    if (session()->has('FRONT_USER_LOGIN')) {
        $uid=session()->get('FRONT_USER_LOGIN');
        $user_type='reg';
    }else{
        $uid=getUserTempId();
        $user_type="not_reg";
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

    return $result;
}

$html='';
function buildTreeView($arr,$parent,$level=0,$prelevel= -1){
    global $html;
    foreach($arr as $id=>$data){
        if($parent==$data['parent_id']){
            if($level>$prelevel){
                if($html==''){
                    $html.='<ul class="nav navbar-nav">';
                }else{
                    $html.='<ul class="dropdown-menu">';
                }
            }
            if($level==$prelevel){
                $html.='</li>';
            }
            $html.='<li><a href="category/'.$data['category_slug'].'">'.$data['category_name'].'<span class="caret"></span></a>';
            if($level>$prelevel){
                $prelevel=$level;
            }
            $level++;
            buildTreeView($arr,$id,$level,$prelevel);
            $level--;
        }
    }
    if($level==$prelevel){
        $html.='<li></ul>';
    }
    return $html;
}

function getUserTempId(){
    if(session()->has('USER_TEMP_ID')==null){
        $rand=rand(111111111,999999999);
        session()->put('USER_TEMP_ID',$rand);
        return $rand;
    }else{
        return session()->get('USER_TEMP_ID');
    }
}





?>