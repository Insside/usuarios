<?php

/** Filas * */
$f->fila['sf1'] = $f->fila($f->celdas["info"]);
$f->fila['sf2'] = $f->fila($f->celdas["documento"].$f->celdas["identificacion"]);
$f->fila['sf3'] = $f->fila($f->celdas["sexo"]);
$f->fila['sf4'] = $f->fila($f->celdas["nombres"]);
$f->fila['sf5'] = $f->fila($f->celdas["apellidos"]);
/** Celdas Finales **/
$f->celdas["foto"] = $f->celda("", $f->campos['archivo'].$f->campos['foto'], "", "w200");
$f->celdas["datos"] = $f->celda("", $f->fila['sf1'] . $f->fila['sf2'] . $f->fila['sf3'] . $f->fila['sf4'].$f->fila['sf5']);
/** Filas * */
$f->fila["perfil"] = $f->fila($f->celdas["foto"] . $f->celdas["datos"]);
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