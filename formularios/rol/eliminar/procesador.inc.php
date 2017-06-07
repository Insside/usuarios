<?php
/**
 * Este archivo recibe el nombre del archivo a eliminar y realiza la accion si valoraciones adiciones su
 * proceso implica dos acciones eliminar el registro de la base de datos y eliminar fisicamente el archivo
 * */
$rol=$validaciones->recibir("rol");
$itable=$validaciones->recibir("itable");
$roles->eliminar($rol); 
$f->windowClose();
$f->JavaScript("if(".$itable."){".$itable.".refresh();}");
?>