<?php

class InfoController{
    public function showAction(){
        $home = new View('info');
        if(isset($_GET['info'])){
            $content = $_GET['info'];
        }else{
            $content = "Error: Empty message!";
        }
        $home->assign('content', $content);

        $layout = new View('layout');
        $layout->import('content', $home);
        $layout->display();
    }
}