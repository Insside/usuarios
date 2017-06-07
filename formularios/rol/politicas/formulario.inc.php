<?php
$usuario= Sesion::getUser();
$cadenas=new Cadenas();
$v=new Validaciones();
$usuarios = new Usuarios();
$roles=new Usuarios_Roles();
$politicas = new Usuarios_Politicas();
$us=new Usuarios_Strings();
$jerarquias = new Usuarios_Jerarquias();
$rol=$roles->consultar($v->getValue("rol"));
/** Cadenas **/
$title=sprintf($us->getString("0004"),$rol['nombre']);
$message=sprintf($us->getString("0003"),$rol['nombre']);
$version="1.3";
/** Procesos **/
$html="<div style=\"height:150px; overflow-y:scroll;overflow-x:hidden;border:1px solid #cccccc;padding:10px;background-color:#f2f2f2;\">";
  $db = new MySQL(Router::getDefaultConexion());
  $sql = "SELECT * FROM `aplicacion_permisos` ORDER BY `modulo` ASC, `permiso` ASC";
  $consulta = $db->sql_query($sql);
  $total = $db->sql_numrows($consulta);
  $conteo = 0;
  while ($fila = $db->sql_fetchrow($consulta)) {
    $conteo++; 
    $class = 'even';
    if ($conteo % 2 == 0) {$class = 'odd';}
    $estado = $politicas->estado($rol['rol'], $fila['permiso']);
    $html.=("<div class=\"fila\" style=\"border-top:1px solid #cccccc;padding:3px;line-height: 10px;\"><div class=\"columna\"><input name=\"permisos[" . $fila['permiso'] . "]\" type=\"checkbox\" value=\"true\" " . (($estado) ? 'checked="checked"' : '') . "/>&nbsp; <b>{$fila['modulo']}</b> - " . $cadenas->capitalizar($fila['permiso']) . "</div></div>");
  }
  $db->sql_close();
$html.="</div>";
/** Campos **/
$f->oculto("rol", $rol['rol']);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['asignar'] = $f->button("asignar" . $f->id, "submit","Asignar");
/** Celdas **/
$f->celdas["permisos"] = $f->celda("",$html);
/** Filas **/
$f->fila["info"]=$f->getNotification(array("image"=>"keys","message"=>$message));
$f->fila["fila1"] =$html;
/** Compilando **/
$f->filas($f->fila['info']);
$f->filas($f->fila['fila1']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['asignar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** Javascripts **/
$f->windowTitle($title,$version);
$f->windowResize(array("autoresize"=>false,"width"=>"640","height"=>"370"));
$f->windowCenter();
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>