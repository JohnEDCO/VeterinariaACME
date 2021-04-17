<?php
session_start();
if($_SESSION['idRol'] == 9){
    include_once 'layouts/header.php';
    ?>
    <title>Adm | Inicio</title>
    <?php
    include_once 'layouts/nav.php';
    ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Busqueda por..."
                           aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="Busqueda por..." aria-label="Search"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->

                <!-- Nav Item - Messages -->

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - Informacion de usuario -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombreUsuario']?></span>
                        <img class="img-profile rounded-circle"
                             src="../Img/admin.png">
                    </a>
                    <!-- Dropdown - Informacion usuario -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Perfil
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Configuraciones
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../Controllers/Logout.php" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Cerrar sesion
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Sobre nosotros</h1>
                </div>

                <div class="row">
                    <!-- Pie Mision -->
                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-8">
                            <!-- Card Header - Dropdown -->

                            <!-- Card Body -->
                            <div class="card-body align-content-end">
                                <hr class="sidebar-divider">
                                <div class="text-center">
                                    <h2>Nuestra mision</h2>

                                    <hr class="sidebar-divider">

                                    <p>
                                        Ofrecer la mejor opción en medicina veterinaria para preservar la salud de nuestras mascotas junto con la tranquilidad de sus familias,
                                        ofreciendo servicios especializados de calidad en el marco de la salud veterinaria, cuidado y bienestar de las mascotas; nuestro valor
                                        agregado es trabajar día a día comprometidos para lograr total cobertura a las necesidades de nuestros pacientes, mediante un equipo profesional
                                        capacitado, la infraestructura e instrumentación adecuada de alta tecnología que permitiré optimizar nuestra labor.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Area Actualizar datos -->
                    <!-- Pie Perfil -->
                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-8">
                            <!-- Card Header - Dropdown -->

                            <!-- Card Body -->
                            <div class="card-body align-content-end">
                                <hr class="sidebar-divider">
                                <div class="text-center">
                                    <h2>Nuestra Vision</h2>

                                    <hr class="sidebar-divider">

                                    <p>
                                        Satisfacer los requerimientos y expectativas en el marco de la salud veterinaria,
                                        logrando así, posicionarnos como una clínica destacada por un completo cubrimiento
                                        de servicios para la salud, bienestar de nuestras mascotas, desde la ética humana
                                        profesional comprometida y responsable de calidad con el fin de brindar la mejor
                                        alternativa en atención especializada para peludos pacientes.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?php
    include_once 'layouts/footer.php';
    ?>

    <?php
}else{
    header('location: ../index.php');
}
?>