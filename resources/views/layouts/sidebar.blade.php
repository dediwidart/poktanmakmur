<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
            <img src="{{url('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{\App\Models\Config::getApplicationName()}}</span>
            </a>
            <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                    <a href="{{url('/dashboard')}}" class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>
                        Pesanan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/order/pending')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pesanan Pending</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/order/sended')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pesanan Dikirim</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/order/done')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pesanan Selesai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/order/cancel')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pesanan Dibatalkan</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Produk
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/product')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Produk</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-calendar"></i>
                    <p>
                        Agenda
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/agenda')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Agenda</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-newspaper"></i>
                    <p>
                        Materi
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/material')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Materi</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Kategori
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/category')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Kategori</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-id-card"></i>
                    <p>
                        Pengguna
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/user')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Pengguna</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-image"></i>
                    <p>
                        Banner
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/banner')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Banner</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-question-circle"></i>
                    <p>
                        Faq
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/faq')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Faq</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-header">Lainnya</li>
                    <li class="nav-item">
                        <a href="{{url('/config')}}" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Pengaturan
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                        </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>