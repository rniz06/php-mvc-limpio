<?php

    class Paginas extends Controlador{
        public function __construct(){
            
        }
        public function index(){           
            $datos = [
                'titulo' => 'Bienvendos a MVC Ronald Niz'
            ];
            
            $this->vista('paginas/inicio', $datos);
        }
    }