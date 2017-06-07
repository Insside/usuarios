<?php

if (!class_exists("Usuarios_Usuario")) {
    if (!class_exists("Usuarios_Usuarios")) {
        require_once(ROOT . "modulos/usuarios/librerias/Usuarios_Usuarios.class.php");
    }
        if (!class_exists("Usuarios_Perfil")) {
        require_once(ROOT . "modulos/usuarios/librerias/Usuarios_Perfil.class.php");
    }

    class Usuarios_Usuario {

        /** Properties * */
        private $key;
        private $properties;

        /** Methods * */
        public function Usuarios_Usuario($key) {
            $cb = new Usuarios_Usuarios();
            $this->key = $key;
            $this->properties = $cb->consultar($this->key);
        }

        /** Getters * */
        private function getValue($key) {
            return($this->properties[$key]);
        }

        public function getUsuario() {
            return($this->getValue("usuario"));
        }

        public function getPerfil() {
            return($this->getValue("perfil"));
        }
        
        
        
        public function getNombre(){
            $perfil=new Usuarios_Perfil($this->getPerfil());
            return($perfil->getNombre());
        }

        public function getAlias() {
            return($this->getValue("alias"));
        }

        public function getClave() {
            return($this->getValue("clave"));
        }

        public function getToken() {
            return($this->getValue("token"));
        }

        public function getEquipo() {
            return($this->getValue("equipo"));
        }

        public function getFecha() {
            return($this->getValue("fecha"));
        }

        public function getHora() {
            return($this->getValue("hora"));
        }

        public function getCreador() {
            return($this->getValue("creador"));
        }

        public function getEstado() {
            return($this->getValue("estado"));
        }

        /** Setters * */
        private function setValue($key, $value) {
            $this->properties[$key] = $value;
        }

        public function setUsuario($value) {
            $this->setValue("usuario", $value);
        }

        public function setPerfil($value) {
            $this->setValue("perfil", $value);
        }

        public function setAlias($value) {
            $this->setValue("alias", $value);
        }

        public function setClave($value) {
            $this->setValue("clave", $value);
        }

        public function setToken($value) {
            $this->setValue("token", $value);
        }

        public function setEquipo($value) {
            $this->setValue("equipo", $value);
        }

        public function setFecha($value) {
            $this->setValue("fecha", $value);
        }

        public function setHora($value) {
            $this->setValue("hora", $value);
        }

        public function setCreador($value) {
            $this->setValue("creador", $value);
        }

        public function setEstado($value) {
            $this->setValue("estado", $value);
        }

        /**
         * (PHP 4 >= 4.0.6, PHP 5, PHP 7)<br/>
         * Method syncUp <<sincronizar>> 
         * Este metodo sincroniza los datos modificados en el objeto
         * con la información almacenada en la base de datos.
         * Se ejecuta como una acción sin parametros adicionales.
         * */
        public function syncUp() {
            $cb = new Usuarios_Usuarios();
            foreach ($this->properties as $key => $value) {
                $cb->actualizar($this->key, $key, $value);
            }
        }

    }

}
?>