jQuery(function () {
    jQuery('body').on('click', '#validar', function () {
        if (jQuery("#Username").val() === "") {
            showAlert("El campo email no debe estar vacio", "error");
            jQuery("#Username").focus();
            return;
        }
        if (jQuery("#pass").val() === "") {
            showAlert("El campo contraseña no debe estar vacio", "error");
            jQuery("#pass").focus();
            return;
        }
        jQuery.ajax({
            type: 'POST',
            url: "Model/login.php",
            data: {usuario: jQuery("#Username").val(), pass: jQuery("#pass").val()},
            success: function (response) {
                if (response === 'ok') {
                    setTimeout(redireccionarPagina('Inicio.php'), 3000);
                } else {
                    showAlert("Usuario o Contraseña incorrecto", "error");
                    jQuery("#pass").val("");
                    jQuery("#Username").val("");
                    jQuery("#Username").focus();
                }
            }
        });

    });

    //style : success,info,warn,error
    function showAlert(text, style) {
        $.notify(text, style);
    }


    function redireccionarPagina(pagina) {
        window.location = pagina;
    }



});

//if (e.which == 13) {
//            var texto = jQuery(this).val();
//            jQuery(this).val("");
//            var id = jQuery(this).attr('id');
//            console.log(id);
//            var dataId = jQuery(this).data('id');
//            var split = dataId.split(':');
//            jQuery.ajax({
//                type: 'POST',
//                url: "Model/sendMessages.php",
//                data: {mensaje: texto, de: userOnline, para: Number(split[1])},
//                success: function (response) {
//                    if (response !== 'ok') {
//                        alert('ocurrio error al enviar el mensaje');
//                    }
//                }
//            });
//        }


