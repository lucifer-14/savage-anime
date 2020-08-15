<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top" style="box-shadow: 0 4px 4px 0.1px grey;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="images/savage_logo.png" alt="Savage Anime Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Savage Anime</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $_SESSION['photo'] ?? "" ?>" class="img-circle elevation-2" alt="User Image" style="width: 34px !important">
      </div>
      <div class="info">
        <a href="adminsetting.php" class="d-block"><?php echo $_SESSION['username'] ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header" style="padding-left: 20px;">MENUS</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-home fa-fw"></i>
            <p>
              Setup
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="animes.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Animes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="episodes.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Episodes</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="animesmanagement.php" class="nav-link">
            <i class="nav-icon fa fa-paw fa-fw"></i>
            <p class="text">Animes Management</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="usersmanagement.php" class="nav-link">
            <i class="nav-icon fa fa-user fa-fw"></i>
            <p class="text">Users Management</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="adminsetting.php" class="nav-link">
            <i class="nav-icon fa fa-cog fa-fw"></i>
            <p class="text">Setting</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fa fa-sign-out text-danger"></i>
            <p class="text">Log Out</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
