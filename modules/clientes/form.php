<?php
if ($_GET['form'] == 'add') {
    // Obtener el último código y sumar 1
    $query_id = mysqli_query($mysqli, "SELECT MAX(id_cliente) AS ultimo FROM clientes");
    $data_id = mysqli_fetch_assoc($query_id);
    $nuevo_id = ($data_id['ultimo'] === null) ? 1 : $data_id['ultimo'] + 1;
?>
<section class="content-header">
    <h1><i class="fa fa-plus icon-title"></i> Agregar Cliente</h1>
</section>

<section class="content">
    <form action="modules/clientes/proses.php?act=insert" method="POST">
        <div class="form-group">
            <label>Código</label>
            <input type="number" name="id_cliente" class="form-control" value="<?php echo $nuevo_id; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="cli_nombre" class="form-control" placeholder="Ingrese el nombre" required>
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="cli_apellido" class="form-control" placeholder="Ingrese el apellido" required>
        </div>

        <div class="form-group">
            <label>RUC / CI</label>
            <input type="text" name="ci_ruc" class="form-control" placeholder="Ingrese RUC o CI" required>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="cli_telefono" class="form-control" placeholder="Ej: 0981 123 456">
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="cli_direccion" class="form-control" placeholder="Ingrese dirección completa">
        </div>

        <div class="form-group">
            <label>Ciudad</label>
            <select name="cod_ciudad" class="form-control" required>
                <option value="">-- Seleccionar --</option>
                <?php
                $ciudades = mysqli_query($mysqli, "SELECT * FROM ciudad ORDER BY descrip_ciudad ASC");
                while ($ciu = mysqli_fetch_assoc($ciudades)) {
                    echo "<option value='{$ciu['cod_ciudad']}'>{$ciu['descrip_ciudad']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="Guardar" class="btn btn-primary">Guardar</button>
        <a href="?module=clientes" class="btn btn-default">Cancelar</a>
    </form>
</section>

<?php
// ======== EDITAR CLIENTE ========
} elseif ($_GET['form'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($mysqli, "SELECT * FROM clientes WHERE id_cliente = '$id'");
    $data = mysqli_fetch_assoc($query);
?>
<section class="content-header">
    <h1><i class="fa fa-edit icon-title"></i> Editar Cliente</h1>
</section>

<section class="content">
    <form action="modules/clientes/proses.php?act=update" method="POST">
        <div class="form-group">
            <label>Código</label>
            <input type="number" name="id_cliente" class="form-control" value="<?php echo $data['id_cliente']; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="cli_nombre" class="form-control" value="<?php echo $data['cli_nombre']; ?>" required>
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="cli_apellido" class="form-control" value="<?php echo $data['cli_apellido']; ?>" required>
        </div>

        <div class="form-group">
            <label>RUC / CI</label>
            <input type="text" name="ci_ruc" class="form-control" value="<?php echo $data['ci_ruc']; ?>" required>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="cli_telefono" class="form-control" value="<?php echo $data['cli_telefono']; ?>">
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="cli_direccion" class="form-control" value="<?php echo $data['cli_direccion']; ?>">
        </div>

        <div class="form-group">
            <label>Ciudad</label>
            <select name="cod_ciudad" class="form-control" required>
                <?php
                $ciudades = mysqli_query($mysqli, "SELECT * FROM ciudad ORDER BY descrip_ciudad ASC");
                while ($ciu = mysqli_fetch_assoc($ciudades)) {
                    $selected = ($ciu['cod_ciudad'] == $data['cod_ciudad']) ? 'selected' : '';
                    echo "<option value='{$ciu['cod_ciudad']}' $selected>{$ciu['descrip_ciudad']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="Guardar" class="btn btn-primary">Actualizar</button>
        <a href="?module=clientes" class="btn btn-default">Cancelar</a>
    </form>
</section>
<?php } ?>
