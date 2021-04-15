$(document).ready(function (){
    var funcion='';
    var idUsuario= $('#idUsuario').val();
    var edit= false;

    $('#form-usuario input').attr('disabled','disabled');
    $('.btn-actualizar').attr('disabled','disabled');

    buscar_usuario(idUsuario);


    function buscar_usuario(dato){
        funcion= 'buscar_usuario';
        $.post('../Controllers/UserController.php', {dato,funcion}, (response)=>{

            console.log(response);

            let nombre='';
            let apellido='';
            let telefono='';
            let email='';
            let password='';
            let idRol='';
            let tipo='';

            const usuario = JSON.parse(response);

            nombre +=`${usuario.nombre}`;
            apellido +=`${usuario.apellido}`;
            telefono +=`${usuario.telefono}`;
            email +=`${usuario.email}`;
            tipo +=`${usuario.tipo}`;

            $('#nombre').html(nombre);
            $('#apellido').html(apellido);
            $('#email').html(email);
            $('#telefono').html(telefono);
            $('#tipo').html(tipo);

            console.log(nombre);

        })
    }

    $(document).on('click','.editar', (evento)=>{

        funcion = 'capturar_datos';
        edit = true;
        $.post('../Controllers/UserController.php', {idUsuario,funcion}, (response)=> {

            const usuario = JSON.parse(response);

            $('#nombreI').val(usuario.nombre);
            $('#apellidoI').val(usuario.apellido);
            $('#emailI').val(usuario.email);
            $('#telefonoI').val(usuario.telefono);

            $('.form-control-user').removeAttr('disabled');
            $('.btn-actualizar').removeAttr('disabled');



        })
    });

    $('#form-usuario').submit(evt=>{
        funcion = 'editar_usuario';
        console.log("Aqui esta agarrando");

        if(edit==true){
            let nombreU = $('#nombreI').val();
            let apellidoU = $('#apellidoI').val();
            let emailU = $('#emailI').val();
            let telefonoU = $('#telefonoI').val();

            $.post('../Controllers/UserController.php', {idUsuario,funcion,nombreU,apellidoU,emailU,telefonoU}, (response)=> {

                console.log(response);
                if(response == 1){

                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    setTimeout(function(){$('#editado').hide(1000)},2000);
                    $('#form-usuario').trigger('reset');

                    $('#form-usuario input').attr('disabled','disabled');
                    $('.btn-actualizar').attr('disabled','disabled');

                }
                edit = false;
                buscar_usuario(idUsuario);
            })
        }
        evt.preventDefault();
    });

    $('#form-cambiarC').submit(evt=>{

        funcion = 'cambiar-contraseña';
        let newPass = $('#new-pass').val();
        let oldPass = $('#old-pass').val();

        $.post('../Controllers/UserController.php',{idUsuario,funcion, newPass, oldPass},(response)=>{
            if(response == 1){

                $('#editadoContra').hide('slow');
                $('#editadoContra').show(1000);
                setTimeout(function(){$('#editadoContra').hide(1000)},2000);
                $('#form-cambiarC').trigger('reset');
                console.log($('#staticBackdrop').getAttribute());


            }else{
                $('#noeditadoContra').hide('slow');
                $('#noeditadoContra').show(1000);
                setTimeout(function(){$('#noeditadoContra').hide(1000)},2000);
                $('form-cambiarC').trigger('reset');
            }
        })

        evt.preventDefault();
    })
})
