<?php
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
if (!class_exists("Usuarios_Equipo")) {
    require_once($ROOT . "modulos/usuarios/librerias/Usuarios_Equipos.class.php");

    class Usuarios_Equipo {

        /** Properties * */
        private $key;
        private $properties;

        /** Methods * */
        public function Usuarios_Equipo($key) {
            $cb = new Usuarios_Equipos();
            $this->key = $key;
            $this->properties = $cb->consultar($this->key);
        }

        /** Getters * */
        private function getValue($key) {
            return($this->properties[$key]);
        }

        public function getEquipo() {
            return($this->getValue("equipo"));
        }

        public function getNombre() {
            return($this->getValue("nombre"));
        }

        public function getDescripcion() {
            return($this->getValue("descripcion"));
        }

        public function getCreador() {
            return($this->getValue("creador"));
        }

        public function getFecha() {
            return($this->getValue("fecha"));
        }

        public function getHora() {
            return($this->getValue("hora"));
        }

        /** Setters * */
        private function setValue($key, $value) {
            $this->properties[$key] = $value;
        }

        public function setEquipo($value) {
            $this->setValue("equipo", $value);
        }

        public function setNombre($value) {
            $this->setValue("nombre", $value);
        }

        public function setDescripcion($value) {
            $this->setValue("descripcion", $value);
        }

        public function setCreador($value) {
            $this->setValue("creador", $value);
        }

        public function setFecha($value) {
            $this->setValue("fecha", $value);
        }

        public function setHora($value) {
            $this->setValue("hora", $value);
        }

        /**
         * (PHP 4 >= 4.0.6, PHP 5, PHP 7)<br/>
         * Method syncUp <<sincronizar>> 
         * Este metodo sincroniza los datos modificados en el objeto
         * con la información almacenada en la base de datos.
         * Se ejecuta como una acción sin parametros adicionales.
         * */
        public function syncUp() {
            $cb = new Usuarios_Equipos();
            foreach ($this->properties as $key => $value) {
                $cb->actualizar($this->key, $key, $value);
            }
        }

    }

}
?>