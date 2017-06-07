<?php

$cadenas = new Cadenas();
$usuarios = new Usuarios();
$roles = new Usuarios_Roles();
$politicas = new Usuarios_Politicas();
$jerarquias = new Usuarios_Jerarquias();
$perfiles=new Usuarios_Perfiles();
$us=new Usuarios_Strings();

$usuario =new Usuarios_Usuario($v->getValue("usuario"));
$perfil=new Usuarios_Perfil($usuario->getPerfil());
/** Cadenas **/
$title=sprintf($us->getString("0002"),$perfil->getNombre());
$message=sprintf($us->getString("0001"),$usuario->getAlias());
$version="1.4";
/** Procesos * */
$html = "<div style=\"height:180px; overflow-y:scroll;\">";
$db = new MySQL(Sesion::getConexion());
$sql = "SELECT * FROM `usuarios_roles` ORDER BY `rol`";
$consulta = $db->sql_query($sql);
$total = $db->sql_numrows($consulta);
$conteo = 0;
while ($fila = $db->sql_fetchrow($consulta)) {
    $conteo++;
    $class = 'even';
    if ($conteo % 2 == 0) {
        $class = 'odd';
    }
    $estado = $jerarquias->estado($fila['rol'], $usuario->getUsuario());
    $html .= ("<div class=\"fila\" style=\"border:1px solid #cccccc;\"><div class=\"columna\"><input name=\"roles[" . $fila['rol'] . "]\" type=\"checkbox\" value=\"true\" " . (($estado) ? 'checked="checked"' : '') . "/></td><td align=\"left\" nowrap>&nbsp;<b>" . $fila['nombre'] . "</b></div></div>");
}
$db->sql_close();
$html .= "</div>";
/** Campos * */
$f->oculto("usuario", $usuario->getUsuario());
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['asignar'] = $f->button("asignar" . $f->id, "submit", "Asignar");
/** Celdas * */
$f->celdas["permisos"] = $f->celda("", $html);
/** Filas * */
$f->fila["info"] =$f->getNotification(array("image"=>"rols","message"=>$message));
$f->fila["fila1"] =$html;
/** Compilando * */
$f->filas($f->fila['info']);
$f->filas($f->fila['fila1']);
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['asignar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** Javascripts * */
$f->windowTitle($title,$version);
$f->windowResize(array("autoresize" => false, "width" => "550", "height" => "370"));
$f->windowCenter();
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>