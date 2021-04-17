
$(document).ready(function (){
    var idC =0;
    var funcion='';
    mostrar_datos_tabla();

    //al teclear en el buscador de clientes
    $(document).on('keyup','#buscador', function(){
        console.log($(this).val());
        mostrar_datos_tabla($(this).val());
    })

    function mostrar_datos_tabla(dato){
        funcion= 'obtener-clientes';
        $.post('../Controllers/ClientController.php', {funcion,dato}, (response)=> {

            const clientes = JSON.parse(response);
            let template ='';
            let contador=1;
            clientes.forEach(cliente=>{
                template +=`<tr idCliente="${cliente.idCliente}" 
                                nombreCliente="${cliente.nombre}" 
                                apellidoCliente="${cliente.apellido}"
                                email="${cliente.email}"
                                telefono="${cliente.telefono}"
                                direccion="${cliente.direccion}"
                                tipoDoc="${cliente.tipoDoc}"
                                documento="${cliente.numeroDoc}">
                                
                                <th scope="row">${contador}</th>
                                <td>${cliente.nombre}</td>
                                <td>${cliente.apellido}</td>
                                <td>${cliente.telefono}</td>
                                <td>${cliente.direccion}</td> 
                                <td>${cliente.tipoDoc}</td>
                                <td>${cliente.numeroDoc}</td>
                                
                                <td><a href="#" id="editar-cliente" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#staticBackdrop2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" id="eliminar-cliente" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a> 
                                </td>
                            </tr>`;
                contador++;
            });
            $('#tabla-usuarios').html(template);  
        })
    }

    $('#form-crear-cliente').submit(evt=>{

        funcion ='crear-cliente';

        let nombreC = $('#nombreI').val();
        let apellidoC = $('#apellidoI').val();
        let emailC = $('#emailI').val();
        let telefonoC = $('#telefonoI').val();
        let tipoDocC = $('#tipoDocI').val();
        let documentoC = $('#documentoI').val();
        let direccionC = $('#direccionI').val();

        $.post('../Controllers/ClientController.php', {funcion, nombreC,apellidoC, telefonoC,emailC,tipoDocC, documentoC, direccionC}, (response)=> {

            console.log(response);
            if(response == 1){
                $('#form-crear-cliente').trigger('reset');
                $('#staticBackdrop').modal('hide');
                {$('#staticBackdrop2').modal('hide')};
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'El cliente ha sido creado!',
                    showConfirmButton: false,
                    timer: 1500
                })
                mostrar_datos_tabla();

            }
        })

        evt.preventDefault();
    })

    //Evento para cargar los datos del usuario seleccionado para editar en el modal
    $(document).on('click','#editar-cliente', (evt)=>{

        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const idCliente = $(elemento).attr('idCliente');
        const documento = $(elemento).attr('documento');
        const nombre = $(elemento).attr('nombrecliente');
        const apellido = $(elemento).attr('apellidocliente');
        const email = $(elemento).attr('email');
        const telefono = $(elemento).attr('telefono');
        const direccion = $(elemento).attr('direccion');
        const tipoDoc = $(elemento).attr('tipodoc');

            $('#nombre').val(nombre);
            $('#apellido').val(apellido);
            $('#email').val(email);
            $('#telefono').val(telefono);
            $('#tipoDoc').val(tipoDoc);
            $('#documento').val(documento);
            $('#direccion').val(direccion);
            idC = idCliente;


    })

    $('#form-editar-cliente').submit(evt=>{

        funcion = 'editar-cliente';

        let idCliente = idC;
        let nombreC = $('#nombre').val();
        let apellidoC = $('#apellido').val();
        let emailC = $('#email').val();
        let telefonoC = $('#telefono').val();
        let tipoDocC = $('#tipoDoc').val();
        let documentoC = $('#documento').val();
        let direccionC = $('#direccion').val();


        $.post('../Controllers/ClientController.php', {funcion,idCliente,nombreC,apellidoC,emailC,telefonoC,direccionC,tipoDocC, documentoC}, (response)=> {

            console.log(response);
            if(response == 1){

                $('#clienteCreado').hide('slow');
                $('#clienteCreado').show(1000);
                setTimeout(function(){$('#clienteCreado').hide(1000)},2000);
                $('#form-editar-cliente').trigger('reset');
                $('#staticBackdrop2').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'El cliente ha sido actualizado!',
                    showConfirmButton: false,
                    timer: 1500
                })

            }
            edit = false;
            mostrar_datos_tabla();
        })

        evt.preventDefault();
    });

    //---Evento de click para eliminar usuario sleccionado desde la tabla, usando sweetalert2
    $(document).on('click','#eliminar-cliente', (evt)=>{

        funcion = 'borrar-cliente';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const idCliente = $(elemento).attr('idCliente');
        const nombreC = $(elemento).attr('nombrecliente');

        console.log(nombreC);

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Esta seguro?',
            text: "El cliente "+ nombreC + " sera eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, borrar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controllers/ClientController.php', {funcion,idCliente}, (response)=> {
                    mostrar_datos_tabla();
                    console.log(response);
                })
                swalWithBootstrapButtons.fire(
                    'Borrado!',
                    "El usuario "+ nombreC.bold().toUpperCase()+ " ha sido elimiado!",
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
})
