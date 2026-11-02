<?php
class Controller
{
    public function __construct()
    {
        $this->session = new session();
        $this->load = new class {
            public function view($viewName, $data = [])
            {
                if (!empty($data)) extract($data);
                $file = './view/' . $viewName . '.php';
                
                // CEK DULU FILE ADA ATAU ENGGAK - BIAR GAK ERROR KAYA DI FOTO
                if (!file_exists($file)) {
                    die("File View tidak ditemukan: <b>$file</b> <br> Silahkan buat dulu file nya di folder view/v_master/");
                }
                
                include $file;
            }
            
            public function model($modelName)
            {
                $file = './model/' . $modelName . '.php';
                if (!file_exists($file)) {
                    die("File Model tidak ditemukan: <b>$file</b>");
                }
                require_once $file;
                $modelName = basename($modelName);
                return new $modelName();
            }
            
            public function post($key = null)
            {
              if ($key === null) {
                  return $_POST;
              }
              return $_POST[$key] ?? null;
            }

            public function get($key = null)
            {
              if ($key === null) {
                 return $_GET;
              }
              return $_GET[$key] ?? null;
            }
        };
    }
}