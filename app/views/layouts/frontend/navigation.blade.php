<nav id="mainnav" class="navbar navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Digital Handyman</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Dropdown header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <li><a href="#">Prices</a></li>
        <li><a href="#">Book Now</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">News</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">About <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('home') }}/about-us">About Us</a></li>
            <li><a href="{{ route('home') }}/about-us/meet-the-team">Meet The Team</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Dropdown header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('home') }}/contact-us">Contact</a></li>
            <li><a href="#">Facebook</a></li>
            <li><a href="#">YouTube</a></li>
            <li><a href="#">Locations</a></li>
            <li class="divider"></li>
            <?php

              $admin = Sentry::findGroupByName('Administrators');
              $customer = Sentry::findGroupByName('Customers');
              $user = Sentry::getUser();

              if(Sentry::check()) {
                if($user->inGroup($admin)) {
                  echo '<li>'. link_to_route('dashboard', 'Dashboard') .'</li>';
                  echo '<li>'. link_to_route('session.logout', 'Logout') .'</li>';
                } elseif($user->inGroup($customer)) {
                  echo '<li>'. link_to_route('session.logout', 'Logout') .'</li>';
                }
              }
              else {
                echo '<li>'. link_to_route('session.login', 'Login') .'</li>';
              }

          ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>