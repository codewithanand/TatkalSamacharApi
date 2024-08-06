<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item {{ Request::is('admin/navbars') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/navbars') }}">
            <i class="fas fa-bars"></i>
            <span>Navbar</span></a>
    </li>
    <li class="nav-item {{ Request::is('admin/live-tv') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/live-tv') }}">
            <i class="fas fa-satellite-dish"></i>
            <span>Live TV</span></a>
    </li>
    <li class="nav-item {{ Request::is('admin/breaking-news') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/breaking-news') }}">
            <i class="fas fa-video"></i>
            <span>Breaking News</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li
        class="nav-item {{ Request::is('admin/categories/create') || Request::is('admin/categories') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('admin/categories/create') || Request::is('admin/categories') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseCategory"
            aria-expanded="{{ Request::is('admin/categories/create') || Request::is('admin/categories') ? true : false }}"
            aria-controls="collapseCategory">
            <i class="fas fa-layer-group"></i>
            <span>Category</span>
        </a>
        <div id="collapseCategory"
            class="collapse {{ Request::is('admin/categories/create') || Request::is('admin/categories') ? 'show' : '' }}"
            aria-labelledby="headingFeatured" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/categories/create') ? 'active' : '' }}"
                    href="{{ url('/admin/categories/create') }}">Add Category</a>
                <a class="collapse-item {{ Request::is('admin/categories') ? 'active' : '' }}"
                    href="{{ url('/admin/categories') }}">Categories</a>
            </div>
        </div>
    </li>

    <li
        class="nav-item {{ Request::is('admin/sub-categories/create') || Request::is('admin/sub-categories') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('admin/sub-categories/create') || Request::is('admin/sub-categories') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseSubCategory"
            aria-expanded="{{ Request::is('admin/sub-categories/create') || Request::is('admin/sub-categories') ? true : false }}"
            aria-controls="collapseSubCategory">
            <i class="fas fa-layer-group"></i>
            <span>SubCategory</span>
        </a>
        <div id="collapseSubCategory"
            class="collapse {{ Request::is('admin/sub-categories/create') || Request::is('admin/sub-categories') ? 'show' : '' }}"
            aria-labelledby="headingFeatured" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/sub-categories/create') ? 'active' : '' }}"
                    href="{{ url('/admin/sub-categories/create') }}">Add SubCategory</a>
                <a class="collapse-item {{ Request::is('admin/sub-categories') ? 'active' : '' }}"
                    href="{{ url('/admin/sub-categories') }}">SubCategories</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Request::is('admin/tags/create') || Request::is('admin/tags') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('admin/tags/create') || Request::is('admin/tags') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseTag"
            aria-expanded="{{ Request::is('admin/tags/create') || Request::is('admin/tags') ? true : false }}"
            aria-controls="collapseTag">
            <i class="fas fa-tag"></i>
            <span>Tag</span>
        </a>
        <div id="collapseTag"
            class="collapse {{ Request::is('admin/tags/create') || Request::is('admin/tags') ? 'show' : '' }}"
            aria-labelledby="headingFeatured" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/tags/create') ? 'active' : '' }}"
                    href="{{ url('/admin/tags/create') }}">Add Tag</a>
                <a class="collapse-item {{ Request::is('admin/tags') ? 'active' : '' }}"
                    href="{{ url('/admin/tags') }}">Tags</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Request::is('admin/articles/create') || Request::is('admin/articles') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('admin/articles/create') || Request::is('admin/articles') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseArticle"
            aria-expanded="{{ Request::is('admin/articles/create') || Request::is('admin/articles') ? true : false }}"
            aria-controls="collapseArticle">
            <i class="fas fa-newspaper"></i>
            <span>Article</span>
        </a>
        <div id="collapseArticle"
            class="collapse {{ Request::is('admin/articles/create') || Request::is('admin/articles') ? 'show' : '' }}"
            aria-labelledby="headingFeatured" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/articles/create') ? 'active' : '' }}"
                    href="{{ url('/admin/articles/create') }}">Add Article</a>
                <a class="collapse-item {{ Request::is('admin/articles') ? 'active' : '' }}"
                    href="{{ url('/admin/articles') }}">Articles</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Request::is('admin/users/create') || Request::is('admin/users') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('admin/users/create') || Request::is('admin/users') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseUser"
            aria-expanded="{{ Request::is('admin/users/create') || Request::is('admin/users') ? true : false }}"
            aria-controls="collapseUser">
            <i class="fas fa-users-cog"></i>
            <span>User</span>
        </a>
        <div id="collapseUser"
            class="collapse {{ Request::is('admin/users/create') || Request::is('admin/users') ? 'show' : '' }}"
            aria-labelledby="headingFeatured" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/users/create') ? 'active' : '' }}"
                    href="{{ url('/admin/users/create') }}">Add User</a>
                <a class="collapse-item {{ Request::is('admin/users') ? 'active' : '' }}"
                    href="{{ url('/admin/users') }}">Users</a>
            </div>
        </div>
    </li>





    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
