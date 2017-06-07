<?php

if (!class_exists("Usuarios_Perfil")) {
    if (!class_exists("Usuarios_Perfiles")) {
        require_once(ROOT . "modulos/usuarios/librerias/Usuarios_Perfiles.class.php");
    }

    class Usuarios_Perfil {

        /** Properties * */
        private $key;
        public $properties;

        /** Methods * */
        public function Usuarios_Perfil($key) {
            $cb = new Usuarios_Perfiles();
            $this->key = $key;
            $this->properties = $cb->consultar($this->key);
            //print_r($this->properties);
        }

        /** Getters * */
        private function getValue($key) {
            return($this->properties[$key]);
        }

        public function getPerfil() {
            return($this->getValue("perfil"));
        }

        public function getDocumento() {
            return($this->getValue("documento"));
        }

        public function getIdentificacion() {
            return($this->getValue("identificacion"));
        }

        public function getNombres() {
            return($this->getValue("nombres"));
        }

        public function getApellidos() {
            return($this->getValue("apellidos"));
        }

        public function getNombre() {
            return($this->getValue("nombres") . " " . $this->getValue("apellidos"));
        }

        public function getDireccion() {
            return($this->getValue("direccion"));
        }

        public function getTelefonos() {
            return($this->getValue("telefonos"));
        }

        public function getCorreo() {
            return($this->getValue("correo"));
        }

        public function getSexo() {
            return($this->getValue("sexo"));
        }

        public function getFoto() {
            return($this->getValue("foto"));
        }

        public function getCreado() {
            return($this->getValue("creado"));
        }

        public function getActualizado() {
            return($this->getValue("actualizado"));
        }

        public function getCreador() {
            return($this->getValue("creador"));
        }

        /** Setters * */
        private function setValue($key, $value) {
            $this->properties[$key] = $value;
        }

        public function setPerfil($value) {
            $this->setValue("perfil", $value);
        }

        public function setDocumento($value) {
            $this->setValue("documento", $value);
        }

        public function setIdentificacion($value) {
            $this->setValue("identificacion", $value);
        }

        public function setNombres($value) {
            $this->setValue("nombres", $value);
        }

        public function setApellidos($value) {
            $this->setValue("apellidos", $value);
        }

        public function setDireccion($value) {
            $this->setValue("direccion", $value);
        }

        public function setTelefonos($value) {
            $this->setValue("telefonos", $value);
        }

        public function setCorreo($value) {
            $this->setValue("correo", $value);
        }

        public function setSexo($value) {
            $this->setValue("sexo", $value);
        }

        public function setFoto($value) {
            $this->setValue("foto", $value);
        }

        public function setCreado($value) {
            $this->setValue("creado", $value);
        }

        public function setActualizado($value) {
            $this->setValue("actualizado", $value);
        }

        public function setCreador($value) {
            $this->setValue("creador", $value);
        }

        /**
         * (PHP 4 >= 4.0.6, PHP 5, PHP 7)<br/>
         * Method syncUp <<sincronizar>> 
         * Este metodo sincroniza los datos modificados en el objeto
         * con la información almacenada en la base de datos.
         * Se ejecuta como una acción sin parametros adicionales.
         * */
        public function syncUp() {
            $cb = new Usuarios_Perfiles();
            foreach ($this->properties as $key => $value) {
                $cb->actualizar($this->key, $key, $value);
            }
        }

    }

}
?>