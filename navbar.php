<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light sticky-top" style="box-shadow: 0 4px 4px 0.1px grey;">
  <!-- Left navbar links -->
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <span class="nav-text">
    <form action="searchresult.php" method="post" id="searchForm" enctype="multipart/form-data">
      <input class="form-control" type="search" placeholder="Search" name="search" style="width: 280px;margin-top: 10px;">
    </form>
  </span>
  &nbsp;&nbsp;
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="admin/images/savage_logo.png" alt="Savage Anime Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Savage Anime</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <?php if(isset($_SESSION['userId'])) : ?>
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $_SESSION['photo'] ?? "" ?>" class="img-circle elevation-2" alt="User Image" style="height:100% !important; background-position: center; background-size: auto;">
      </div>
      <div class="info">
        <a href="setting.php" class="d-block"><?php echo $_SESSION['username'] ?></a>
      </div>
    </div>
    <?php endif; ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header" style="padding-left: 20px;">MENUS</li>
        <li class="nav-item">
          <a href="index.php" class="nav-link">
            <i class="nav-icon fa fa-home fa-fw"></i>
            <p class="text">Home</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="animelists.php" class="nav-link">
            <i class="nav-icon fa fa-list fa-fw"></i>
            <p class="text">Anime Lists</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="animeseries.php" class="nav-link">
            <i class="nav-icon fa fa-paw fa-fw"></i>
            <p class="text">Anime Series</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="animemovies.php" class="nav-link">
            <i class="nav-icon fa fa-film fa-fw"></i>
            <p class="text">Anime Movies</p>
          </a>
        </li>
        <?php if(isset($_SESSION['userId'])) : ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user fa-fw"></i>
            <p>
              Profile
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="watchhistory.php" class="nav-link">
                <i class="fa fa-history nav-icon"></i>
                <p>Watch History</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="favourites.php" class="nav-link">
                <i class="fa fa-star nav-icon"></i>
                <p>Favourites</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="towatchlist.php" class="nav-link">
                <i class="fa fa-eye nav-icon"></i>
                <p>To Watch List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="setting.php" class="nav-link">
                <i class="nav-icon fa fa-cog fa-fw"></i>
                <p class="text">Setting</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fa fa-sign-out text-danger"></i>
            <p class="text">Log Out</p>
          </a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <?php $redirect_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
          <a href="login.php?url=<?php echo $redirect_url?>" class="nav-link">
            <i class="nav-icon fa fa-sign-in text-warning"></i>
            <p class="text">Log In</p>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>