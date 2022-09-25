<?php
class products extends controller{
    public $model_product;
    public function __construct()
    {
       $this->model_product=$this->model('ProductModel'); 
    }
    public function index(){
        $data['data']=$this->model_product->getList();
        var_dump(json_encode($data));
    }
    public function List_product(){
        $msp="sp2";
        $gia=30;
        $data=$this->model_product->updateProduct($msp,$gia);
        echo "<pre>";print_r($data);echo"</pre>";
       
    }
    public function detail(){
        $data['data']=$this->model_product->getList();
        $this->render('Page/Admin/Home/index',$data);
    }
}
?>