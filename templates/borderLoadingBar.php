<?php

/**
 * Retorna un Script con el constructor de un objeto Jquery con los parametros establecidos por el usuarios para crear la barra de progreso en pantalla
 *
 * @return	String
 * @since	1.0
 */
function osp_blb_getScript() {

    $titan = TitanFramework::getInstance(OSP_BLB_NAME);

    //Obtiene las propiedades
    $position = $titan->getOption(OSP_BLB_ID . "_position");
    $direction = osp_blb_converterBoolean($titan->getOption(OSP_BLB_ID . "_direction"));
    $color = osp_blb_hex2rgb($titan->getOption(OSP_BLB_ID . "_color"));
    $wide = $titan->getOption(OSP_BLB_ID . "_wide");
    $opacity = intval($titan->getOption(OSP_BLB_ID . "_opacity")) / 100;
    $shadow = osp_blb_converterBoolean($titan->getOption(OSP_BLB_ID . "_shadow"));
    $shadowScope = osp_blb_converterBoolean($titan->getOption(OSP_BLB_ID . "_shadowScope"));
    $shadowColor = osp_blb_hex2rgb($titan->getOption(OSP_BLB_ID . "_shadowColor"));
    $shadowPosX = $titan->getOption(OSP_BLB_ID . "_shadowPosX");
    $shadowPosY = $titan->getOption(OSP_BLB_ID . "_shadowPosY");
    $shadowDith = $titan->getOption(OSP_BLB_ID . "_shadowDith");
    $shadowSpread = $titan->getOption(OSP_BLB_ID . "_shadowSpread");
    $shadowOpacity = $titan->getOption(OSP_BLB_ID . "_shadowOpacity") / 100;
    $border = osp_blb_converterBoolean($titan->getOption(OSP_BLB_ID . "_border"));
    $borderColor = osp_blb_hex2rgb($titan->getOption(OSP_BLB_ID . "_borderColor"));
    $borderWidth = $titan->getOption(OSP_BLB_ID . "_borderWidth");
    $borderVisibility = $titan->getOption(OSP_BLB_ID . "_borderVisibility");
    $borderRadius = $titan->getOption(OSP_BLB_ID . "_borderRadius");
    $borderStyle = $titan->getOption(OSP_BLB_ID . "_borderStyle");
    $borderOpacity = $titan->getOption(OSP_BLB_ID . "_borderOpacity") / 100;
    $font = osp_blb_converterBoolean($titan->getOption(OSP_BLB_ID . "_font"));
    $fontStyle = $titan->getOption(OSP_BLB_ID . "_fontStyle");
    $fontAlignH = $titan->getOption(OSP_BLB_ID . "_fontAlignH");
    $fontAlignV = $titan->getOption(OSP_BLB_ID . "_fontAlignV");
    $fontOrient = $titan->getOption(OSP_BLB_ID . "_fontOrient");
    $fontText = osp_blb_formatText($titan->getOption(OSP_BLB_ID . "_fontText"));
    $animation = $titan->getOption(OSP_BLB_ID . "_animation");
    $background = osp_blb_converterBoolean($titan->getOption(OSP_BLB_ID . "_background"));
    $backgroundColor = $titan->getOption(OSP_BLB_ID . "_backgroundColor");

    //MODO DE PRUEBAS
    $testMode = osp_blb_converterBoolean($titan->getOption("testMode"));
    $testModeShowBar = osp_blb_converterBoolean($titan->getOption("testMode_showBar"));


    return "jQuery().borderLoadingBar({" .
            "position:\"$position\"," .
            "direction:$direction," .
            "color:\"rgba(" . $color[0] . "," . $color[1] . "," . $color[2] . "," . $opacity . ")\"," .
            "wide:$wide," .
            "opacity:$opacity," .
            "shadow:$shadow," .
            "shadowColor:\"rgba(" . $shadowColor[0] . "," . $shadowColor[1] . "," . $shadowColor[2] . "," . $shadowOpacity . ")\"," .
            "shadowScope:" . $shadowScope . "," .
            "shadowPosX:$shadowPosX," .
            "shadowPosY:$shadowPosY," .
            "shadowDith:$shadowDith," .
            "shadowSpread:$shadowSpread," .
            "border: $border," .
            "borderColor:\"rgba(" . $borderColor[0] . "," . $borderColor[1] . "," . $borderColor[2] . "," . $borderOpacity . ")\"," .
            "borderWidth: $borderWidth," .
            "borderVisibility: [\"" . implode("\",\"", $borderVisibility) . "\"]," .
            "borderRadius: $borderRadius," .
            "borderStyle: \"$borderStyle\"," .
            "borderOpacity: $borderOpacity," .
            "font: $font," .
            "fontStyle: [\"" . implode("\",\"", $fontStyle) . "\"]," .
            "fontAlignH: \"$fontAlignH\"," .
            "fontAlignV: \"$fontAlignV\"," .
            "fontOrient:$fontOrient," .
            "fontText:\"" . $fontText . "\"," .
            "animation:" . $animation . "," .
            "background:" . $background . "," .
            "backgroundColor:\"" . $backgroundColor . "\"" .
            "}," .
            "{mode:$testMode," .
            "showBar:$testModeShowBar" .
            "});";
}

//******************************************************************************
//FUNCIONES COMPLEMENTARIAS*****************************************************
//******************************************************************************

/**
 * Convierte un valor booleano de php a javascript
 * @param boolean $value Variable boleana de PHP
 * @return	String [true|false]
 * @since	1.0
 */
function osp_blb_converterBoolean($value) {
    if ($value)
        return "true";
    else
        return "false";
}

/**
 * Retorna la plantilla html del "Border Progress Bar"
 *
 * @return	String Html
 * @since	1.0
 */
function osp_blb_borderLoadingBar() {
    $content = "<div id='" . OSP_BLB_PREFIX . "loading-bar-container'><div id='" . OSP_BLB_PREFIX . "loading-bar'></div></div>";
    return $content;
}

/**
 * Retorna un texto procesado con formato
 * @param String $text El texto indicado por el usuario
 * @return	String Html
 * @since	1.0
 */
function osp_blb_formatText($text) {
    $keyPost = "{title}";
    $keyProgress = "{progress}";
    $keyUserName = "{username}";

    //ETIQUETA: TITLE
    //Si contiene la etiqueta {title}, imprime el titulo de la página o post actual
    if (strpos($text, $keyPost) !== false) {
        //Si es diferente en la página del home, mostrara el nombre del sitio web
        if (is_home()) {
            $text = str_replace($keyPost, get_bloginfo("name"), $text);
        } else {
            $text = str_replace($keyPost, get_the_title(''), $text);
        }
    }

    //ETIQUETA: PROGRESS
    if (strpos($text, $keyProgress) !== false) {
        //Imprime el contenedor donde se debe cargar el progreso de carga
        $text = str_replace($keyProgress, "<span id='" . OSP_BLB_PREFIX . "Text-progress'></span>", $text);
    }


    //ETIQUETA: USERNAME
    if (strpos($text, $keyUserName) !== false) {
        if (is_user_logged_in()) {
            global $current_user;
            get_currentuserinfo();
            $text = str_replace($keyUserName, $current_user->user_login, $text);
        } else {
            $text = str_replace($keyUserName, __("Visitor", OSP_BLB_HANDLER), $text);
        }
    }

    return $text;
}
