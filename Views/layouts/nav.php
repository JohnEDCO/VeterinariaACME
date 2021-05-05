<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

<!-- Custom fonts for this template-->
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="../Css/sb-admin-2.min.css" rel="stylesheet" type="text/css" >
<!-- Sweetalert2 para confirmaciones -->
<link href="../Css/sweetalert2.css" rel="stylesheet" type="text/css" >

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adm_catalogo.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-paw"></i>
            </div>
            <div class="sidebar-brand-text mx-2">ACME<br><?php echo $_SESSION['tipoRol'] ?> </br></div>

        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="adm_catalogo.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Inicio</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Control usuario
        </div>
        <!-- Nav item - Editar perfil-->
        <li class="nav-item">
            <a class="nav-link" href="../Views/editar_usuario.php">
                <i class="fas fa-fw fa-user-cog"></i>
                <span>Editar perfil</span></a>
        </li>
        <?php
        if($_SESSION['idRol'] == 8){
        ?>
        <!-- Nav item - Usuarios-->
        <li class="nav-item">
            <a class="nav-link" href="../Views/adm_usuarios.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Usuarios</span></a>
        </li>

        <!-- Nav item - Cuentas-->
        <li class="nav-item">
           <a class="nav-link" href="#">
               <i class="fas fa-fw fa-puzzle-piece"></i>
               <span>Roles</span></a>
        </li>

            <?php
         }
        ?>
        <!-- Nav Item - Utilities Collapse Menu -->
        <!--<li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-users"></i>
                <span>Cuentas</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Utilidades de cuentas:</h6>
                    <a class="collapse-item" href="utilities-color.html">Listado</a>
                    <a class="collapse-item" href="utilities-border.html">Crear</a>

                </div>
            </div>
        </li>-->


        <!-- Nav item - Crear clientes-->

        <?php
        if($_SESSION['idRol'] == 8 or $_SESSION['idRol'] == 9){
        ?>
            <!-- Divider -->
        <hr class="sidebar-divider">

            <!-- Heading control clientes -->
        <div class="sidebar-heading">
                Control clientes
        </div>

       <?php
            if($_SESSION['idRol'] == 8){
       ?>
                <li class="nav-item">
                    <a class="nav-link" href="../Views/adm_clientes.php">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Clientes</span></a>
                </li>
        <?php
            }
        ?>

            <!-- Nav item - Crear mascotas-->
            <li class="nav-item">
                <a class="nav-link" href="../Views/adm_mascotas.php">
                    <i class="fas fa-fw fa-dog"></i>
                    <span>Mascotas</span></a>
            </li>
            <!-- Nav item - Crear consultas-->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Consultas</span></a>
            </li>

            <!-- Nav item - Crear procedimientos-->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-hands-wash"></i>
                    <span>Procedimientos</span></a>
            </li>

        <?php
            }
        ?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <?php
        if($_SESSION['idRol'] == 8 or $_SESSION['idRol'] == 10){
            ?>

            <!-- Heading control clientes -->
            <div class="sidebar-heading">
                Control ventas y productos
            </div>

            <!-- Nav item - Crear productos-->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-dolly-flatbed"></i>
                    <span>Prodcutos</span></a>
            </li>
            <!-- Nav item - generar venta-->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>Ventas</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        <?php
             }
        ?>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->