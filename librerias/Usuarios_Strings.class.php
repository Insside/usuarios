<?php

if (!class_exists("Usuarios_Strings")) {

    class Usuarios_Strings {
        private $strings;
        public function Usuarios_Strings(){
            $this->strings["0001"]="<p><b>Recuerde</b> El presente formulario le permitirá modificar los roles asignados al usuario <b>%s</b>, sele recuerda que la modificación de estas características afecta el acceso de los usuarios a los diversos modulos y componentes del sistema, del listado localizado en la parte inferior del presente mensaje, seleccione los roles que desea asignar. Verificado el listado de roles seleccionados presione el botón<i> “Asignar”</i> para concluir el procedimiento.</p>";
            $this->strings["0002"]="Usuario / %s / Roles";
            $this->strings["0003"]="<p><b>Recuerde</b>: El presente formulario le permitirá modificar los permisos asignados al rol <b>%s</b>, se le recuerda que la modificación de estas características afecta el acceso de los usuarios a los diversos modulos y componentes del sistema, del listado localizado en la parte inferior del presente mensaje, seleccione los permisos que desea asignar.Verificado el listado de permisos asignados presione el botón <i>“Asignar”</i> para concluir el procedimiento.</p>";
            $this->strings["0004"]="Rol / %s / Permisos";
            
        }
        
        public function getString($cadena){
            return($this->strings[$cadena]);
        }
    
    }

}
?>