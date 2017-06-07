<?php

                    $permisos->crear("USUARIOS-ROLES", "Permite acceder al componente roles del modulo usuarios", "SISTEMA");
            $permisos->crear("USUARIOS-ROLES-R", "Permite ver los roles existentes en el sistema.", "SISTEMA");
            $permisos->crear("USUARIOS-ROLES-W", "Permite crear o definir roles.", "SISTEMA");
            $permisos->crear("USUARIOS-ROLES-D", "Permite eliminar roles en el sistema.", "SISTEMA");
 
            $this->permisos = new Usuarios_Permisos();
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-MODULO-A", "Acceso Modulo De Usuarios", "Permite acceder al modulo Usuarios.", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-USUARIOS-R", "Visualizar Usuarios", "Permite visualizar los usuarios del sistema.", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-USUARIOS-W", "Crear Usuarios", "Permite crear o actualizar usuarios en el sistema", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-USUARIOS-U", "Actualizar Usuario", "Permite acceder al modulo Usuarios.", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-USUARIOS-D", "Eliminar Usuarios", "Permite acceder al modulo Usuarios.", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-EQUIPOS-A", "Acceso al componente equipos.", "Permite acceder al componente equipos de trabajo.", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-EQUIPOS-R", "Visualizar equipos de trabajo existentes.", "Permite acceder al componente equipos de trabajo.", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-EQUIPOS-W", "Crear equipos de trabajo.", "Permite acceder al componente equipos de trabajo.", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-EQUIPOS-U", "Actualizar equipos de trabajo existentes.", "Permite acceder al componente equipos de trabajo.", "0000000000");
            $this->permisos->permiso_crear($this->modulo, "USUARIOS-EQUIPOS-D", "Eliminar equipos de trabajo existentes.", "Permite acceder al componente equipos de trabajo.", "0000000000");
  