<div class="navbar navbar-inverse">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Dashboard</a>
  </div>
  <div class="navbar-collapse collapse navbar-inverse-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Overview</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('dashboard.pages.index') }}">View Pages</a></li>
          <li><a href="{{ route('dashboard.pages.create') }}">Create New Page</a></li>
          <li><a href="{{ route('dashboard.pages.deleted') }}">Deleted Pages</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Posts <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('dashboard.posts.index') }}">View Posts</a></li>
          <li><a href="{{ route('dashboard.posts.create') }}">Create New Post</a></li>
          <li><a href="{{ route('dashboard.posts.deleted') }}">Deleted Posts</a></li>
        </ul>
      </li>
      <li><a href="{{ route('dashboard.users.index') }}">Users</a></li>
      <li><a href="#">Customers</a></li>
      <li><a href="#">Bookings</a></li>
      <li><a href="#">Reports</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{ URL('/') }}">View Site</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Profile</a></li>
          <li><a href="#">Settings</a></li>
          <li class="divider"></li>
          <li>{{ link_to_route('session.logout', 'Logout') }}</li>
        </ul>
      </li>
    </ul>
  </div>
</div>