<?php
session_start();
if($_SESSION['idRol'] == 8){
    include_once 'layouts/header.php';
    ?>
    <title>Adm | Editar usuario</title>
    <?php
    include_once 'layouts/nav.php';
    ?>

    <!-- Modal Cambiar contraseña -->
    <div class="modal fade modal-editar-us" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cambiar contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" >

                        <img class="img-profile rounded-circle col-lg-4 "
                             src="../Img/admin.png">
                    </a>
                    <br>

                    <h4  class="profile-username text-center text-black-40"><?php echo $_SESSION['nombreUsuario'] ?></h4>

                    <div class="alert alert-success" role="alert" id="editadoContra" style="display: none">
                        Tu contraseña se actualizo correctamente!
                    </div>

                    <div class="alert alert-danger" role="alert" id="noeditadoContra" style="display: none">
                        La contraseña es incorrecta!
                    </div>

                    <form id="form-cambiarC" class="user">

                        <div class="form-group">
                            <label class="text-dark">Actual</label>
                            <input type="password" class="form-control form-control-user"
                                   id="old-pass" placeholder="Contraseña actual">
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Nueva</label>
                            <input type="password" class="form-control form-control-user"
                                   id="new-pass" placeholder="Contraseña nueva" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Mis datos</h1>
            </div>

            <div class="row">
                <!-- Pie Perfil -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-8">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-lg-end">
                            <a href="#" class="btn btn-warning btn-icon-split btn-sm editar">
                                        <span class="icon text-white-40">
                                            <i class="fas fa-edit"></i>
                                        </span>
                            </a>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body align-content-end">

                            <div text-center">
                                <a class="sidebar-brand d-flex align-items-center justify-content-center" >

                                    <img class="img-profile rounded-circle col-lg-7 "
                                         src="../Img/admin.png">
                                </a>

                            <br>

                            <input id="idUsuario" type="hidden" value="<?php echo $_SESSION['idUsuario'] ?>">

                            <h4 id="nombre" class="profile-username text-center text-black-40">0</h4>
                            <h5 id="apellido" class="profile-username text-center text-black-40">0</h5>

                            <hr class="sidebar-divider">

                            <ul class="list-group list-group-flush list-group-item-dark ">
                                <li  class="list-group-item text-gray-700">Email: <span id="email" class="float-right">0</span></li>
                                <li  class="list-group-item text-gray-700">Telefono: <span id="telefono" class="float-right">0</li>
                                <li  class="list-group-item text-gray-700">Tipo: <span id="tipo" class="float-right badge badge-dark">0</li>

                            </ul>

                            <hr class="sidebar-divider">

                            <div class="text-center">
                                <button class="btn btn-primary btn-icon-split btn-cambiarC" type="submit" data-toggle="modal" data-target="#staticBackdrop">

                                        <span class="icon text-white-50">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    <span class="text">Cambiar contraseña</span>

                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area Actualizar datos -->
                <div class="col-xl-8 col-lg-7 " >
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-gray-600">Actualizar datos</h6>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">

                            <div class="alert alert-success" role="alert" id="editado" style="display: none">
                                Se actualizo correctamente!
                            </div>

                            <form id="form-usuario" class="user">
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="text-dark">Nombre</label>
                                        <input type="text" class="form-control form-control-user" id="nombreI"
                                               placeholder="Nombre" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="text-dark">Apellido</label>
                                        <input type="text" class="form-control form-control-user" id="apellidoI"
                                               placeholder="Apellido" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">Email</label>
                                    <input type="email" class="form-control form-control-user" id="emailI"
                                           placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">Telefono</label>
                                    <input type="number" class="form-control form-control-user" id="telefonoI"
                                           placeholder="Telefono" required>
                                </div>

                                <hr class="sidebar-divider">
                                    <div class="text-center">
                                        <button class="btn btn-success btn-icon-split btn-actualizar" type="submit">

                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                            <span class="text">Actualizar informacion</span>

                                        </button>
                                    </div>
                            </form>
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
    header('location: ../../index.php');
}
?>

<script src="../Js/usuario.js"></script>
