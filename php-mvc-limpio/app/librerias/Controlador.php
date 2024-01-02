<?php
    // Clase controlador principal
    // Se encarga de de poder cargar los modelos y las vistas
    class Controlador{

        // Cargar modelo
        public function modelo($modelo){
            // Carga
            require_once '../app/modelos/' . $modelo . '.php';
            // Instanciar el modelo
            return new $modelo(); 
        }
        // Cargar vista
        public function vista($vista, $datos = []){
            // Varificamos su el archivo vista existe
            if (file_exists('../app/vistas/' . $vista . '.php')) {
                require_once '../app/vistas/' . $vista . '.php';
            }else {
                // Si el archivo de la vista no existe
                die ('La vista no existe');
            }
        }
    }