<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Clientes</li>
    </ol>
    <br><hr>
    <h1>
        <i class="fa fa-users icon-title"></i> Datos de Clientes
        <a class="btn btn-primary btn-social pull-right" href="?module=form_clientes&form=add" title="Agregar" data-toggle="tooltip">
            <i class="fa fa-plus"></i> Agregar
        </a>
        <a class="btn btn-warning btn-social pull-right" href="modules/clientes/print.php" target="_blank" style="margin-right:10px;">
            <i class="fa fa-print"></i> Imprimir
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php
            // ==== ALERTAS ====
            if (empty($_GET['alert'])) {
                echo "";
            } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Éxito!</h4>
                        Datos registrados correctamente.
                    </div>";
            } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Éxito!</h4>
                        Datos modificados correctamente.
                    </div>";
            } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Éxito!</h4>
                        Datos eliminados correctamente.
                    </div>";
            } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                        No se pudo realizar la operación.
                    </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <h2>Lista de Clientes</h2>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" width="80">Código</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Apellido</th>
                                <th class="text-center">RUC</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center" width="120">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // ==== CONSULTA DESDE LA VISTA ====
                            $query = mysqli_query($mysqli, "SELECT * FROM v_clientes ORDER BY id_cliente ASC")
                                     or die('Error: ' . mysqli_error($mysqli));

                            if (mysqli_num_rows($query) == 0) {
                                echo "<tr><td colspan='7' class='text-center'>No hay datos que mostrar</td></tr>";
                            } else {
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $cod = $data['id_cliente'];
                                    $nombre = $data['cli_nombre'];
                                    $apellido = $data['cli_apellido'];
                                    $ruc = $data['ci_ruc'];
                                    $tel = $data['cli_telefono'];
                                    $dir = $data['cli_direccion'];

                                    echo "<tr>
                                            <td class='text-center'>$cod</td>
                                            <td>$nombre</td>
                                            <td>$apellido</td>
                                            <td class='text-center'>$ruc</td>
                                            <td class='text-center'>$tel</td>
                                            <td>$dir</td>
                                            <td class='text-center'>
                                                <a data-toggle='tooltip' title='Editar' class='btn btn-primary btn-sm' href='?module=form_clientes&form=edit&id=$cod'>
                                                    <i class='glyphicon glyphicon-edit' style='color:#fff'></i>
                                                </a>
                                                <a data-toggle='tooltip' title='Eliminar' class='btn btn-danger btn-sm' href='modules/clientes/proses.php?act=delete&id_cliente=$cod' onclick=\"return confirm('¿Eliminar el cliente $nombre $apellido?')\">
                                                    <i class='glyphicon glyphicon-trash'></i>
                                                </a>
                                            </td>
                                          </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
