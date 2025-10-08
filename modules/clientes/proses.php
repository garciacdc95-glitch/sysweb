<?php
session_start();
require_once "../../config/database.php";

// Validar sesión
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    exit;
}

// Insertar cliente
if ($_GET['act'] == 'insert') {
    if (isset($_POST['Guardar'])) {
        // Validar existencia de cada campo
        $ci_ruc       = isset($_POST['ci_ruc']) ? $_POST['ci_ruc'] : '';
        $cli_nombre   = isset($_POST['cli_nombre']) ? trim(strtoupper($_POST['cli_nombre'])) : '';
        $cli_apellido = isset($_POST['cli_apellido']) ? trim(strtoupper($_POST['cli_apellido'])) : '';
        $cli_direccion= isset($_POST['cli_direccion']) ? $_POST['cli_direccion'] : '';
        $cli_telefono = isset($_POST['cli_telefono']) ? $_POST['cli_telefono'] : '';
        $cod_ciudad   = isset($_POST['cod_ciudad']) ? $_POST['cod_ciudad'] : '';

        // Validar duplicado por RUC
        $verificar_ruc = mysqli_query($mysqli, "SELECT id_cliente FROM clientes WHERE ci_ruc = '$ci_ruc'");
        if (mysqli_num_rows($verificar_ruc) > 0) {
            header("Location: ../../main.php?module=clientes&alert=5"); // RUC ya existe
            exit;
        }

        // Insertar cliente
        $query = mysqli_query($mysqli, "INSERT INTO clientes (ci_ruc, cli_nombre, cli_apellido, cli_direccion, cli_telefono, cod_ciudad)
                                        VALUES ('$ci_ruc', '$cli_nombre', '$cli_apellido', '$cli_direccion', '$cli_telefono', '$cod_ciudad')")
                 or die('Error: ' . mysqli_error($mysqli));

        header("Location: ../../main.php?module=clientes&alert=1");
        exit;
    }
}

// Actualizar cliente
elseif ($_GET['act'] == 'update') {
    if (isset($_POST['Guardar'])) {
        $id_cliente   = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : '';
        $ci_ruc       = isset($_POST['ci_ruc']) ? $_POST['ci_ruc'] : '';
        $cli_nombre   = isset($_POST['cli_nombre']) ? trim(strtoupper($_POST['cli_nombre'])) : '';
        $cli_apellido = isset($_POST['cli_apellido']) ? trim(strtoupper($_POST['cli_apellido'])) : '';
        $cli_direccion= isset($_POST['cli_direccion']) ? $_POST['cli_direccion'] : '';
        $cli_telefono = isset($_POST['cli_telefono']) ? $_POST['cli_telefono'] : '';
        $cod_ciudad   = isset($_POST['cod_ciudad']) ? $_POST['cod_ciudad'] : '';

        // Validar duplicado RUC excluyendo actual
        $verificar_ruc = mysqli_query($mysqli, "SELECT id_cliente FROM clientes WHERE ci_ruc = '$ci_ruc' AND id_cliente != '$id_cliente'");
        if (mysqli_num_rows($verificar_ruc) > 0) {
            header("Location: ../../main.php?module=clientes&alert=5"); // RUC ya existe
            exit;
        }

        // Actualizar cliente
        $query = mysqli_query($mysqli, "UPDATE clientes 
                                        SET ci_ruc='$ci_ruc', cli_nombre='$cli_nombre', cli_apellido='$cli_apellido', 
                                            cli_direccion='$cli_direccion', cli_telefono='$cli_telefono', cod_ciudad='$cod_ciudad'
                                        WHERE id_cliente='$id_cliente'")
                 or die('Error: ' . mysqli_error($mysqli));

        header("Location: ../../main.php?module=clientes&alert=2");
        exit;
    }
}

// Eliminar cliente
elseif ($_GET['act'] == 'delete') {
    if (isset($_GET['id_cliente'])) {
        $id = $_GET['id_cliente'];

        $query = mysqli_query($mysqli, "DELETE FROM clientes WHERE id_cliente='$id'")
                 or die('Error: ' . mysqli_error($mysqli));

        header("Location: ../../main.php?module=clientes&alert=3");
        exit;
    }
}
?>
