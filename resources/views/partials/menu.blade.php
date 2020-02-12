<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">ICT E-STORAGE FILES</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>Dashboard</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('memo.index') }}" class="nav-link">
                        <p>
                            <i class="fas fa-newspaper"></i>

                            </i>
                            <span>Memo</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('request.index') }}" class="nav-link">
                        <p>
                            <i class="fab fa-servicestack"></i>

                            </i>
                            <span>Request</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('purchase_order.index') }}" class="nav-link">
                        <p>
                            <i class="fa fa-shopping-cart"></i>

                            </i>
                            <span>Purchase Order</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('requisition.index') }}" class="nav-link">
                        <p>
                            <i class="fab fa-servicestack"></i>

                            </i>
                            <span>Requisition</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('bill.index') }}" class="nav-link">
                        <p>
                            <i class="fas fa-file-invoice-dollar"></i>

                            </i>
                            <span>Bills</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('other.index') }}" class="nav-link">
                        <p>
                            <i class="fas fa-file-alt"></i>

                            </i>
                            <span>Other Files</span>
                        </p>
                    </a>
                </li>

                @if(Auth::user()->role === 'Admin')
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <p>
                            <i class="fas fa-user"></i>

                            </i>
                            <span>User Management</span>
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('user.edit', Auth::user()->id) }}" class="nav-link">
                        <p>
                            <i class="fas fa-cog"></i>

                            </i>
                            <span>Account Setting</span>
                        </p>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>Logout</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>