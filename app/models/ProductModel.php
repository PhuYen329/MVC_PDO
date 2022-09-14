<?php
//kế thừa từ class model 
class ProductModel{
    protected $table='products';
    public function getList(){
        $data=['Item1','Item2','Item3'];  
        return $data;
    }
    public function getProductLists(){
        $data=array(
            array("masp"=>"sp1","ten san pham"=>"Sản Phẩm 1","gia"=>100000,"hinh"=>"sp11.jpg"),
            array("masp"=>"sp2","ten san pham"=>"Sản Phẩm 2","gia"=>200000,"hinh"=>"sp11.jpg"),
            array("masp"=>"sp3","ten san pham"=>"Sản Phẩm 3","gia"=>300000,"hinh"=>"sp11.jpg"),
        );
        return $data;

    }
    public function updateProduct($msp,$gia){
        $arraydata= array(
            array("masp"=>"sp1","ten san pham"=>"Sản Phẩm 1","gia"=>100000,"hinh"=>"sp11.jpg"),
            array("masp"=>"sp2","ten san pham"=>"Sản Phẩm 2","gia"=>200000,"hinh"=>"sp11.jpg"),
            array("masp"=>"sp3","ten san pham"=>"Sản Phẩm 3","gia"=>300000,"hinh"=>"sp11.jpg"),
        );
       
        
        foreach($arraydata as $key=>$value){ 
            if(in_array($msp,$arraydata[$key])){
                $value["gia"]=$gia;
                $arraydata[$key]=$value;
            }
            // if($value["masp"]==$msp){
            //     $value["gia"]=$gia;
            //     $arraydata[$key]=$value;
            // }
        }
        return $arraydata;
       
    }
}
?>