<?php

class View {

    private $name;
    private $path;
    private $data = [];
    private $templates = [];

    public function __construct($name)
    {
        $this->path = __DIR__.'/../templates/'.$name.'.php';
        if(!file_exists($this->path)) {
            throw new Exception('Template not found');
        }
        $this->name = $name;
    }

    public function assign($key, $value){
        $this->data[$key] = $value;
    }

    public function display(){
        echo $this->fetch();
    }

    public function import($name, &$template)
    {
        $this->templates[$name] = $template;
    }
    public function fetch(){


        foreach ($this->templates as $name=>$template){
            $this->data[$name] = $template->fetch();
        }
        ob_start();
        extract($this->data);
        require $this->path;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}
