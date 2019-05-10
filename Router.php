<?php

class Router {
    
    protected $request_uri;
    protected $data;

    public function __construct($data) {
        $this->request_uri = $_SERVER['REQUEST_URI'];
        $this->data = $data;
    }
    
    public function start() {
        
        // сразу главную
        if($this->request_uri == '/') {
            return 'homepage';
        }
        
        if($this->check() < 1) {
            return '404';
        }
        
        $this->request_uri = $this->clear();
        
        return $this->matches();
    }
    
    // проверка правильности URI по шаблону вида /show/1 или /show
    protected function check() {
        return preg_match("#/[^0-9]+/?[0-9]*#",$this->request_uri);
    }
    
    // убрать цифры и слэши
    protected function clear() {
        return preg_replace("#/*[0-9]*#", '', $this->request_uri);
    }
    
    // вернуть совпадения из массива
    protected function matches() {
        if(array_key_exists($this->request_uri, $this->data)) {
            return $this->request_uri;
        }
        else {
            return '404';
        }
    }
    
}