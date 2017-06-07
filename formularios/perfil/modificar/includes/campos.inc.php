<?php
$um=new Usuarios_Modulo();
$empresa=Sesion::getValue("empresa");
$modulo= $um->getModulo();
$id=time();
/** Campos * */
$f->oculto("grid", $validaciones->recibir("grid"));
$f->oculto("perfil", $validaciones->recibir("perfil"));
$f->campos['archivo'] ="<div class=\"fileUpload btn btn-primary\"><div class=\"i032x032_changephoto\"></div>".$f->archivo("archivo" . $f->id, "image/*", $class = "fileupload")."</div>";
$f->campos['info'] = $perfil['info'];
$f->campos['equipo'] = $f->campo("equipo", $equipo['equipo'] . ": " . $equipo['nombre']);
//$f->campos['perfil'] = $f->campo("perfil", $perfil['perfil']);
$f->campos['documento'] = $componentes->combo_documentos("documento",$perfil['documento']);
$f->campos['identificacion'] = $f->iTextBox("identificacion","identificacion",$perfil['identificacion'],"required","10");
$f->campos['sexo'] =$componentes->combo_sexo("sexo",$perfil['sexo']);
$f->campos['nombres'] = $f->text("nombres", $perfil['nombres'], "128", "required", false);
$f->campos['apellidos'] = $f->text("apellidos", $perfil['apellidos'], "128", "required", false);
$f->campos['direccion'] = $f->text("direccion", $perfil['direccion'], "128", "required", false);
$f->campos['telefonos'] = $f->text("telefonos", $perfil['telefonos'], "128", "required", false);
$f->campos['correo'] = $f->text("correo", $perfil['correo'], "128", "required", false);
$f->campos['creador'] = $f->campo("creador", $perfil['creador']);
$f->campos['foto'] = "<div><img id=\"photo{$f->id}\" src=\"archivos/imagen.php?time={$id}&image={$empresa}/{$modulo}/" . $perfil['foto'] . "&width=240&height=320\"/></div>";
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "submit", "Guardar");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['responsabilizar'] = $f->button("responsabilizar" . $f->id, "button", "Responsabilizar");

$f->campos['clave'] = $f->clave("clave" . $f->id, $usuario['clave'], "128", "required", false);
$f->campos['confirmacion'] = $f->clave("confirmacion" . $f->id, $usuario['clave'], "128", "required", false);
?>