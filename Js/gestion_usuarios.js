$(document).ready(function (){
    var idUsuario =0;
    var funcion='';
    mostrar_datos_tabla();

    function mostrar_datos_tabla(dato){
        funcion= 'obtener-usuarios';
        $.post('../Controllers/UserController.php', {funcion,dato}, (response)=> {

           const usuarios = JSON.parse(response);
            let template ='';
            let contador=1;
            usuarios.forEach(usuario=>{
                template +=`<tr idUsuario="${usuario.idUsuario}" 
                                nombreUsuario="${usuario.nombre}" 
                                apellidoUsuario="${usuario.apellido}"
                                email="${usuario.email}"
                                telefono="${usuario.telefono}"
                                password="${usuario.password}"
                                idRol="${usuario.idRol}"
                                tipoUsuario="${usuario.tipoRol}">
                                
                                <th scope="row">${contador}</th>
                                <td>${usuario.nombre}</td>
                                <td><span class="badge badge-dark">${usuario.tipoRol}</td>
                                <td><a href="#" id="ver-usuario" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" id="editar-usuario" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#staticBackdrop2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" id="eliminar-usuario" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a> 
                                    </td>
                            </tr>`;
                contador++;
            });
            $('#tabla-usuarios').html(template);
        })
    }

    $(document).on('click','#agregar-nuevo', evt=>{
        funcion='obtener-roles';

        $.post('../Controllers/UserController.php', {funcion}, (response)=> {
           const roles = JSON.parse(response);
           let template ='';

           roles.forEach(rol=>{
               template +=`<option value="${rol.idRol}">${rol.tipo}</option>`;
           });
           $('.rol').html(template);
        })

    })

    $('#form-crear-usuario').submit(evt=>{

        funcion ='crear-usuario';

        let nombre = $('#nombreI').val();
        let apellido = $('#apellidoI').val();
        let telefono = $('#telefonoI').val();
        let email = $('#emailI').val();
        let password = $('#passwordI').val();
        let idRol = $('.rol').val();

        $.post('../Controllers/UserController.php', {funcion, nombre,apellido, telefono,email,password,idRol}, (response)=> {
            if(response == 1){
                mostrar_datos_tabla();
                $('#usuarioCreado').hide('slow');
                $('#usuarioCreado').show(1000);
                setTimeout(function(){$('#usuarioCreado').hide(1000)},2000);
                $('#form-crear-usuario').trigger('reset');
            }
        })

        evt.preventDefault();
    })

    $(document).on('keyup','#buscador', function(){
            console.log($(this).val());
           mostrar_datos_tabla($(this).val());
    })

    //Evento de click para eliminar usuario sleccionado desde la tabla, usando sweetalert2
    $(document).on('click','#eliminar-usuario', (evt)=>{

        funcion='borrar-usuario';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idUsuario');
        const nombre = $(elemento).attr('nombreUsuario');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Esta seguro?',
            text: "El usuario "+ nombre + " sera eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, borrar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controllers/UserController.php', {funcion,id}, (response)=> {
                    mostrar_datos_tabla();
                })
                    swalWithBootstrapButtons.fire(
                    'Borrado!',
                    "El usuario "+ nombre.bold().toUpperCase()+ " ha sido elimiado!",
                    'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'No se ha eliminado!',
                    'error'
                )
            }
        })
    })

    //Evento para cargar los datos del usuario seleccionado para editar en el modal
    $(document).on('click','#editar-usuario', (evt)=>{

        funcion='obtener-roles';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idUsuario');
        const nombre = $(elemento).attr('nombreUsuario');
        const apellido = $(elemento).attr('apellidoUsuario');
        const email = $(elemento).attr('email');
        const telefono = $(elemento).attr('telefono');
        const idrol = $(elemento).attr('idrol');
        const tipo = $(elemento).attr('tipoUsuario');
        idUsuario = id;

        console.log(telefono);
        $.post('../Controllers/UserController.php', {funcion}, (response)=> {
            const roles = JSON.parse(response);
            let template ='';

            roles.forEach(rol=>{
                template +=`<option value="${rol.idRol}">${rol.tipo}</option>`;

            });
            $('.rolEdit').html(template);
            $('#nombre').val(nombre);
            $('#apellido').val(apellido);
            $('#email').val(email);
            $('#telefono').val(telefono);
            $(".rolEdit option[value='"+idrol+"']").attr('selected',true);

        })

    })

    $('#form-editar-usuario').submit(evt=>{
        funcion = 'editar-usuario';

            let nombreU = $('#nombre').val();
            let apellidoU = $('#apellido').val();
            let emailU = $('#email').val();
            let telefonoU = $('#telefono').val();
            let idrol = $('.rolEdit').val();
            let id = idUsuario;
        console.log(typeof id);
            $.post('../Controllers/UserController.php', {id,funcion,nombreU,apellidoU,emailU,telefonoU,idrol}, (response)=> {

                console.log(response);
                if(response == 1){

                    $('#usuarioEditado').hide('slow');
                    $('#usuarioEditado').show(1000);
                    setTimeout(function(){$('#usuarioEditado').hide(1000)},2000);
                    $('#form-editar-usuario').trigger('reset');
                    {$('#staticBackdrop2').modal('hide')};
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'El usuario ha sido actualizado!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
                edit = false;
                mostrar_datos_tabla();
            })

        evt.preventDefault();
    });
})
