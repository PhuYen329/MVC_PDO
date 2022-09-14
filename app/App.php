<?php
class APP{
    private $__controllers,$__actions,$__params;
    function __construct()
    {
        global $routes;
        if(!empty($routes['default_controllers'])){
            $this->__controllers=$routes['default_controllers'];
        }
        $this->__actions='index';
        $this->__params=[];
        $this->handleURL();
    }
    function getURL(){
        if(!empty($_SERVER['PATH_INFO'])){
            $url=$_SERVER['PATH_INFO'];
        }else{
            $url='/';
        }
        return $url;
    }
    public function handleURL(){
        $url=$this->getURL();
        $urlArray=array_filter(explode("/",$url));
        $urlArray=array_values($urlArray);
        //xử lý controller
        if(!empty($urlArray[0])){
            $this->__controllers=ucfirst($urlArray[0]);
           
        }else{
            $this->__controllers=ucfirst($this->__controllers);
        }
        if(file_exists('app/controllers/'.($this->__controllers).'.php'))
        {
         //controller có tồn tại không
         require_once 'app/controllers/'.($this->__controllers).'.php';
         //kiểm tra class $this->__$controller có tồn tại không
         if(class_exists($this->__controllers)){
            $this->__controllers=new $this->__controllers();
            unset($urlArray[0]);
         }else{
            $this->loadErrors();
         }
         
        }else{
             $this->loadErrors();
        }
        //xử lý action
        if(!empty($urlArray[1])){
            $this->__actions=$urlArray[1];
            unset($urlArray[1]);
        }
        // echo '<pre>';print_r($urlArray); echo'</pre>';
        //xử lý param
        $this->__params=array_values($urlArray);
        //kiểm tra method tồn tại
        if(method_exists($this->__controllers,$this->__actions)){
            call_user_func_array([$this->__controllers,$this->__actions],$this->__params);
        }else{
            $this->loadErrors();
        }
        

    }
    public function loadErrors($name='404'){
        require_once 'errors/'.$name.'.php';
    }
}