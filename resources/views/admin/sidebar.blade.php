<div class="sidebar shadow">
    <div class="section-top">
        <!-- Logo del Sidebar -->
        <div class="logo">
            <img src="{{ url('/static/img/logoMars.jpg') }}" class="img-fluid">
        </div>
        
        <!-- Datos del usuario logueado en el Sidebar y boton de Logout -->
        <div class="user">
            <span class="subtitle">
                Hola:
            </span>
            <div class="name">
                {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                <a href="{{ url('/logout') }}" data-toggler="tooltip" data-toggle="tooltip" title="Salir">
                    <i class="fas fa-sign-out-alt"></i> 
                </a>
            </div>
            <div class="email">
                {{ Auth::user()->email }}
            </div>
        </div>
    </div>

    <!-- Enlaces del Sidebar -->
    <div class="main">
        <ul>
            <li>
                <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fas fa-home"></i>Dashboard</a>
            </li>
            <li>
                <a href="{{ url('/admin/products') }}" class="lk-products lk-product_add lk-product_edit lk-product_gallery_add"><i class="fas fa-boxes"></i>Productos</a>
            </li>
            <li>
                <a href="{{ url('/admin/categories/0') }}" class="lk-categories lk-category_add lk-category_edit lk-category_delete"><i class="fas fa-folder-open"></i>Categorias</a>
            </li>
            <li>
                <a href="{{ url('/admin/users') }}" class="lk-user_list lk-user_edit"><i class="fas fa-user-friends"></i>Usuarios</a>
            </li>
        </ul>
    </div>

</div>