<?php
//$ROOT = (!isset($ROOT)) ? "../../" : $ROOT;
//require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
//require_once($ROOT."modulos/usuarios/librerias/Usuarios_Componentes.class.php");
//$t = new Usuarios_Componentes();
//$t->regenerar();
?>
<style>
    #splashscreen .logo{
        height: 240px;
        padding-top: 24px;
        width: 640px;
        z-index: 100;
    }
    #splashscreen .foto {
   background-image: url("modulos/usuarios/imagenes/portada.fw.png");
    background-size: auto 100%;
    height: 100%;
    }
    #splashscreen .logo .titular {
        border-bottom: 1px solid #cccccc;
        border-top: 1px solid #cccccc;
        color: #444;
        font-family: RobotoThinItalic;
        font-size: 24px;
        left: 20px;
        margin-bottom: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        position: relative;
        width: 400px;
    }

    #splashscreen .logo .imagen {
        position: relative;
        margin-left: 20px;
        float: left;
    }

    #splashscreen .logo .imis {
        color: #000000;
        float: left;
        font-family: EuroStyleBE;
        font-size: 100px;
        left: 20px;
        line-height: 100px;
        position: relative;
    }

    #splashscreen .logo .modulo {
        color: #ffbf00;
        float: left;
        font-family: EuroStyleBE;
        font-size: 60px;
        left: 20px;
        line-height: 50px;
        position: relative;
        top: -10px;
    }


#splashscreen .mensaje {
    background-position: left center;
    background-repeat: no-repeat;
    float: left;
    padding-top: 20px;
    position: absolute;
}

</style>
<div id="splashscreen">
    <div class="logo">
        <div class="titular">Modulo de Usuarios</div>
        <div class="imagen"><img src="modulos/usuarios/imagenes/logo.fw.png"/></div>
        <div class="imis">i:MIS</div>
        <div class="modulo">USR</div>
    </div>
    <div class="foto foto"></div>
    <div class="mensaje xrup"><p>Bienvenido al Módulo de Usuarios v.1.5, al lado izquierdo, puede 
            observar el menú donde encontrará los componentes accesibles del presente modulo. 
            Un sistema que involucra a todo o gran parte del personal, requiere de un control estricto de a qué 
            información se quiere dar acceso y cuál es el grado de permisos que queremos asignar a cada 
            empleado. Al definir la organización como una estructura jerárquica, se puede definir qué parte 
            de la jerarquía puede visualizar un empleado, permitiendo al mismo que descienda en la jerarquía 
            hasta el nivel deseado, pero que no pueda ascender por la misma, más allá de lo que se le ha autorizado. 
            Diferentes roles permiten asignar a cada usuario que pueden hacer con la información, sólo consultarla,
            darla de alta o modificarla, visualizar los datos de carácter personal o que éstos permanezcan ocultos. 
        </p>
        <hr>
        <p>
            Para mayor información visite: <a href="http://www.insside.com/plataforma/insside/imis/acceso-y-seguridad.html" target="_blank">Insside / Imis / Usuarios </a>.
        </p></div>
    <div class="container2">
        <div class="container1">
            <div class="col1"></div>
            <div class="col2"></div>
            <div class="col3"></div>
        </div>
    </div>
</div>  