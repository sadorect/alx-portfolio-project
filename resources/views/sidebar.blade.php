<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      User<span>Dashboard</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{route('dashboard')}}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Anniversary</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Upcoming Celebrants</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="emails">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('upcoming.birthdays')}}" class="nav-link">Upcoming Birthdays</a>
            </li>
            <li class="nav-item">
              <a href="{{route('upcoming.weddings')}}" class="nav-link">Upcoming Weddings</a>
            </li>
            
          </ul>
        </div>
      </li>
@php
      $url = route('show.record', ['user_id' => Auth::user()->id]);
@endphp
      <li class="nav-item">
        <a href="{{$url}}" class="nav-link">
          <i class="link-icon" data-feather="message-square"></i>
          <span class="link-title">View Records</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('add.record')}}" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Add Record</span>
        </a>
      </li>
     
      
      <li class="nav-item nav-category">Docs</li>
      <li class="nav-item">
        <a href="" target="_blank" class="nav-link">
          <i class="link-icon" data-feather="hash"></i>
          <span class="link-title">Documentation</span>
        </a>
      </li>
    </ul>
  </div>
</nav>