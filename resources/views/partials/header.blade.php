<nav class="navbar navbar-expand-lg bg-color-custom">
  <div class="container">
    <a class="brand" href="{{ home_url('/') }}">
      <div class="brand-logo">
          <img src="http://localhost/nixon/wp-content/uploads/2020/02/logo.png" class="img-fluid logoHeader">
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
    </button>
    <div id="navbarNavDropdown" class="collapse navbar-collapse justify-content-end">
    <?php if ($_SESSION['loggedIn'] == 1) { ?>
      @if (has_nav_menu('my-custom-menu'))
        {!! wp_nav_menu(['theme_location' => 'my-custom-menu', 'menu_class' => 'nav']) !!}
      @endif
    <?php } else { ?>
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    <?php
    } ?>
      <ul id="menu-menu-2" class="nav">
        <!-- <li id="" class="loginheaderButton"><a href="#">Login</a></li> -->
      </ul>
    </div>
  </div>
</nav>
