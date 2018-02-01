jQuery(function () {
//variables globales
    var pathname = window.location.pathname;
    var userOnline = $('.im_online').attr('id');
    var nombrePagina = pathname.split("/");

    if (nombrePagina[nombrePagina.length - 1] == "Inicio.php") {
        jQuery("#mnuDispositivos").addClass("active");
        jQuery("#mnuProfile").removeClass("active");

    }


    if (nombrePagina[nombrePagina.length - 1] == "MyProfile.php") {
        jQuery("#mnuProfile").addClass("active");
        jQuery("#mnuDispositivos").removeClass("active");
    }


    if (nombrePagina[nombrePagina.length - 1] == "MyTrips.php") {
        var map;
        var marker;
        var id, target, options;
        var name;
        var address;
        var type;
        var ventana_ancho = $(window).width();
        var ventana_alto = $(window).height();
        jQuery("#map-canvas").height(ventana_alto * .71);

        $(window).resize(function () {
            jQuery("#map-canvas").height(ventana_alto * .71);

        });

        var customLabel = {
            restaurant: {
                label: 'M'
            },
            bar: {
                label: 'B'
            }
        };

        options = {
            enableHighAccuracy: false,
            timeout: 5000,
            maximumAge: 0
        };


        var infowindow = new google.maps.InfoWindow(options);
        function initialize() {
            var mapOptions = {
                zoom: 15, //zoom empieza el mapa
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);//creamos un nuevo objeto de las librerias
            // Try HTML5 geolocation       
        }

        function historico() {
            jQuery.ajax({
                type: 'GET',
                url: "Model/jsonHistory.php",
                data: 'user=' + userOnline,
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'resultados') {
                        jQuery.each(response.datos, function (i, d) {
//                        console.log(d);
                            paintPos(d.latitud, d.longitud, response.nombre);
                        });
                    } else if (response.status == 'error') {
                        alert('Ocurrio un error, actualice la pagina');
                    }
                },
                error: function (response) {

                }
            });
        }

        function animar() {//funcion crea un nuevo marcador en el mapa{
            console.log("funcion animar");
            navigator.geolocation.getCurrentPosition(historico, error, options);
        }

        function error(err) {
            console.log("funcion error");
            console.warn('ERROR(' + err.code + '): ' + err.message);
            alert('ERROR(' + err.code + '): ' + err.message)
        }

        function paintPos(latitud, longitud, nombre) {
            var infoWindow = new google.maps.InfoWindow;
            var lat = parseFloat(latitud);
            var long = parseFloat(longitud);
            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            var name = nombre;//cambiar por nombre usuario
//        var address = markerElem.getAttribute('address');
            var type = 'M';

            strong.textContent = name;
            var pos = new google.maps.LatLng(lat, long);
            var icon = customLabel[type] || {};
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));
            var text = document.createElement('text');
            text.textContent = address
            infowincontent.appendChild(text);
            map.panTo(pos);

            var goldStar = {
                path: google.maps.SymbolPath.CIRCLE,
                strokeColor: '#FF4E51',
                fillColor: '#FF4E51',
                fillOpacity: .9,
                strokeWeight: 1,
                scale: 5,
            };
            var marker = new google.maps.Marker({
                position: pos,
                label: icon.label,
                draggable: true,
                map: map
            });

            var options = {//opciones de la nueva pocision
                map: map,
                position: pos,
            };
            marker.addListener('click', function () {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });

//                send(lat + "," + long);	//enviamos al socket la nueva pocision	  
            //var infowindow = new google.maps.InfoWindow(options);ventana con informacion
            map.setCenter(options.position);//pocisionamos el mapa al centro de la nueva locacion
        }


        function verificar(timestamp, lastid, user) {
            var t; //tiempo
            jQuery.ajax({
                type: 'GET',
                url: "Model/jsonObject.php",
                data: 'timestamp=' + timestamp + '&lastid=' + lastid + '&user=' + user,
                dataType: 'json',
                success: function (response) {
                    clearInterval(t);
                    if (response.status == 'resultados' || response.status == 'vacio') {
                        t = setTimeout(function () {
                            verificar(response.timestamp, response.lastid, userOnline);
                        }, 1000);
                        if (response.status == 'resultados') {
                            jQuery.each(response.datos, function (i, d) {
                                console.log(d);
                                paintPos(d.latitud, d.longitud, response.nombre);
                            });
                        }
                    } else if (response.status == 'error') {
                        alert('Ocurrio un error, actualice la pagina');
                    }
                },
                error: function (response) {
                    clearInterval(t);
                    t = setTimeout(function () {
                        verificar(timestamp, lastid, userOnline);
                    }, 15000);
                }
            });
        }
        //function handleNoGeolocation(errorFlag)
//{
//    console.log("funcion handleNoGeolocation");
//    if (errorFlag)
//    {
//        var content = 'Error: The Geolocation service failed.';
//    } else
//    {
//        var content = 'Error: Your browser doesn\'t support geolocation.';
//    }
//
//    var options = {
//        map: map,
//        position: new google.maps.LatLng(60, 105),
//        content: content
//    };
//
//    var infowindow = new google.maps.InfoWindow(options);
//    map.setCenter(options.position);
//}

        //llamado a las funciones de carga
        initialize();
        map.setCenter(options.position);
        animar();
        verificar(0, 0, userOnline);
    }




    jQuery("#findMe").click(function () {
        console.log("ok")
        jQuery("#imei").val(jQuery(this).data("id"));
        jQuery("#viewLocations").submit();
    });


    jQuery("#mnuDispositivos").click(function () {
        window.location.href = "Inicio.php";
    });

    jQuery("#mnuProfile").click(function () {
        window.location.href = "MyProfile.php";
    });


    var id = "";
    jQuery('body').on('click', '.editable', function () {
        id = jQuery(this).attr("id");
    });


    jQuery('body').on('click', '#guardarThis', function () {
        var form = document.querySelector(".editableform");
        var valEditar = form.elements[0].value;
        $.ajax({
            type: 'POST',
            url: "Model/updateInfoPersonal.php",
            data: {'valor': valEditar, 'campoEdit': id},
            success: function (response) {
                if (response === "Ok") {
                    window.location.href = "MyProfile.php";
                } else {
                    showAlert("No se pudo actualizar el correo", "error");
                }
            }
        });
        id = "";
    });

//style : success,info,warn,error
    function showAlert(text, style) {
        $.notify(text, style);
    }

});

