<?php
session_start();
if($_SESSION['idRol'] == 8){
include_once 'layouts/header.php';
?>
<title>Adm | Inicio</title>
<?php
include_once 'layouts/nav.php';
?>
<!-- Modal crear cliente -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crear cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-success" role="alert" id="clienteCreado" style="display: none">
                    Cliente creado exitosamente!
                </div>

                <form id="form-crear-cliente" class="user">
                    <div class="form-group row">

                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="h7 text-dark">Nombre</label>
                            <input type="text" class="form-control form-control-user" id="nombreI"
                                   placeholder="Nombre" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="h7 text-dark">Apellido</label>
                            <input type="text" class="form-control form-control-user" id="apellidoI"
                                   placeholder="Apellido" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="h7 text-dark">Tipo Documento</label>
                        <input type="text" class="form-control form-control-user" id="tipoDocI"
                               placeholder="Tipo">
                    </div>
                    <div class="form-group">
                        <label class="h7 text-dark">Documento</label>
                        <input type="number" class="form-control form-control-user" id="documentoI"
                               placeholder="Numero documento" required>
                    </div>

                    <div class="form-group">
                        <label class="h7 text-dark">Email</label>
                        <input type="email" class="form-control form-control-user" id="emailI"
                               placeholder="Example@hotmail.com" required>
                    </div>

                    <div class="form-group">
                        <label class="h7 text-dark">Direccion</label>
                        <input type="text" class="form-control form-control-user" id="direccionI"
                               placeholder="Direccion">
                    </div>

                    <div class="form-group">
                        <label class="h7 text-dark">Telefono</label>
                        <input type="number" class="form-control form-control-user" id="telefonoI"
                               placeholder="Telefono" required>
                    </div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info">Crear cliente</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar usuario -->
<div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-success" role="alert" id="usuarioEditado" style="display: none">
                    Usuario editado exitosamente!
                </div>

                <form id="form-editar-cliente" class="user">
                    <div class="form-group row">

                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="h7 text-dark">Nombre</label>
                            <input type="text" class="form-control form-control-user" id="nombre"
                                   placeholder="Nombre" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="h7 text-dark">Apellido</label>
                            <input type="text" class="form-control form-control-user" id="apellido"
                                   placeholder="Apellido" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="h7 text-dark">Tipo Documento</label>
                        <input type="text" class="form-control form-control-user" id="tipoDoc"
                               placeholder="Tipo">
                    </div>
                    <div class="form-group">
                        <label class="h7 text-dark">Documento</label>
                        <input type="text" class="form-control form-control-user" id="documento"
                               placeholder="Numero documento">
                    </div>

                    <div class="form-group">
                        <label class="h7 text-dark">Email</label>
                        <input type="email" class="form-control form-control-user" id="email"
                               placeholder="Example@hotmail.com" required>
                    </div>

                    <div class="form-group">
                        <label class="h7 text-dark">Direccion</label>
                        <input type="text" class="form-control form-control-user" id="direccion"
                               placeholder="Direccion">
                    </div>

                    <div class="form-group">
                        <label class="h7 text-dark">Telefono</label>
                        <input type="number" class="form-control form-control-user" id="telefono"
                               placeholder="Telefono" required>
                    </div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Editar cliente</button>
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

                <!-- Nav Item - Informacion de cliente -->
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

        <!-- Begin Page Content gestion usuarios-->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-start mb-4">
                <h1 class="h3 mb-0 text-gray-800">Gestion de clientes</h1>
                <a id="agregar-nuevo"  href="#" class="btn btn-info btn-icon-split btn-sm ml-3" data-toggle="modal" data-target="#staticBackdrop">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                    <span class="text">Crear nuevo</span>
                </a>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray-700">Clientes</h6>

                </div>
                <div class="card-body">
                    <!-- Topbar buscador de usuarios -->
                    <div class="d-sm-flex align-items-center justify-content-start mb-4">
                        <h4 class="h6 mb-0 text-gray-800">Buscar cliente</h4>
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto  ml-md-3 my-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input id="buscador" type="text" class="form-control bg-light border-0 small" placeholder="Busqueda por..."
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
                            <th scope="col">Apellido</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Tipo Doc</th>
                            <th scope="col">Documento</th>
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
    <script src="../Js/gestion_clientes.js"></script>
