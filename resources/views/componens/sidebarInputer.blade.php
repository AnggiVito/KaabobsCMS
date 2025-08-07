<!-- <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="{{ url('inputer/dashboard') }}" class=" {{ $title=='Dashboard'?'active':'' }} nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item menu-is-opening {{ $title=='Transaksi'?'menu-open':'' }} ">
            <a href="#" class=" nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                    Transaksi
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ url('inputer/transaksiMasuk') }}" class="{{ $subTitle=='Transaksi Masuk'?'active':'' }} nav-link">
                        <i class="nav-icon fas fa-long-arrow-alt-right"></i>
                        <p>Transaksi Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('inputer/transaksiKeluar') }}" class="{{ $subTitle=='Transaksi Keluar'?'active':'' }} nav-link">
                        <i class="nav-icon fas fa-long-arrow-alt-left"></i>
                        <p>Transaksi Keluar</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item menu-is-opening {{ $title=='Barang'?'menu-open':'' }} ">
            <a href="#" class=" nav-link">
                <i class="nav-icon fa fa-cubes"></i>
                <p>
                    Management Barang
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ url('inputer/barang') }}" class="{{ $subTitle=='Master Barang'?'active':'' }} nav-link">
                        <i class="fa fa-circle nav-icon"></i>
                        <p>Master Data</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('inputer/kategori') }}" class="{{ $subTitle=='Kategori'?'active':'' }} nav-link">
                        <i class="fa fa-circle nav-icon"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('inputer/merek') }}" class="{{ $subTitle=='Merek'?'active':'' }} nav-link">
                        <i class="fa fa-circle nav-icon"></i>
                        <p>Merek</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('inputer/satuan') }}" class="{{ $subTitle=='Satuan'?'active':'' }} nav-link">
                        <i class="fa fa-circle nav-icon"></i>
                        <p>Satuan</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-header">Pengaturan Akun</li>
        <li class="nav-item">

            <a href="" data-toggle="modal" data-target="#modal-sm" class="nav-link">
                <i class="nav-icon fa fa-lock"></i>
                <p>Ubah Password</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Keluar</p>
            </a>
        </li>
    </ul>
</nav> -->