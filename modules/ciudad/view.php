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
            } elseif ($_GET['alert'] == 5) {
                echo "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-exclamation-triangle'></i> Duplicado!</h4>
                        Ya existe una ciudad con ese <strong>código</strong> o <strong>nombre</strong>. Verificá los datos antes de guardar.
                    </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-bordered table-striped">
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

                            while ($data = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                        <td>{$data['cod_ciudad']}</td>
                                        <td>{$data['descrip_ciudad']}</td>
                                        <td>{$data['dep_descripcion']}</td>
                                        <td>
                                            <a href='?module=form_ciudad&form=edit&id={$data['cod_ciudad']}' class='btn btn-primary btn-sm' title='Editar' data-toggle='tooltip'>
                                                <i class='glyphicon glyphicon-edit' style='color:#fff'></i>
                                            </a>
                                            <a href='modules/ciudad/proses.php?act=delete&cod_ciudad={$data['cod_ciudad']}' class='btn btn-danger btn-sm' title='Eliminar' data-toggle='tooltip' onclick=\"return confirm('¿Eliminar {$data['descrip_ciudad']}?')\">
                                                <i class='glyphicon glyphicon-trash'></i>
                                            </a>
                                        </td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
