<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="resources/dist/img/icon-user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php nameUser($_SESSION['user_system']);?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ NAVEGACIÓN</li>
        <!-- Optionally, you can add icons to the links -->

        <!-- escritorio -->
        <li class="<?php echo $active_escritorio;?>"><a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Escritorio</span></a></li>
        <!-- inmuebles -->
        <li class="<?php echo $active_inmuebles;?>"><a href="listProperty.php"><i class="fas fa-home"></i> <span>Propiedades</span></a></li>
        <!-- propietarios -->
        <li class="<?php echo $active_owner;?>"><a href="listOwner.php"><i class="fas fa-user"></i> <span>Propietarios</span></a></li>
        <!-- arrendatario -->
        <li class="<?php echo $active_leaser;?>"><a href="listLeaser.php"><i class="fas fa-user-friends"></i> <span>Arrendatarios</span></a></li>
        
        <!-- pagos -->
        <li class="treeview <?php echo $active_pay;?>">
          <a class="active" href="#"><i class="fas fa-funnel-dollar"></i><span> Finanzas y Pagos</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="historialPagos.php"><i class="fas fa-file-invoice-dollar"></i> Historial Pagos</a></li>
            <li><a href="historialCobros.php"><i class="fas fa-file-invoice"></i> Historial Cobros</a></li>
            <li><a href="accountBank.php"><i class="fas fa-university"></i> Cuentas Bancarias</a></li>
            <li><a href="payServices.php"><i class="fas fa-search-dollar"></i> Revisar Servicios</a></li>
          </ul>
        </li>

        <!-- Configuracion -->
        <li class="treeview <?php echo $active_settings;?>">
          <a class="active" href="#"><i class="fas fa-cog"></i><span> Configuracion</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="conceptoGastos.php"><i class="fas fa-file"></i> Conceptos de Gastos</a></li>
          </ul>
        </li>

        <li class="<?php echo $active_opciones;?>">
          <a href="optionSystem.php"><i class="fas fa-cog"></i> <span>Opciones</span></a>
        </li>
        

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->