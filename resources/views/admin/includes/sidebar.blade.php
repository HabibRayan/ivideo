<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <!--left-fixed -navigation-->
    <aside class="sidebar-left">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header" style="height: 100px; width: 100%;">
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}"><img src="{{ asset('admin/images/logo.png') }}" width="80"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="{{url('/admin/dashboard')}}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('admin.category') }}">
                            <i class="fa fa-desktop"></i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('admin.subcategory') }}">
                            <i class="fa fa-laptop"></i>
                            <span>Sub Category</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('admin.post') }}">
                            <i class="fa fa-laptop"></i>
                            <span>Post</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </aside>
</div>
