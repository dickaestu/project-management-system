<div class="main-sidebar sidebar-style-2">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="index.html">
                Admin
              </a>
            </div>
            <ul class="sidebar-menu">
              <li class="menu-header">Main</li>
              <li class="dropdown active">
                <a href="#" class="nav-link"
                  ><i data-feather="monitor"></i><span>Dashboard</span></a
                >
              </li>
              {{-- <li class="dropdown {{(request()->is('my-project*')) ? 'active' : ""}}">
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
                </ul>
              </li> --}}
            </ul>
          </aside>
        </div>