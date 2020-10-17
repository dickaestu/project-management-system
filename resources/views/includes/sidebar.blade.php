<div class="main-sidebar sidebar-style-2">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="index.html">
                <img
                  alt="Logo"
                  src=""
                  class="header-logo"
                />
                <span class="logo-name">...</span>
              </a>
            </div>
            <ul class="sidebar-menu">
              <li class="menu-header">Main</li>
              <li class="dropdown {{(request()->is('/*')) ? 'active' : ""}}">
                <a href="{{ route('dashboard') }}" class="nav-link"
                  ><i class="material-icons">dashboard</i><span>Dashboard</span></a
                >
              </li>
              <li class="dropdown {{(request()->is('my-project*')) ? 'active' : ""}}">
                <a href="#" class="menu-toggle nav-link has-dropdown"
                  ><i data-feather="briefcase"></i><span>Projects</span></a
                >
                <ul class="dropdown-menu">
                  <li class="{{(request()->is('my-project')) ? 'active' : ""}}">
                    <a class="nav-link" href="{{ route('my-project.index') }}">My Project</a>
                  </li>
                  <li class="{{(request()->is('my-project/create')) ? 'active' : ""}}">
                    <a class="nav-link" href="{{ route('my-project.create') }}"
                      >Create Project</a
                    >
                  </li>
                  <li class="{{(request()->is('my-project/archived-project')) ? 'active' : ""}}">
                    <a class="nav-link" href="{{ route('archived-project') }}"
                      >Archived Project</a
                    >
                  </li>
                </ul>
              </li>
            </ul>
          </aside>
        </div>