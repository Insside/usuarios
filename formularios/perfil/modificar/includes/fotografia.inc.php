<?php
$info = "<p>Para cambiar la imagen de un perfil seleccione la preferiblemente la fotografía u avatar que desee utilizar, y presione actualizar.</p>";
$f->campos['archivo'] = $f->archivo("archivo" . $f->id, "image/*", $class = "");
/** Celdas * */
$f->celdas["pf-info"] = $f->celda("", $info);
$f->celdas["pf-archivo"] = $f->celda("Archivo:", $f->campos['archivo']);
/** Filas * */
$f->fila['pf-f1'] = $f->fila($f->celdas["pf-info"]);
$f->fila['pf-f2'] = $f->fila($f->celdas["pf-archivo"]);

$f->celdas["pf-foto"] = $f->celda("", $f->campos['foto2'], "", "w200");
$f->celdas["pf-campos"] = $f->celda("", $f->fila['pf-f1'] . $f->fila['pf-f2']);
/** Compilando * */
$f->fila["fotografia"] = $f->fila($f->celdas["pf-foto"] . $f->celdas["pf-campos"]);
?>
<script type="text/javascript">
    if ($('archivo<?php echo($f->id); ?>')) {
        $('archivo<?php echo($f->id); ?>').addEvent('change', function (e) {
            console.log("Cargando archivo...");
            var uploader = new MUI.Uploader({
                "emulation": false,
                "urlEncoded": false,
                "url": "archivos/index.php",
                "async": false,
                "data": {
                    "modulo": "002",
                    "accion":"usuarios-perfiles-foto",
                    "usuario_perfil":"<?php echo($perfil['perfil']);?>"
                },
                "onRequest": function () {
                    $("photo<?php echo($f->id);?>").setProperty("src","imagenes/gifs/loader-profile-photo.gif");
                    //console.log('start');
                },
                "onComplete": function (response) {
                    //console.log(response);
                    var datos= JSON.decode(response);
                    console.log(datos.vista);
                    $("photo<?php echo($f->id);?>").setProperty("src",datos.url);
                    //MUI.closeWindow($('{$this->ventana}'));
                    //console.log(response);
                    //console.log('completed');
                },
                "onProgress": function (event, xhr) {
                    if (event.lengthComputable) {
                        var percentComplete = event.loaded / event.total;
                        //console.log('percent completed: ' + percentComplete.toString());
                    } else {
                        //console.log("Unable to compute progress information since the total size is unknown");
                    }
                }
            });
            uploader.addFile("archivo<?php echo($f->id); ?>");
            uploader.send();
        });
    }
</script>