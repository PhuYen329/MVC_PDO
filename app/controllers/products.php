<?php
class products extends controller{
    public $model_product,$data=[];
    public function __construct()
    {
       $this->model_product=$this->model('ProductModel'); 
    }
    public function index(){
        $data['data']=$this->model_product->getProductLists();
        var_dump(json_encode($data));
    }
    public function List_product(){
        $arraydata= array(
            array("masp"=>"sp1","ten san pham"=>"Sản Phẩm 1","gia"=>100000,"hinh"=>"sp11.jpg"),
            array("masp"=>"sp2","ten san pham"=>"Sản Phẩm 2","gia"=>200000,"hinh"=>"sp11.jpg"),
            array("masp"=>"sp3","ten san pham"=>"Sản Phẩm 3","gia"=>300000,"hinh"=>"sp11.jpg"),
        );
        // $this->model_product->updateProduct($arraydata,$msp,$gia);
        // echo "<pre>";print_r($arraydata);echo"</pre>";
        $this->data['data']['listProduct']=$this->model_product->getList();
        $this->data['content']='Admin/Product/ListProduct';//gọi layout 
        $this->view('Admin/index',$this->data);//truyền dữ liệu controller sang view
    }
    public function products($id){
        $this->data["getProduct"]=$this->model_product->getProduct($id);
        return $this->view('Admin/Home/index',$this->data);
    }
    // public function detail(){
    //     //lấy dữ liệu từ model 
    //     $this->data['data']['info']=$this->model_product->getList();
    //     $this->data['data']['title']='chi tiết sản phẩm';//truyền thông tin
    //     $this->data['content']='Admin/Home/index';//gọi layout 
    //     $this->view('Admin/index',$this->data);//truyền dữ liệu controller sang view
    // }
}
?>