<?php
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);
$options->setDefaultFont('DejaVu Sans');

$dompdf = new Dompdf($options);

// Consulta de departamentos
$query = mysqli_query($mysqli, "SELECT id_departamento, dep_descripcion FROM departamento")
         or die('Error: '.mysqli_error($mysqli));
$count = mysqli_num_rows($query);

// Ruta del logo
$logo = "http://localhost/sysweb/images/asuncion.jpg";

// HTML
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Departamentos</title>
<style>
body { font-family: DejaVu Sans, sans-serif; margin: 20px; }
.titulo { text-align:center; font-size:20px; font-weight:bold; margin-bottom:10px; }
.conteo { text-align:center; margin-bottom:20px; font-size:14px; }
table { width:100%; border-collapse: collapse; margin-top:10px; }
th, td { border:1px solid #000; padding:8px; text-align:center; font-size:13px; }
th { background:#e8ecee; }
</style>
</head>
<body>

<!-- Logo centrado -->
<div style="text-align:center; margin-bottom:15px;">
    <img src="<?php echo $logo; ?>" alt="Logo" style="width:120px; height:auto;">
</div>

<div class="titulo">Reporte de Departamentos</div>
<div class="conteo">Cantidad total: <?php echo $count; ?></div>

<table>
<thead>
<tr><th>CÓDIGO</th><th>DESCRIPCIÓN</th></tr>
</thead>
<tbody>
<?php
if ($count == 0) {
    echo "<tr><td colspan='2'>No hay datos que mostrar</td></tr>";
} else {
    while($data = mysqli_fetch_assoc($query)) {
        echo "<tr>
                <td>{$data['id_departamento']}</td>
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
$dompdf->stream("reporte_departamento.pdf", ["Attachment" => false]);
?>
