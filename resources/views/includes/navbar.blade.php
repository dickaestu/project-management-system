<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
          <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li>
                <a
                  href="#"
                  data-toggle="sidebar"
                  class="nav-link nav-link-lg collapse-btn"
                >
                  <i data-feather="align-justify"></i
                ></a>
              </li>
          
              <li>
                <form class="form-inline mr-auto">
                  <div class="search-element">
                    <input
                      class="form-control"
                      type="search"
                      placeholder="Search"
                      aria-label="Search"
                      data-width="200"
                    />
                    <button class="btn" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </form>
              </li>
            </ul>
          </div>
          <ul class="navbar-nav navbar-right">
            {{-- Messages --}}
            {{-- <li class="dropdown dropdown-list-toggle">
              <a
                href="#"
                data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle"
                ><i data-feather="mail"></i>
                <span class="badge headerBadge1"> 1 </span>
              </a>
              <div
                class="dropdown-menu dropdown-list dropdown-menu-right pullDown"
              >
                <div class="dropdown-header">
                  Messages
                  <div class="float-right">
                    <a href="#">Mark All As Read</a>
                  </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                  <a href="#" class="dropdown-item">
                    <span class="dropdown-item-avatar text-white">
                      <img
                        alt="image"
                        src="{{ asset('assets/img/users/user-8.png') }}"
                        class="rounded-circle"
                      />
                    </span>
                    <span class="dropdown-item-desc">
                      <span class="message-user">Novian Ardiansyah</span>
                      <span class="time messege-text"
                        >Woi nasrul</span
                      >
                      <span class="time">2 Min Ago</span>
                    </span>
                  </a>
                </div>
                <div class="dropdown-footer text-center">
                  <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </li> --}}
            {{-- Notifications --}}
            {{-- <li class="dropdown dropdown-list-toggle">
              <a
                href="#"
                data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg"
                ><i data-feather="bell" class="bell"></i>
              </a>
              <div
                class="dropdown-menu dropdown-list dropdown-menu-right pullDown"
              >
                <div class="dropdown-header">
                  Notifications
                  <div class="float-right">
                    <a href="#">Mark All As Read</a>
                  </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                 
                  <a href="#" class="dropdown-item">
                    <span class="dropdown-item-icon bg-success text-white">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="dropdown-item-desc">
                      <b>Dicka Estu Saputra</b> has moved task <b>Fix bug header</b> to
                      <b>Done</b> <span class="time">12 Hours Ago</span>
                    </span>
                  </a>
                </div>
                <div class="dropdown-footer text-center">
                  <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </li> --}}
            {{-- Profile --}}
            <li class="dropdown">
              <a
                href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"
              >
                <img
                  alt="image"
                  src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                  class="user-img-radious-style" />
                <span class="d-sm-none d-lg-inline-block"></span
              ></a>
              <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello {{ Auth::user()->name }}</div>
                <a href="#" class="dropdown-item has-icon">
                  <i class="far fa-user"></i> Profile
                </a>
                <a href="#" class="dropdown-item has-icon">
                  <i class="fas fa-cog"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
              <form action="{{ route('logout') }}" method="POST" >
              @csrf
              <button
                  type="submit"
                  class="dropdown-item has-icon text-danger"
                >
                  <i class="fas fa-sign-out-alt my-2"></i>
                  Logout
                </button>
            </form>
              </div>
            </li>
          </ul>
        </nav>