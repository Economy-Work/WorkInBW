<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 px-3 mb-4 border-bottom" style="background: #FDFF00;">
  <ul class="d-none d-md-block nav col-3 mb-2 mb-md-0">
    <li class="d-inline-block"><a href="/" class="nav-link px-2 link-secondary">Home</a></li>
    <?php if($_SESSION['loggedin']){ ?>
      <li class="d-inline-block"><a href="/dashboard.php" class="nav-link px-2 link-secondary">Dashboard</a></li>
    <?php } ?>
  </ul>  

  <a href="/" class="d-flex col-md-12 justify-content-md-center flex-md-grow-1 align-items-center col-md-auto col-md-3 text-dark text-decoration-none w-auto">
    <img src="/assets/img/logo.svg" height="55" alt="WorkinBW">
  </a>

  <div class="col-3 text-end flex-grow-1 flex-md-grow-0">
    <?php if($_SESSION['loggedin']){ ?>
      <a href="/logout.php" class="btn btn-outline-dark me-2">Logout</a>
    <?php }else{ ?>
      <a href="/login.php" class="btn btn-outline-dark me-2">Login</a>
      <a href="/signup.php" class="btn btn-dark me-2">Sign Up</a>
    <?php } ?>
  </div>
</header>