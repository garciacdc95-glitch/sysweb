<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['permisos_acceso'] == 'Super Admin') { ?>
    <ul class="sidebar-menu">
        <li class="header">Menú</li>

        <?php 
        $active_home = ($_GET["module"] == "start") ? "active" : "";
        ?>
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="fa fa-home"></i> Inicio </a> 
        </li>

        <!-- Referenciales Generales -->
        <li class="treeview">
            <a href="javascript:void(0);">
                <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="?module=departamento"><i class="fa fa-circle-o"></i>Departamento</a></li>
                <li><a href="?module=ciudad"><i class="fa fa-circle-o"></i>Ciudad</a></li>
            </ul>
        </li>

        <!-- Referenciales de Compras -->
        <li class="treeview">
            <a href="javascript:void(0);">
                <i class="fa fa-file-text"></i><span>Referenciales de Compras</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Depósito</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Proveedor</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Producto</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Unidad de medida</a></li>
            </ul>
        </li>

        <!-- Referenciales de Ventas -->
        <li class="treeview">
            <a href="javascript:void(0);">
                <i class="fa fa-certificate"></i><span>Referenciales de Ventas</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Clientes</a></li>
            </ul>
        </li>

        <!-- Administrar usuarios -->
        <?php 
        $active_user = ($_GET['module'] == "user" || $_GET['module'] == "form_user") ? "active" : "";
        ?>
        <li class="<?php echo $active_user; ?>">
            <a href="?module=user"><i class="fa fa-user"></i>Administrar usuarios</a>
        </li>

        <!-- Cambiar contraseña -->
        <?php 
        $active_password = ($_GET['module'] == "password") ? "active" : "";
        ?>
        <li class="<?php echo $active_password; ?>">
            <a href="?module=password"><i class="fa fa-user"></i>Cambiar contraseña</a>
        </li>
    </ul>

<?php } elseif ($_SESSION['permisos_acceso'] == 'Compras') { ?>
    <ul class="sidebar-menu">
        <li class="header">Menú</li>

        <?php 
        $active_home = ($_GET["module"] == "start") ? "active" : "";
        ?>
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="fa fa-home"></i> Inicio </a> 
        </li>

        <!-- Referenciales Generales -->
        <li class="treeview">
            <a href="javascript:void(0);">
                <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="?module=departamento"><i class="fa fa-circle-o"></i>Departamento</a></li>
                <li><a href="?module=ciudad"><i class="fa fa-circle-o"></i>Ciudad</a></li>
            </ul>
        </li>

        <!-- Referenciales de Compras -->
        <li class="treeview">
            <a href="javascript:void(0);">
                <i class="fa fa-file-text"></i><span>Referenciales de Compras</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Depósito</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Proveedor</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Producto</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Unidad de medida</a></li>
            </ul>
        </li>

        <!-- Cambiar contraseña -->
        <?php 
        $active_password = ($_GET['module'] == "password") ? "active" : "";
        ?>
        <li class="<?php echo $active_password; ?>">
            <a href="?module=password"><i class="fa fa-user"></i>Cambiar contraseña</a>
        </li>
    </ul>
<?php } ?>
