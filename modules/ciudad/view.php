<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Ciudad</li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-map-marker icon-title"></i>Datos de Ciudades
        <a class="btn btn-primary btn-social pull-right" href="?module=form_ciudad&form=add" title="Agregar" data-toggle="tooltip">
            <i class="fa fa-plus"></i>Agregar
        </a>
        <!-- Botón de imprimir -->
        <a class="btn btn-warning btn-social pull-right" href="modules/ciudad/print.php" target="_blank" style="margin-right:10px;">
            <i class="fa fa-print"></i> Imprimir
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (empty($_GET['alert'])) {
                echo "";
            } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                        Datos registrados correctamente
                    </div>";
            } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                        Datos modificados correctamente
                    </div>";
            } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                        Datos <strong>eliminados</strong> correctamente
                    </div>";
            } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                        No se pudo realizar la operación
                    </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Ciudades</h2>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Ciudad</th>
                                <th>Departamento</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($mysqli, "SELECT c.cod_ciudad, c.descrip_ciudad, d.dep_descripcion 
                                                            FROM ciudad c 
                                                            JOIN departamento d ON c.id_departamento = d.id_departamento")
                                     or die('Error: ' . mysqli_error($mysqli));

                            if (mysqli_num_rows($query) == 0) {
                                echo "<tr><td colspan='4' class='text-center'>No hay datos que mostrar</td></tr>";
                            } else {
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $cod = $data['cod_ciudad'];
                                    $ciudad = $data['descrip_ciudad'];
                                    $dep = $data['dep_descripcion'];

                                    echo "<tr>
                                            <td class='text-center'>$cod</td>
                                            <td class='text-center'>$ciudad</td>
                                            <td class='text-center'>$dep</td>
                                            <td class='text-center' width='120'>
                                                <a data-toggle='tooltip' title='Editar' class='btn btn-primary btn-sm' href='?module=form_ciudad&form=edit&id=$cod'>
                                                    <i class='glyphicon glyphicon-edit' style='color:#fff'></i>
                                                </a>
                                                <a data-toggle='tooltip' title='Eliminar' class='btn btn-danger btn-sm' href='modules/ciudad/proses.php?act=delete&cod_ciudad=$cod' onclick=\"return confirm('¿Eliminar $ciudad?')\">
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
