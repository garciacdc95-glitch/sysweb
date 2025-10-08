<?php
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);
$options->setDefaultFont('DejaVu Sans');

$dompdf = new Dompdf($options);

// Consulta de clientes usando la vista v_clientes
$query = mysqli_query($mysqli, "SELECT id_cliente, ci_ruc, cli_nombre, cli_apellido, cli_telefono, descrip_ciudad, dep_descripcion
                                FROM v_clientes")
         or die('Error: ' . mysqli_error($mysqli));

$count = mysqli_num_rows($query);

// Ruta del logo
$logo = "http://localhost/sysweb/images/asuncion.jpg";

// Generar HTML
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Clientes</title>
<style>
body { font-family: DejaVu Sans, sans-serif; margin: 20px; }
.titulo { text-align:center; font-size:20px; font-weight:bold; margin-bottom:10px; }
.conteo { text-align:center; margin-bottom:20px; font-size:14px; }
img.logo { display:block; margin:0 auto 15px auto; width:120px; height:auto; }
table { width:100%; border-collapse: collapse; margin-top:10px; }
th, td { border:1px solid #000; padding:8px; text-align:center; font-size:13px; }
th { background:#e8ecee; }
</style>
</head>
<body>
<img src="<?php echo $logo; ?>" class="logo" alt="Logo">
<div class="titulo">Reporte de Clientes</div>
<div class="conteo">Cantidad total: <?php echo $count; ?></div>
<table>
<thead>
<tr>
    <th>ID</th>
    <th>RUC</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Teléfono</th>
    <th>Ciudad</th>
    <th>Departamento</th>
</tr>
</thead>
<tbody>
<?php
if ($count == 0) {
    echo "<tr><td colspan='7'>No hay datos que mostrar</td></tr>";
} else {
    while($data = mysqli_fetch_assoc($query)) {
        echo "<tr>
                <td>{$data['id_cliente']}</td>
                <td>{$data['ci_ruc']}</td>
                <td>{$data['cli_nombre']}</td>
                <td>{$data['cli_apellido']}</td>
                <td>{$data['cli_telefono']}</td>
                <td>{$data['descrip_ciudad']}</td>
                <td>{$data['dep_descripcion']}</td>
              </tr>";
    }
}
?>
</tbody>
</table>
</body>
</html>
<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_clientes.pdf", ["Attachment" => false]);
?>
