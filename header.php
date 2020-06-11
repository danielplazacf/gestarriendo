<!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">GEST</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">GEST</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="resources/dist/img/icon-user.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php nameUser($_SESSION['user_system']);?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="resources/dist/img/icon-user.png" class="img-circle" alt="User Image">
                <p>
                  <?php nameUser($_SESSION['user_system']);?>
                  <small><?php echo $_SESSION['user_system'];?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn bg-olive"><i class="fa fa-user"></i> Perfil</a>
                </div> -->
                <div class="pull-right">
                  <a href="model/cerrarSession.php" class="btn btn-danger"><i class="fa fa-sign-out"></i> Salir</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>