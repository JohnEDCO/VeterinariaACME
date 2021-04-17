$(document).ready(function (){
    var idM =0;
    var funcion='';
    mostrar_datos_tabla();

    //al teclear en el buscador de mascotas
    $(document).on('keyup','#buscador-mascotas', function(){
        console.log($(this).val());
        mostrar_datos_tabla($(this).val());
    })

    //al teclear en el buscador de dueños
    $(document).on('keyup','#buscador-dueño', function(){
        console.log($(this).val());
        mostrar_datos_tabla_dueños($(this).val());
    })

    function mostrar_datos_tabla(dato){
        funcion= 'obtener-mascotas';
        $.post('../Controllers/PetController.php', {funcion,dato}, (response)=> {
            console.log(response);
            const mascotas = JSON.parse(response);
            let template ='';
            let contador=1;
            mascotas.forEach(mascota=>{

                console.log(mascota.idCliente);

                template +=`<tr idMascota="${mascota.idMascota}" 
                                nombreMascota="${mascota.nombre}" 
                                tipoMascota="${mascota.tipo}"
                                raza="${mascota.raza}"
                                edad="${mascota.edad}"
                                fechaNacimiento="${mascota.fechaNac}"
                                idDueño="${mascota.idCliente}">
                                
                                <th scope="row">${contador}</th>
                                <td>${mascota.nombre}</td>
                                <td>${mascota.tipo}</td>
                                <td>${mascota.raza}</td>
                                <td>${mascota.edad}</td> 
                                <td>${mascota.fechaNac}</td>
                                
                                <td><a href="#" id="editar-mascota" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#staticBackdrop2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" id="eliminar-mascota" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a> 
                                    </td>
                            </tr>`;
                contador++;
            });
            $('#tabla-usuarios').html(template);
        })
    }
    function mostrar_datos_tabla_dueños(dato){
        funcion= 'obtener-dueños';
        $.post('../Controllers/PetController.php', {funcion,dato}, (response)=> {

            const dueños = JSON.parse(response);
            let template ='';
            let contador=1;
            dueños.forEach(dueño=>{
                template +=`<tr idCliente="${dueño.idCliente}" 
                                nombreCliente="${dueño.nombre}" 
                                apellidoCliente="${dueño.apellido}"
                                tipoDoc="${dueño.tipoDoc}"
                                documento="${dueño.numeroDoc}">
                                
                                <th scope="row">${contador}</th>
                                <td>${dueño.nombre}</td>
                                <td>${dueño.apellido}</td>
                                <td>${dueño.tipoDoc}</td>
                                <td>${dueño.numeroDoc}</td>
                                
                                <td><a href="#" id="seleccion-dueño" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-hand-pointer"></i>
                                    </a> 
                                </td>
                            </tr>`;
                contador++;
            });
            $('#tabla-dueños').html(template);
        })
    }
    $('#form-crear-mascota').submit(evt=>{

        funcion ='crear-mascota';

        let nombreM = $('#nombreI').val();
        let razaM = $('#razaI').val();
        let idTipo = $('.tipoM').val();
        let edadM = $('#edadI').val();
        let fechaNacM = $('#fechaNacI').val();
        let idClienteM = $('#idDueñoI').val();

        $.post('../Controllers/PetController.php', {funcion, nombreM,razaM, idTipo,edadM,fechaNacM, idClienteM}, (response)=> {

            console.log(response);
            if(response == 1){
                $('#form-crear-mascota').trigger('reset');
                $('#staticBackdrop').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'La mascota ha sido creado!',
                    showConfirmButton: false,
                    timer: 1500
                })
                mostrar_datos_tabla();

            }
        })

        evt.preventDefault();
    })

    //Evento para cargar los datos del usuario seleccionado para editar en el modal
    $(document).on('click','#editar-mascota', (evt)=>{

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

    $('#form-editar-mascota').submit(evt=>{

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
    $(document).on('click','#eliminar-mascota', (evt)=>{

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

    $(document).on('click', '#asignar-dueño', (evt)=>{
        mostrar_datos_tabla_dueños();
    })
    $(document).on('click', '#retirar-dueño', (evt)=>{
        $('#info-dueño').remove();
        $('#asignar-dueño').removeAttr('disabled', 'disabled');
    })

    $(document).on('click', '#seleccion-dueño', (evt)=>{

        let template ='';

        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const idDueño = $(elemento).attr('idcliente');
        const nombreDueño = $(elemento).attr('nombrecliente');
        const apellidoDueño = $(elemento).attr('apellidocliente');

        template= `<div class="form-group row" id="info-dueño">

                        <div class="col-sm-9 mb-3 mb-sm-0">
                            <label class="h7 text-dark">Dueño</label>
                            <input type="text" class="form-control form-control-user" id="nombreDueñoI" value="${nombreDueño} ${apellidoDueño}">
                        </div>
                        <div class="col mb-sm-0 mt-lg-auto">
                            <a href="#" id="retirar-dueño" class="btn btn-danger btn-circle ">
                                        <i class="fas fa-times-circle"></i>
                             </a>
                        </div>
                    </div>  `;

        $('#body-crear-mascota').append(template);
        $('#nombreDueñoI').attr('disabled', 'disabled');
        $('#asignar-dueño').attr('disabled', 'disabled');
        $('#idDueñoI').val(idDueño);
        $('#staticBackdrop3').modal('hide');

    })
    $(document).on('click', '#agregar-nuevo', (evt)=>{
        funcion='obtener-tipo-mascota';

        $.post('../Controllers/PetController.php', {funcion}, (response)=> {
            const tiposM = JSON.parse(response);
            let template ='';

            tiposM.forEach(tipoM=>{
                template +=`<option value="${tipoM.idTipoM}">${tipoM.tipo}</option>`;
            });
            $('.tipoM').html(template);
        })
    })

})
