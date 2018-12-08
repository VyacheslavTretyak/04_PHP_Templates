<?php

class Routing{
    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $pos = strpos($uri , '?');
        if($pos !== null){
            $request = substr($uri, $pos+1 );
            parse_str($request, $_GET);
        }
        if($pos == null)
        {
            $pos = strlen($uri);
        }
        $uri = substr($uri, 0, $pos);
        $routings = include 'routings.php';
        foreach ($routings as $patern=>$rout){
            if(preg_match("~^$patern$~", $uri)){
                $res = preg_replace("~^$patern$~", $rout, $uri, 1);
            }
        }
        if($res == false){
            $res = $routings['/'];
        }
        $arr = explode('|',$res);
        $controller = ucfirst(array_shift($arr))."Controller";
        $action = ucfirst( array_shift($arr))."Action";
        $params = array();
        foreach($arr as $param){
            if(strpos($param, '=')!== null){
                $tmp = explode('=',$param);
                $params[$tmp[0]] = $tmp[1];
            }else{
                $params[] = $param;
            }
        }
        $controller = new $controller();
        if(count($params)>0){
            $controller->$action($params);
        }else {
            $controller->$action();
        }
    }

}