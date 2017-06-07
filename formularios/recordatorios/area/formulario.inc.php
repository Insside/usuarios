<?php
/** Variables **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$uu=new Usuarios_Usuario(Sesion::getUsuario());
$up=new Usuarios_Perfil($uu->getUsuario());
$ue=new Usuarios_Equipo($uu->getEquipo());
/** Valores **/

/** Campos **/
$message="
    <p>Bienvenido se te recuerda, 
    que actualmente haces parte del equipo de 
    trabajo asociado al centro de costos <b>{$ue->getNombre()}</b>, 
    debes recordar que dependiendo del equipo al cual te encuentres vinculado es posible que la información que 
    observes tenga variaciones, de igual forma procesos como la atención a 
    solicitudes registra cada procedimiento con un origen especifico y si estas 
    registrado para realizar labores en un área que no corresponde a tu actual 
    designación podrias afectar la información ingresada.
    </p>";
//$f->campos['usuario']=$f->campo("usuario",$valores['usuario']);
//$f->campos['perfil']=$f->campo("perfil",$valores['perfil']);
//$f->campos['alias']=$f->campo("alias",$valores['alias']);
//$f->campos['clave']=$f->campo("clave",$valores['clave']);
//$f->campos['token']=$f->campo("token",$valores['token']);
//$f->campos['equipo']=$f->campo("equipo",$valores['equipo']);
//$f->campos['fecha']=$f->campo("fecha",$valores['fecha']);
//$f->campos['hora']=$f->campo("hora",$valores['hora']);
//$f->campos['creador']=$f->campo("creador",$valores['creador']);
//$f->campos['estado']=$f->campo("estado",$valores['estado']);
$f->campos['ayuda']=$f->button("ayuda".$f->id, "button","Ayuda");
$f->campos['cancelar']=$f->button("cancelar".$f->id, "button","Cerrar");
$f->campos['continuar']=$f->button("continuar".$f->id, "submit","Continuar");
/** Celdas **/
//$f->celdas["alias"]=$f->celda("Alias:",$f->campos['alias']);
//$f->celdas["clave"]=$f->celda("Clave:",$f->campos['clave']);
//$f->celdas["token"]=$f->celda("Token:",$f->campos['token']);
//$f->celdas["equipo"]=$f->celda("Equipo:",$f->campos['equipo']);
//$f->celdas["fecha"]=$f->celda("Fecha:",$f->campos['fecha']);
//$f->celdas["hora"]=$f->celda("Hora:",$f->campos['hora']);
//$f->celdas["creador"]=$f->celda("Creador:",$f->campos['creador']);
//$f->celdas["estado"]=$f->celda("Estado:",$f->campos['estado']);
/** Filas **/
$f->fila["info"]=$f->getNotification(array("image"=>"foco","message"=>$message));
//$f->fila["fila1"]=$f->fila($f->celdas["usuario"].$f->celdas["perfil"].$f->celdas["alias"].$f->celdas["clave"]);
//$f->fila["fila2"]=$f->fila($f->celdas["token"].$f->celdas["equipo"].$f->celdas["fecha"].$f->celdas["hora"]);
//$f->fila["fila3"]=$f->fila($f->celdas["creador"].$f->celdas["estado"]);
/** Compilando **/
$f->filas($f->fila['info']);
//$f->filas($f->fila['fila2']);
//$f->filas($f->fila['fila3']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
//$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts **/
$f->windowTitle("Recordatorios / Area ","0.1");
$f->windowResize(array("autoresize"=>false,"width"=>"480","height"=>"220"));
$f->windowCenter();
$f->eClick("cancelar".$f->id,"MUI.closeWindow($('".$f->ventana."'));");
$f->setAudio(array("src"=>"modulos/usuarios/multimedia/audios/recordatorio-area-vinculada.mp3","autoplay"=>true));
?>
