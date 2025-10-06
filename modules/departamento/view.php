<section class="content-header">
<ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Departamento</li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder-open icon-title"></i>Datos de Departamentos
        <a class="btn btn-primary btn-social pull-right" href="?module=form_departamento&form=add" title="Agregar" data-toggle="tooltip">
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
                        <h4><i class='icon fa fa-check-circle'></i> Error!</h4>
                        No se pudo realizar la operación
                    </div>";
            }
            ?>
            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de departamentos</h2>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                       <tbody>
                            <?php
                            $query = mysqli_query($mysqli, "SELECT * FROM departamento") or die ('Error: '.mysqli_error($mysqli));

                            if (mysqli_num_rows($query) == 0) {
                                echo "<tr><td colspan='3' class='text-center'>No hay datos que mostrar</td></tr>";
                            } else {
                                while($data = mysqli_fetch_assoc($query)){
                                    $id = $data['id_departamento'];
                                    $desc = $data['dep_descripcion'];

                                    echo "<tr>
                                            <td class='text-center'>$id</td>
                                            <td class='text-center'>$desc</td>
                                            <td class='text-center' width='80'>
                                                <div>
                                                    <a data-toggle='tooltip' title='Modificar' class='btn btn-primary btn-sm' href='?module=form_departamento&form=edit&id=$id'>
                                                        <i class='glyphicon glyphicon-edit' style='color:#fff'></i>
                                                    </a>
                                                    <a data-toggle='tooltip' title='Eliminar' class='btn btn-danger btn-sm' href='modules/departamento/proses.php?act=delete&id_departamento=$id' onclick=\"return confirm('¿Estás seguro/a de eliminar $desc?')\">
                                                        <i class='glyphicon glyphicon-trash'></i>
                                                    </a>
                                                </div>
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