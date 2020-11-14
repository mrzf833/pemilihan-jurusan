<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</div>
            <div class="email">{{ auth()->user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <a href="javascript:void(0);" onclick="$(this).closest('form').submit()"><i class="material-icons">input</i>Sign Out</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.kelas.index') || request()->routeIs('admin.jurusan.index') || request()->routeIs('admin.pembagian_jurusan.index') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Jurusan</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('admin.kelas.index') ? 'active' : '' }}">
                        <a href="{{ route(('admin.kelas.index')) }}">Kelas</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.jurusan.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.jurusan.index') }}">Jurusan</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.pembagian_jurusan.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.pembagian_jurusan.index') }}">Pembagian Jurusan</a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->routeIs('admin.user.index') || request()->routeIs('admin.user.create') || request()->routeIs('admin.user.show') ? 'active' : '' }}">
                <a href="{{ route('admin.user.index') }}">
                    <i class="material-icons">account_box</i>
                    <span>User</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->