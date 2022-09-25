<?php 
class controller{
    public function model($model){
        //kiểm tra file có tồn tại không
        if(file_exists(_Dir_Root.'/app/models/'.$model.'.php')){
            require_once _Dir_Root.'/app/models/'.$model.'.php';
            if(class_exists($model)){
                $model=new $model();
                return $model;
            } 
        }
        return false;
        
    }
    public function render($views,$data=[]){
        if(file_exists(_Dir_Root.'/app/views/'.$views.'.php')){
            require_once _Dir_Root.'/app/views/'.$views.'.php';
        }
    }
}
?>