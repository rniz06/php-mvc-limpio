<?php
    /*Mapear la url ingresada en el navegador,
    1- Controlador
    2- Metodo
    3- Parametro
    Ejemplo: /articulo/actualizar/4
    */

    class Core{
        protected $controladorActual = 'Paginas';
        protected $metodoActual = 'index';
        protected $parametros = [];

        //Contructor
        public function __construct(){
            //print_r($this->getUrl());
            $url = $this->getUrl();
            // Buscar en controladores si el controlador existe
            if (isset($url[0]) && file_exists('../app/controladores/' . ucwords($url[0]) . '.php')) {
                // Si existe se setea como controlador por defecto
                $this->controladorActual = ucwords($url[0]);
                
                //Unset indice
                unset($url[0]);
            }
            // Requerir el controlador
            require_once '../app/controladores/' . $this->controladorActual . '.php';
            $this->controladorActual = new $this->controladorActual;

            // Verificar la segunda parte de la url que seria el metodo
            if (isset($url[1])) {
                if (method_exists($this->controladorActual, $url[1])) {
                    // Si se cargo, verificamos el metodo
                    $this->metodoActual = $url[1];
                    //Unset indice
                    unset($url[1]);
                }
            }
            // Para probar traer metodo 
            //echo $this->metodoActual;

            // Obtener los posibles parametros
            $this->parametros = $url ? array_values($url) : [];
            // LLamar Callback con parametros array
            call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
        }

        public function getUrl(){
            //echo $_GET['url'];
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }