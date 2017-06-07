<?php
/**
 * Este archivo recibe el nombre del archivo a eliminar y realiza la accion si valoraciones adiciones su
 * proceso implica dos acciones eliminar el registro de la base de datos y eliminar fisicamente el archivo
 * */
$up=new Usuarios_Perfiles();
$perfil=$validaciones->recibir("perfil");
$itable=$validaciones->recibir("itable");
$up->eliminar($perfil); 
$f->windowClose();
$f->JavaScript("if(".$itable."){".$itable.".refresh();}");
?>