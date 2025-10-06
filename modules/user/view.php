<section class="content-header">
  <h1>
    <i class="fa fa-user icon-title"></i> Gestión de Usuarios

    <a class="btn btn-primary btn-social pull-right" href="?module=form_user&form=add" title="Agregar" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Agregar
    </a>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  
    if (empty($_GET['alert'])) {
      echo "";
    } elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check-circle'></i> Éxito!</h4>
              Los nuevos datos de usuario se han registrado correctamente.
            </div>";
    } elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check-circle'></i> Éxito!</h4>
              Los datos de usuario han sido modificados satisfactoriamente.
            </div>";
    } elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check-circle'></i> Éxito!</h4>
              El usuario ha sido activado correctamente.
            </div>";
    } elseif ($_GET['alert'] == 4) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check-circle'></i> Éxito!</h4>
              El usuario se bloqueó con éxito.
            </div>";
    } elseif ($_GET['alert'] == 5) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
              Asegúrese de que el archivo que se sube es correcto.
            </div>";
    } elseif ($_GET['alert'] == 6) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
              Asegúrese de que la imagen no sea mayor a 1 MB.
            </div>";
    } elseif ($_GET['alert'] == 7) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
              Asegúrese de que el tipo de archivo subido sea *.JPG, *.JPEG, *.PNG.
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Foto</th>
                <th class="center">Nombre de usuario</th>
                <th class="center">Nombre</th>
                <th class="center">Permisos de acceso</th>
                <th class="center">Status</th>
                <th class="center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php  
              $nro = 1;
              $query = mysqli_query($mysqli, "SELECT * FROM usuarios ORDER BY id_user DESC") or die('error: '.mysqli_error($mysqli));

              while ($data = mysqli_fetch_assoc($query)) {
              ?>
                <tr>
                  <td class='center'><?php echo $nro; ?></td>
                  <td class='center'>
                    <img class='img-user' src='images/user/<?php echo ($data['foto'] ?: 'user-default.png'); ?>' width='45'>
                  </td>
                  <td><?php echo $data['username']; ?></td>
                  <td><?php echo $data['name_user']; ?></td>
                  <td><?php echo $data['permisos_acceso']; ?></td>
                  <td class='center'><?php echo $data['status']; ?></td>
                  <td class='center' width='100'>
                    <div>
                      <?php if ($data['status'] == 'activo') { ?>
                        <a data-toggle="tooltip" title="Bloquear usuario" class="btn btn-warning btn-sm"
                           href="modules/user/proses.php?act=off&id=<?php echo $data['id_user']; ?>"
                           onclick="return confirm('¿Está seguro que desea bloquear este usuario?');">
                          <i class="glyphicon glyphicon-off" style="color:#fff"></i>
                        </a>
                      <?php } else { ?>
                        <a data-toggle="tooltip" title="Activar usuario" class="btn btn-success btn-sm"
                           href="modules/user/proses.php?act=on&id=<?php echo $data['id_user']; ?>">
                          <i class="glyphicon glyphicon-ok" style="color:#fff"></i>
                        </a>
                      <?php } ?>
                      <a data-toggle="tooltip" title="Modificar" class="btn btn-primary btn-sm"
                         href="?module=form_user&form=edit&id=<?php echo $data['id_user']; ?>">
                        <i class="glyphicon glyphicon-edit" style="color:#fff"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php
                $nro++;
              }
              ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
