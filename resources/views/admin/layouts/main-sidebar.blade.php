<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">Java</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link "><i
                        class="fas
                fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="">
                <a class="nav-link " href="{{ route('admin.language.index') }}"><i class="fas fa-fire"></i>
                    <span>Languages</span></a>
            </li>
            <li class="">
                <a class="nav-link " href="{{ route('admin.category.index') }}"><i class="fas fa-fire"></i>
                    <span>Categories</span></a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>News</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.news.index') }}">All News</a></li>
                    <li><a class="nav-link" href="">Badge</a></li>
                    <li><a class="nav-link" href="">Breadcrumb</a></li>
                </ul>
            </li>




        </ul>

    </aside>
</div>
