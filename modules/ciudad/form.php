<?php
if ($_GET['form'] == 'add') {
    // Obtener el último código y sumar 1
    $query_id = mysqli_query($mysqli, "SELECT MAX(cod_ciudad) AS ultimo FROM ciudad");
    $data_id = mysqli_fetch_assoc($query_id);
    $nuevo_id = ($data_id['ultimo'] === null) ? 1 : $data_id['ultimo'] + 1;
?>
<section class="content-header">
    <h1><i class="fa fa-plus icon-title"></i>Agregar Ciudad</h1>
</section>

<section class="content">
    <form action="modules/ciudad/proses.php?act=insert" method="POST">
        <div class="form-group">
            <label>Código</label>
            <input type="number" name="cod_ciudad" class="form-control" value="<?php echo $nuevo_id; ?>" required>
        </div>
        <div class="form-group">
            <label>Descripción de la ciudad</label>
            <input type="text" name="descrip_ciudad" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Departamento</label>
            <select name="id_departamento" class="form-control" required>
                <option value="">-- Seleccionar --</option>
                <?php
                $departamentos = mysqli_query($mysqli, "SELECT * FROM departamento");
                while ($dep = mysqli_fetch_assoc($departamentos)) {
                    echo "<option value='{$dep['id_departamento']}'>{$dep['dep_descripcion']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="Guardar" class="btn btn-primary">Guardar</button>
        <a href="?module=ciudad" class="btn btn-default">Cancelar</a>
    </form>
</section>
<?php
} elseif ($_GET['form'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($mysqli, "SELECT * FROM ciudad WHERE cod_ciudad = '$id'");
    $data = mysqli_fetch_assoc($query);
?>
<section class="content-header">
    <h1><i class="fa fa-edit icon-title"></i>Editar Ciudad</h1>
</section>

<section class="content">
    <form action="modules/ciudad/proses.php?act=update" method="POST">
        <div class="form-group">
            <label>Código</label>
            <input type="number" name="cod_ciudad" class="form-control" value="<?php echo $data['cod_ciudad']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Descripción de la ciudad</label>
            <input type="text" name="descrip_ciudad" class="form-control" value="<?php echo $data['descrip_ciudad']; ?>" required>
        </div>
        <div class="form-group">
            <label>Departamento</label>
            <select name="id_departamento" class="form-control" required>
                <?php
                $departamentos = mysqli_query($mysqli, "SELECT * FROM departamento");
                while ($dep = mysqli_fetch_assoc($departamentos)) {
                    $selected = ($dep['id_departamento'] == $data['id_departamento']) ? 'selected' : '';
                    echo "<option value='{$dep['id_departamento']}' $selected>{$dep['dep_descripcion']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="Guardar" class="btn btn-primary">Actualizar</button>
        <a href="?module=ciudad" class="btn btn-default">Cancelar</a>
    </form>
</section>
<?php } ?>
