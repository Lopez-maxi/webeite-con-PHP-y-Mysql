<?php
    $servidor="localhost";
    $basdeDatos="website";
    $usuario="root";
    $contraseña="";

    try{
        $conexion= new PDO("mysql:host=$servidor;dbname=$basdeDatos",$usuario,$contraseña);
    }catch(Exception $error){
        echo $error->getMessage();
    }
?>