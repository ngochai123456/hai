<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('images/user/' . Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name}}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- sản phẩm -->
            <li class="nav-item">
                <a href="#" class="nav-link">

                    <i class="nav-icon  fab fa-product-hunt"></i>
                    <p>
                        Sản phẩm
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh mục</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('brand.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thương hiệu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sản phẩm</p>
                        </a>
                    </li>


                </ul>
            </li>
            {{-- contact --}}
            <li class="nav-item">
                <a href="{{ route('contact.index') }}" class="nav-link">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>
                        Liên hệ
                    </p>
                </a>
            </li>
            {{-- order --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-file-lines"></i>
                    <p>
                        Hóa đơn
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('order.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Đặt hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orderdetail.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Chi tiết đặt hàng</p>
                        </a>
                    </li>


                </ul>
            </li>

            {{-- pages --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Pages
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('topic.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Đề tài</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('post.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bài viết</p>
                        </a>
                    </li>
                   

                </ul>
            </li>
            {{-- slider --}}
            <li class="nav-item">
                <a href="{{ route('slider.index') }}" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Slider
                    </p>
                </a>
            </li>
            {{-- slider --}}
            <li class="nav-item">
                <a href="{{ route('menu.index') }}" class="nav-link">
                    <i class="nav-icon fa-solid fa-bars"></i>
                    <p>
                        Menu
                    </p>
                </a>
</li>

            {{-- user --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-users"></i>
                    <p>
                        Thành viên
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thành viên</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm thành viên</p>
                        </a>
                    </li>
                
                </ul>
            </li>
    
          
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>