<?php
session_start();
if($_SESSION['idRol'] == 8 or $_SESSION['idRol'] == 9){
include_once 'layouts/header.php';
?>
<title>Adm | Mascotas</title>
<?php
include_once 'layouts/nav.php';
?>
<!-- Modal crear mascota -->
<div class="modal fade" style="overflow: scroll" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crear mascota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="form-crear-mascota" class="user">

                    <div id="body-crear-mascota">
                        <div class="form-group">
                            <label class="h7 text-dark">Nombre</label>
                            <input type="text" class="form-control form-control-user" id="nombreI"
                                   placeholder="Nombre" required>

                        </div>
                        <div class="form-group ">
                            <label class="h7 text-dark">Raza</label>
                            <input type="text" class="form-control form-control-user" id="razaI"
                                   placeholder="Raza" required>
                        </div>
                        <div class="form-group">
                            <label class="h7 text-dark">Tipo mascota</label>
                            <select class="form-control custom-select  tipoM " style="border-radius: 20px; height: 50px" id="inlineFormCustomSelect" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="h7 text-dark">Edad</label>
                            <input type="number" class="form-control form-control-user" id="edadI"
                                   placeholder="Edad">
                        </div>

                        <div class="form-group">
                            <label class="h7 text-dark">Fecha nacimiento</label>
                            <input type="date" class="form-control form-control-user" id="fechaNacI"
                                   placeholder="Fecha" >
                        </div>
                        <input type="hidden" class="form-control form-control-user" id="idDueñoI">
                    </div>

                    <button id="asignar-dueño" type="button" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#staticBackdrop3">

                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                        <span class="text">Asignar dueño</span>

                    </button>

            </div>

            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info">Crear masctoa</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar mascota -->
<div class="modal fade" style="overflow: scroll" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar mascota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="form-editar-mascota" class="user">

                    <div id="body-editar-mascota">
                        <div class="form-group">
                            <label class="h7 text-dark">Nombre</label>
                            <input type="text" class="form-control form-control-user" id="nombre"
                                   placeholder="Nombre" required>

                        </div>
                        <div class="form-group ">
                            <label class="h7 text-dark">Raza</label>
                            <input type="text" class="form-control form-control-user" id="raza"
                                   placeholder="Raza" required>
                        </div>
                        <div class="form-group">
                            <label class="h7 text-dark">Tipo mascota</label>
                            <select class="form-control custom-select  tipoME" style="border-radius: 20px; height: 50px" id="inlineFormCustomSelect" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="h7 text-dark">Edad</label>
                            <input type="number" class="form-control form-control-user" id="edad"
                                   placeholder="Edad">
                        </div>

                        <div class="form-group">
                            <label class="h7 text-dark">Fecha nacimiento</label>
                            <input type="date" class="form-control form-control-user" id="fechaNac"
                                   placeholder="Fecha" >
                        </div>
                        <input type="hidden" class="form-control form-control-user" id="idDueño">
                    </div>

                    <button id="editar-dueño-asignado" type="button" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#staticBackdrop3">

                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                        <span class="text">Asignar dueño</span>

                    </button>

            </div>

            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info">Editar mascota</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal mostrar dueños -->
<div class="modal fade" id="staticBackdrop3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dueños de mascotas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-success" role="alert" id="dueñoAsignado" style="display: none">
                    Asignacion exitosa!
                </div>
                <!-- Buscador dueños -->
                <div class="d-sm-flex align-items-center justify-content-start mb-4">
                    <h4 class="h6 mb-0 text-gray-800">Buscar dueño</h4>
                    <form
                            class="d-none d-sm-inline-block form-inline mr-auto  ml-md-3 my-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input id="buscador-dueño" type="text" class="form-control bg-light border-0 small" placeholder="Busqueda por..."
                                   aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- -Table - usuarios -->
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Tipo Documento</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Accion</th>

                    </tr>
                    </thead>
                    <tbody id="tabla-dueños">

                    </tbody>
                </table>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                        <button class="btn btn-dark" type="button">
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

                <!-- Nav Item - Informacion de mascota -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombreUsuario']?></span>
                        <img class="img-profile rounded-circle"
                             src="../Img/admin.png">
                    </a>
                    <!-- Dropdown - Informacion mascota -->
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

        <!-- Begin Page Content gestion usuarios-->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-start mb-4">
                <h1 class="h3 mb-0 text-gray-800">Gestion de mascotas</h1>
                <a id="agregar-nuevo"  href="#" class="btn btn-info btn-icon-split btn-sm ml-3" data-toggle="modal" data-target="#staticBackdrop">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                    <span class="text">Crear nuevo</span>
                </a>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray-700">Mascotas</h6>

                </div>
                <div class="card-body">
                    <!-- Topbar buscador de usuarios -->
                    <div class="d-sm-flex align-items-center justify-content-start mb-4">
                        <h4 class="h6 mb-0 text-gray-800">Buscar mascota</h4>
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto  ml-md-3 my-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input id="buscador-mascotas" type="text" class="form-control bg-light border-0 small" placeholder="Busqueda por..."
                                       aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <!-- -Table - usuarios -->
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Raza</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Fecha nacimiento</th>
                            <th scope="col">Accion</th>


                        </tr>
                        </thead>
                        <tbody id="tabla-usuarios">

                        </tbody>
                    </table>
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
    <script src="../Js/gestion_mascotas.js"></script>
