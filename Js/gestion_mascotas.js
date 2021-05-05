$(document).ready(function (){
    var idM=0;
    var funcion='';
    var modal =0; //variable para controlar  que modal esta abierto en cierto momento
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
                                idTipoMascota = "${mascota.idTipo}"
                                raza="${mascota.raza}"
                                edad="${mascota.edad}"
                                fechaNacimiento="${mascota.fechaNac}"
                                idDueño="${mascota.idCliente}"
                                nombreDueño = "${mascota.nombreCliente}"
                                apellidoDueño = "${mascota.apellidoCliente}"
                                >
                                
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
                                documento="${dueño.numeroDoc}"
                                >
                                
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
        modal = 0;
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

    //Evento para cargar los datos de la mascota seleccionado para editar en el modal
    $(document).on('click','#editar-mascota', (evt)=>{

        funcion='obtener-tipo-mascota';
        funcion2 = 'obtener-datos-dueño';
        modal = 2;
        let templateDueño='';

        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const nombre = $(elemento).attr('nombreMascota');
        const raza = $(elemento).attr('raza');
        const idTipoMascota = $(elemento).attr('idTipoMascota');
        const edad = $(elemento).attr('edad');
        const fechaNacimiento = $(elemento).attr('fechaNacimiento');
        const idDueño = $(elemento).attr('idDueño');
        const nombreDueño = $(elemento).attr('nombreDueño');
        const apellidoDueño = $(elemento).attr('apellidoDueño');
        idM = $(elemento).attr('idMascota');

        $.post('../Controllers/PetController.php', {funcion,idDueño}, (response)=> {
            const tiposME = JSON.parse(response);
            let template ='';

            tiposME.forEach(tipoM=>{
                template +=`<option value="${tipoM.idTipoM}">${tipoM.tipo}</option>`;
            });

            templateDueño= `<div class="form-group row" id="info-dueño">

                        <div class="col-sm-9 mb-3 mb-sm-0">
                            <label class="h7 text-dark">Dueño</label>
                            <input type="text" class="form-control form-control-user" id="nombreDueño" value="${nombreDueño} ${apellidoDueño}">
                        </div>
                        <div class="col mb-sm-0 mt-lg-auto">
                            <a href="#" id="retirar-dueño" class="btn btn-danger btn-circle ">
                                        <i class="fas fa-times-circle"></i>
                             </a>
                        </div>
                    </div>  `;

            if(idDueño != 'null'){
                $('#body-editar-mascota').append(templateDueño);
                $('#editar-dueño-asignado').attr('disabled', 'disabled');
            }
            $('#nombreDueño').attr('disabled','disabled');
            $('.tipoME').html(template);
            $(".tipoME option[value='"+idTipoMascota+"']").attr('selected',true);
            $('#nombre').val(nombre);
            $('#raza').val(raza);
            $('#edad').val(edad);
            $('#fechaNac').val(fechaNacimiento);
            $('#idDueño').val(idDueño);

        })
    })

    $('#form-editar-mascota').submit(evt=>{

        funcion = 'editar-mascota';
        modal =0;

        let nombreM = $('#nombre').val();
        let razaM = $('#raza').val();
        let tipoM = $('.tipoME').val();
        let edadM = $('#edad').val();
        let fechaNacM = $('#fechaNac').val();
        let idDueñoM = $('#idDueño').val();
        //console.log(fechaNacM);
        $.post('../Controllers/PetController.php', {funcion,idM,nombreM,razaM,tipoM,edadM,fechaNacM,idDueñoM}, (response)=> {

            console.log(response);
            if(response == 1){

                $('#staticBackdrop2').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'La mascota ha sido actualizada!',
                    showConfirmButton: false,
                    timer: 1500
                })

            }
            mostrar_datos_tabla();
        })

        evt.preventDefault();
    });

    //---Evento de click para eliminar usuario sleccionado desde la tabla, usando sweetalert2
    $(document).on('click','#eliminar-mascota', (evt)=>{

        funcion = 'borrar-mascota';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const idCliente = $(elemento).attr('idMascota');
        const nombreM = $(elemento).attr('nombreMascota');


        console.log(idCliente);

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Esta seguro?',
            text: "La mascota "+ nombreM + " sera eliminada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, borrar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controllers/PetController.php', {funcion,idCliente}, (response)=> {
                    mostrar_datos_tabla();
                    console.log(response);
                })
                swalWithBootstrapButtons.fire(
                    'Borrado!',
                    "La mascota "+ nombreM.bold().toUpperCase()+ " ha sido elimiada!",
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

    //Evento al cerrar el modal de editar mascota, lo que hace es retirar el input con el nombre del dueño y el boton de retirar
    $(document).on('hidden.bs.modal ', '#staticBackdrop2', evt =>{
        $('#info-dueño').remove();
        $('#editar-dueño-asignado').removeAttr('disabled', 'disabled');
        $('#asignar-dueño').removeAttr('disabled', 'disabled');

    })
//Evento al cerrar el modal de crear mascota, lo que hace es limpiar el formulario y retirar el div con la informacion del dueño
    $(document).on('hidden.bs.modal ', '#staticBackdrop', evt =>{
        $('#info-dueño').remove();
        $('#editar-dueño-asignado').removeAttr('disabled', 'disabled');
        $('#asignar-dueño').removeAttr('disabled', 'disabled');
        $('#form-crear-mascota').trigger('reset');
    })

    $(document).on('click', '#asignar-dueño', (evt)=>{
        mostrar_datos_tabla_dueños();
    })
    $(document).on('click', '#editar-dueño-asignado', (evt)=>{
        mostrar_datos_tabla_dueños();
    })

    $(document).on('click', '#retirar-dueño', (evt)=>{

        if(modal == 1){
            $('#info-dueño').remove();
            $('#asignar-dueño').removeAttr('disabled', 'disabled');
        }
        else if(modal == 2){
            $('#info-dueño').remove();
            $('#editar-dueño-asignado').removeAttr('disabled', 'disabled');
        }
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

        if (modal == 1){
            console.log("modal 1");

            $('#body-crear-mascota').append(template);
            $('#nombreDueñoI').attr('disabled', 'disabled');
            $('#asignar-dueño').attr('disabled', 'disabled');
            $('#idDueñoI').val(idDueño);
            $('#staticBackdrop3').modal('hide');
        }
        else if (modal == 2){
            console.log("modal 2");
            $('#body-editar-mascota').append(template);
            $('#nombreDueñoI').attr('disabled', 'disabled');
            $('#editar-dueño-asignado').attr('disabled', 'disabled');
            $('#idDueño').val(idDueño);
            $('#staticBackdrop3').modal('hide');

        }

    })
    $(document).on('click', '#agregar-nuevo', (evt)=>{
        funcion='obtener-tipo-mascota';
        modal = 1;
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
