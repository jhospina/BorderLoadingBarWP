/*
 * Modulo: Border Progress Bar (Barra de progreso en el Borde)
 * Descripción: Barra de progreso posicionada en el borde de la ventana
 * Author: Ospisoft Inc.
 * URL: http://ospisoft.com
 * Version: 1.0
 */

jQuery.fn.extend({
    borderLoadingBar: function (bar, test) {

        //Valores por defecto de las entidades html
        var defaults_entities = {
            bar: "#" + osp_blb_prefix + "loading-bar",
            container: "#" + osp_blb_prefix + "loading-bar-container"
        }

        //Valores por defecto de las opciones
        var defaults_bar = {
            position: "top", // Indica la posicion de ubicación del borde
            direction: true, // Indica la dirección de desplazamiento de la barra [normal=> true:reverse=> false]
            color: "red", //Color de fondo del overlight 
            wide: 5, // Tamaño en pixeles del grosor de la barra de progreso
            opacity: 1, //Opacidad de la barra de progreso
            shadow: true, //Indica si muestra una sombra
            shadowScope: true, //indica el entorno de la sombra [True: Exterior, false: Interior]
            shadowColor: "red", //Color de la sombra
            shadowPosX: 0, // Indica la posicion X de la sombra
            shadowPosY: 0, // Indica la posicion Y de la sombra
            shadowDith: 10, // Indica el difuminado de la sombra
            shadowSpread: 10, //Indica el radio de propagación
            shadowOpacity: 1, // Indica la opacidad de la sombra
            border: false, // Indica si debe mostrar el borde
            borderColor: "rgba(0,0,0,1)", // Color del borde
            borderWidth: 1, // Ancho del borde
            borderVisibility: ["top", "right", "bottom", "left"], // Visibilidad de los bordes
            borderRadius: 0, // Radio de redondeo de los bordes
            borderStyle: "solid", // Estilo del borde
            borderOpacity: 1, // Transparencia del borde
            font: false, // Indica si se acepta el texto
            fontStyle: new Array(), // Vector con los estilos de la fuente
            fontAlignH: "center", // Establece la alineación horizontal
            fontAlignV: "middle", // Establece la alineación vertical
            fontOrient: 0, // Indica la orientación de escritura del texto en grados de un angulo
            fontText: "", //Indica el texto a escribir en la barra 
            animation: 2, //Indica el tipo de animación de aparición de la barra
            background: true, // Indica si se quiere mostrar el fondo
            backgroundColor: "#FFFFFF" // Color del fondo
        }

        var defaults_test = {
            mode: false, // Indica si esta activado el modo de pruebas
            showBar: false // Indica que siempre debe mostrar la barra de progreso
        }

        //Establece los valores por defecto
        var bar = jQuery.extend({}, defaults_bar, bar);
        var entities = jQuery.extend({}, defaults_entities, entities);
        var test = jQuery.extend({}, defaults_test, test);

        //Aplicación de los estilos
        constructor(entities, bar);

        //Carga de la barra
        load(entities);


        //*********************************************************************************************
        //******FUNCIONES DEL PLUGIN*******************************************************
        //*********************************************************************************************

        //FUNCIÓN QUE CARGA Y ANIMA LA BARRA DE PROGRESO
        function load(entities) {

            var time = 200;//Tiempo de frecuencia para cada comprobación

            //**************************CREA LA ANIMACIÓN DEL PROGRESO DE LA BARRA************************//
            if (bar.position == "top" || bar.position == "bottom")
            {
                //Aplica la animación ajustada
                animationInOut(entities, bar.animation, {in: true, dimension: "height", wide: bar.wide});

                //Inicia el loop de comprobación
                loop(time, "width");

                jQuery(window).load(function () {
                    jQuery(entities.bar).animate({width: jQuery(window).width()}, {
                        duration: time,
                        progress: function (anim, progress) {
                            //Imprime el progreso en pantalla si este es requerido
                            if (jQuery("#" + osp_blb_prefix + "Text-progress").length) {
                                jQuery("#" + osp_blb_prefix + "Text-progress").html(Math.floor(progress * (100 - 90)) + 90);
                            }
                        }, complete: function () {

                            //Truco para evitar que la barra de progreso se devuelta una vez finalizado
                            jQuery(entities.bar).css("min-width", jQuery(window).width());

                            //Si esta en modo de prueba, puede evitar que se oculte la barra
                            if (test.mode && test.showBar)
                                return;

                            //Oculta el texto
                            if (jQuery("#" + osp_blb_prefix + "text").length) {
                                jQuery("#" + osp_blb_prefix + "text").hide();
                            }
                            //Aplica la animación ajustada
                            animationInOut(entities, bar.animation, {in: false, dimension: "height", wide: 0});
                        }});
                });


            } else {

                //Aplica la animación ajustada
                animationInOut(entities, bar.animation, {in: true, dimension: "width", wide: bar.wide});

                //Inicia el loop de comprobación
                loop(time, "height");

                jQuery(window).load(function () {
                    jQuery(entities.bar).animate({height: jQuery(window).height()}, {
                        duration: time,
                        progress: function (anim, progress) {
                            //Imprime el progreso en pantalla si este es requerido
                            if (jQuery("#" + osp_blb_prefix + "Text-progress").length) {
                                jQuery("#" + osp_blb_prefix + "Text-progress").html(Math.floor(progress * (100 - 90)) + 90);
                            }
                        }, complete: function () {

                            //Truco para evitar que la barra de progreso se devuelta una vez finalizado
                            jQuery(entities.bar).css("min-height", jQuery(window).height());

                            //Si esta en modo de prueba, puede evitar que se oculte la barra
                            if (test.mode && test.showBar)
                                return;

                            //Oculta el texto
                            if (jQuery("#" + osp_blb_prefix + "text").length) {
                                jQuery("#" + osp_blb_prefix + "text").hide();
                            }
                            //Aplica la animación ajustada
                            animationInOut(entities, bar.animation, {in: false, dimension: "width", wide: 0});
                        }});
                });

            }
        }

        //Funcion que inicia un bucle de comprobaciones de carga
        function loop(time, dimesion) {

            var numImagesLoaded = 0; // Almacena el numero total de imagenes cargadas
            var numImages = jQuery("img").length;//Almacena la cantidad de imagenes en pantalla

            //Indica cuando una imagen ya esta cargada
            jQuery("img").each(function () {
                jQuery(this).load(function () {
                    numImagesLoaded++;
                });
            });

            //Comprueba cada X tiempo la carga del sitio y lo refleja en la barra de progreso
            var tick = function () {
                //Comprueba si todavia faltan imagenes por cargar
                if (numImages != numImagesLoaded)
                    setTimeout(tick, time);
                // Calcula el porcentaje de carga
                var percent = (numImagesLoaded * 90) / numImages;
                //Imprime el progreso en pantalla si este es requerido
                if (jQuery("#" + osp_blb_prefix + "Text-progress").length) {
                    jQuery("#" + osp_blb_prefix + "Text-progress").html(Math.floor(percent));
                }
                //Carga el progreso de la barra
                if (dimesion == "width")
                    jQuery(entities.bar).animate({width: (jQuery(window).width() * (percent / 100))}, time);
                else
                    jQuery(entities.bar).animate({height: (jQuery(window).height() * (percent / 100))}, time);
            };

            //Inicia la comprobación de carga
            setTimeout(tick, time);
        }



        //Contruye los estilos
        function constructor(entities, bar) {

            //*************************************************
            //ESTABLECE LAS PROPIEDAD DEL FONDO DE LA BARRA****
            //*************************************************
            //
            //ESTABLECE LA POSICIÓN                                               
            if (bar.position == "top" || bar.position == "bottom")
            {
                jQuery(entities.container).css("height", bar.wide);
                jQuery(entities.container).css("width", "100%");
                jQuery(entities.container).css("left", "0px");
            }

            if (bar.position == "left" || bar.position == "right") {
                jQuery(entities.container).css("height", "100%");
                jQuery(entities.container).css("top", "0px");
                jQuery(entities.container).css("width", bar.wide);
            }

            jQuery(entities.container).css(bar.position, "0px");


            //***************************************************
            //ESTABLECE LAS PROPIEDADES DE LA BARRA DE PROGRESO**
            //***************************************************

            //ESTABLECE LA POSICIÓN                                               
            if (bar.position == "top" || bar.position == "bottom")
            {
                jQuery(entities.bar).css("height", bar.wide);

                //Establece la dirección de recorrido de la barra
                if (bar.direction)
                    jQuery(entities.bar).css("left", "0px");
                else
                    jQuery(entities.bar).css("right", "0px");
            }

            if (bar.position == "left" || bar.position == "right") {
                //Establece la dirección de recorrido de la barra
                if (bar.direction)
                    jQuery(entities.bar).css("top", "0px");
                else
                    jQuery(entities.bar).css("bottom", "0px");

                jQuery(entities.bar).css("width", bar.wide);
            }

            //Color de la barra de progreso
            jQuery(entities.bar).css("background", bar.color);
            //Establece la posición de la barra
            jQuery(entities.bar).css(bar.position, "0px");
            //Opacidad
            jQuery(entities.bar).css("opacity", bar.opacity);

            //******************************************************************
            //PROPIEDAD: SOMBRA*************************************************
            //******************************************************************

            //Apblba el sombreado si es indicado
            if (bar.shadow) {
                //Construye las propiedades de estilo de la sombra
                var style_shadow = bar.shadowPosX + "px " + bar.shadowPosY + "px " + bar.shadowDith + "px " + bar.shadowSpread + "px " + bar.shadowColor;
                //Apblba el ambito
                if (!bar.shadowScope)
                    style_shadow = "inset " + style_shadow;
                //Construye el sombreado compatible para varios navegadores
                jQuery(entities.bar).css("-webkit-box-shadow", style_shadow);
                jQuery(entities.bar).css("-moz-box-shadow", style_shadow);
                jQuery(entities.bar).css("box-shadow", style_shadow);
            }


            //******************************************************************
            //PROPIEDAD: BORDE**************************************************
            //******************************************************************

            if (bar.border) {

                var vis = bar.borderVisibility;
                for (var i = 0; i < vis.length; i++) {
                    jQuery(entities.bar).css("border-" + vis[i], bar.borderWidth + "px " + bar.borderStyle + " " + bar.borderColor);
                }

                //Apblba un nuevo grosor para la barra
                if (bar.position == "top" || bar.position == "bottom") {
                    var mult = 0;//Indica la cantidad de grosor adicional que se necesita para conservar el grosor de la barra

                    if (vis.indexOf("top") >= 0)
                        mult++;
                    if (vis.indexOf("bottom") >= 0)
                        mult++;
                    jQuery(entities.bar).css("height", bar.wide + (bar.borderWidth * mult));
                }
                else {

                    var mult = 0;//Indica la cantidad de grosor adicional que se necesita para conservar el grosor de la barra
                    if (vis.indexOf("left") >= 0)
                        mult++;
                    if (vis.indexOf("right") >= 0)
                        mult++;
                    jQuery(entities.bar).css("width", bar.wide + (bar.borderWidth * mult));
                }

                //Apblba el redondeo
                jQuery(entities.bar).css("-webkit-border-radius", bar.borderRadius + "px");
                jQuery(entities.bar).css("-moz-border-radius", bar.borderRadius + "px");
                jQuery(entities.bar).css("border-radius", bar.borderRadius + "px");
            }

            //******************************************************************
            //PROPIEDAD: FUENTE**************************************************
            //******************************************************************

            if (bar.font) {
                var font = bar.fontStyle;

                var id_text_container = osp_blb_prefix + "text";

                //Crea un contenedor dentro de la barra para escribir el texto indicado por el usuario
                jQuery(entities.container).append("<div id='" + id_text_container + "'></div>");

                id_text_container = "#" + id_text_container;

                jQuery(id_text_container).css("font-family", font[0]);
                jQuery(id_text_container).css("color", font[1]);
                jQuery(id_text_container).css("font-size", font[2]);
                jQuery(id_text_container).css("font-weight", font[3]);
                jQuery(id_text_container).css("font-style", font[4]);
                jQuery(id_text_container).css("line-height", font[5]);
                jQuery(id_text_container).css("letter-spacing", font[6]);
                if (font[9] != "none")
                    jQuery(id_text_container).css("text-shadow", getTextShadow(font[9], font[10], font[11], font[12], font[13]));

                //ROTACIÓN DEL TEXTO
                jQuery(id_text_container).css("-webkit-transform", "rotate(" + bar.fontOrient + "deg)");
                jQuery(id_text_container).css("-moz-transform", "rotate(" + bar.fontOrient + "deg)");

                //***********************************************
                //ESTABLECE LAS ALINEACIONES*********************
                //***********************************************

                setTimeout(function () {
                    if (bar.fontAlignH == "left" || bar.fontAlignH == "right")
                        jQuery(id_text_container).css(bar.fontAlignH, "2px");

                    if (bar.position == "top" || bar.position == "bottom") {
                        if (bar.fontAlignH == "center")
                            jQuery(id_text_container).css("left", (jQuery(window).width() / 2) - (jQuery(id_text_container).width() / 2));
                        //Centra verticalmente el texto
                        if (bar.fontAlignV == "middle")
                            jQuery(id_text_container).css("top", ((jQuery(entities.bar).height() / 2) - (jQuery(id_text_container).height() / 2)));
                    }
                    if (bar.position == "left" || bar.position == "right") {
                        //Centra horizontalmente el texto
                        if (bar.fontAlignH == "center")
                            jQuery(id_text_container).css("left", (jQuery(entities.bar).width() / 2) - (jQuery(id_text_container).width() / 2));
                        //Centra verticalmente el texto
                        if (bar.fontAlignV == "middle")
                            jQuery(id_text_container).css("top", ((jQuery(window).height() / 2) - (jQuery(id_text_container).height() / 2)));
                    }
                    if (bar.fontAlignV == "top")
                        jQuery(id_text_container).css("top", 0);
                    if (bar.fontAlignV == "bottom")
                        jQuery(id_text_container).css("bottom", 0);

                    //Hace visible el texto en la barra
                    jQuery(id_text_container).css("visibility", "visible");
                    jQuery(id_text_container).css("text-align", bar.fontAlignH);

                }, 350);

                //ESCRIBE EL TEXTO INDICADO
                jQuery(id_text_container).html(bar.fontText);

            }


            //******************************************************************
            //PROPIEDAD: FONDO**************************************************
            //******************************************************************

            if (bar.background) {
                //Aplica el color del fondo
                jQuery(entities.container).css("background", bar.backgroundColor);
            }

        }

        //Retorna y crear el formato de la sombra de texto
        function getTextShadow(location, distance, blur, color, opacity) {

            var content = "";

            if (/left/.test(location))
                content += "-";
            if (/left/.test(location) || /right/.test(location))
                content += distance + " ";
            else
                content += "0px ";
            if (/top/.test(location))
                content += "-";
            if (/top/.test(location) || /bottom/.test(location))
                content += distance + " ";
            else
                content += "0px ";

            //Aplica el difuminado
            content += blur + " ";

            //Aplica el color y la opaciodad en formato rgba
            content += osp_lbl_hex2rgb(color, opacity);

            return content;
        }

        //Aplica la animación de entrada y salida de la barra de progreso
        function animationInOut(entities, animation, options) {
            var time = 300;

            switch (animation) {
                //Animación de "Fade"
                case 1:
                    //Entrada
                    if (options.in)
                        jQuery(entities.container).fadeIn(time);
                    //Salida
                    else
                        jQuery(entities.container).fadeOut(time);
                    break;
                    //Animación de "Toggle" 
                case 2:
                    if (options.in) {
                        jQuery(entities.container).show();
                    }

                    if (options.dimension == "width") {
                        if (options.in) {
                            jQuery(entities.container).width(0);
                            jQuery(entities.bar).width(0);
                        }
                        jQuery(entities.container).animate({width: options.wide}, time);
                        jQuery(entities.bar).animate({width: options.wide}, time);
                    }
                    if (options.dimension == "height") {
                        if (options.in) {
                            jQuery(entities.container).height(0);
                            jQuery(entities.bar).height(0);
                        }
                        jQuery(entities.container).animate({height: options.wide}, time);
                        jQuery(entities.bar).animate({height: options.wide}, time);
                    }

                    break;
            }
        }

    }
});