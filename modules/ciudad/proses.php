<?php
session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    exit;
}

if ($_GET['act'] == 'insert') {
    if (isset($_POST['Guardar'])) {
        $cod_ciudad = $_POST['cod_ciudad'];
        $descrip_ciudad = trim(strtoupper($_POST['descrip_ciudad']));
        $id_departamento = $_POST['id_departamento'];

        // Validar duplicado por código
        $verificar_codigo = mysqli_query($mysqli, "SELECT cod_ciudad FROM ciudad WHERE cod_ciudad = '$cod_ciudad'");
        if (mysqli_num_rows($verificar_codigo) > 0) {
            header("Location: ../../main.php?module=ciudad&alert=5"); // Código ya existe
            exit;
        }

        // Validar duplicado por nombre en el mismo departamento
        $verificar_nombre = mysqli_query($mysqli, "SELECT cod_ciudad FROM ciudad 
                                                   WHERE UPPER(descrip_ciudad) = '$descrip_ciudad' 
                                                   AND id_departamento = '$id_departamento'");
        if (mysqli_num_rows($verificar_nombre) > 0) {
            header("Location: ../../main.php?module=ciudad&alert=5"); // Ciudad ya existe en ese departamento
            exit;
        }

        // Insertar si no hay duplicados
        $query = mysqli_query($mysqli, "INSERT INTO ciudad (cod_ciudad, descrip_ciudad, id_departamento) 
                                        VALUES ('$cod_ciudad', '$descrip_ciudad', '$id_departamento')")
                 or die('Error: ' . mysqli_error($mysqli));

        header("Location: ../../main.php?module=ciudad&alert=1");
        exit;
    }
}

elseif ($_GET['act'] == 'update') {
    if (isset($_POST['Guardar'])) {
        $cod_ciudad = $_POST['cod_ciudad'];
        $descrip_ciudad = trim(strtoupper($_POST['descrip_ciudad']));
        $id_departamento = $_POST['id_departamento'];

        // Validar duplicado por nombre en el mismo departamento, excluyendo el actual
        $verificar_nombre = mysqli_query($mysqli, "SELECT cod_ciudad FROM ciudad 
                                                   WHERE UPPER(descrip_ciudad) = '$descrip_ciudad' 
                                                   AND id_departamento = '$id_departamento' 
                                                   AND cod_ciudad != '$cod_ciudad'");
        if (mysqli_num_rows($verificar_nombre) > 0) {
            header("Location: ../../main.php?module=ciudad&alert=5"); // Ciudad ya existe en ese departamento
            exit;
        }

        // Actualizar si no hay duplicados
        $query = mysqli_query($mysqli, "UPDATE ciudad SET descrip_ciudad = '$descrip_ciudad', id_departamento = '$id_departamento' 
                                        WHERE cod_ciudad = '$cod_ciudad'")
                 or die('Error: ' . mysqli_error($mysqli));

        header("Location: ../../main.php?module=ciudad&alert=2");
        exit;
    }
}

elseif ($_GET['act'] == 'delete') {
    if (isset($_GET['cod_ciudad'])) {
        $id = $_GET['cod_ciudad'];

        $query = mysqli_query($mysqli, "DELETE FROM ciudad WHERE cod_ciudad = '$id'")
                 or die('Error: ' . mysqli_error($mysqli));

        header("Location: ../../main.php?module=ciudad&alert=3");
        exit;
    }
}
