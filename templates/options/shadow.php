<?php

//PROPIEDAD =>SOMBREADO

/**
 * Crea la sección de opciones para la sombra de la barra de progreso
 * @param TitanFramework->createAdminPanel $panel Objeto funcional del panel donde se debe crear las opciones.
 * @return	void
 * @since	1.0
 */
function osp_blb_options_shadow($panel) {

    $propiety = "shadow";

    $depends[OSP_BLB_ID . '_' . $propiety] = true;

    //ENCABEZADO DE SECCIÓN "Opciones Generales"
    $panel->createOption(array(
        'name' => __('Shadow', OSP_BLB_HANDLER),
        'type' => 'heading'
    ));

    //ACTIVAR SOMBRA
    $panel->createOption(array(
        'name' => __('Show Shadow', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety,
        'type' => 'enable',
        'desc' => __('Indicate if you want to show shading on the loading bar.', OSP_BLB_HANDLER),
        'default' => false,
        'enabled' => __('Show', OSP_BLB_HANDLER),
        'disabled' => __('Hide', OSP_BLB_HANDLER)
    ));


    //ENTORNO DE LA SOMBRA
    $panel->createOption(array(
        'name' => __("(Shadow) Scope", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Scope",
        'type' => 'enable',
        'desc' => __("Indicate the scope where you want to show shading. (<b>Outside:</b> Outside the container | <b>Inside:</b> Inside the container)", OSP_BLB_HANDLER),
        'default' => true,
        'enabled' => __('Outside', OSP_BLB_HANDLER),
        'disabled' => __('Inside', OSP_BLB_HANDLER),
        'depends' => $depends
    ));



    //COLOR DEL SOMBREADO
    $panel->createOption(array(
        'name' => __("(Shadow) Color", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Color",
        'type' => 'color',
        'desc' => __("Indicate the color of shading. (Default: #FF0000)", OSP_BLB_HANDLER),
        'default' => "#FF0000",
        'depends' => $depends
    ));

    //POSICIÓN X DE LA SOMBRA
    $panel->createOption(array(
        'name' => __("(Shadow) Position X", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "PosX",
        'type' => 'number',
        'desc' => __("Indicate the position on the X-axis of shading with respect to loading bar. (Default: 0px)", OSP_BLB_HANDLER),
        'default' => "0",
        'min' => "-200",
        "max" => "200",
        'depends' => $depends
    ));


    //POSICIÓN Y DE LA SOMBRA
    $panel->createOption(array(
        'name' => __("(Shadow) Position Y", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "PosY",
        'type' => 'number',
        'desc' => __("Indicate the position on the Y-axis of the shading with respect to the loading bar. (Default: 0px) ", OSP_BLB_HANDLER),
        'default' => "0",
        'min' => "-200",
        "max" => "200",
        'depends' => $depends
    ));


    //DIFUMINADO DE LA SOMBRA
    $panel->createOption(array(
        'name' => __("(Shadow) Blur", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Dith",
        'type' => 'number',
        'desc' => __("Indicate the rate used to blur the shading. (Default: 10px)", OSP_BLB_HANDLER),
        'default' => "5",
        'min' => "-200",
        "max" => "200",
        'depends' => $depends
    ));

    //RADIO DE EXPANSION DE LA SOMBRA
    $panel->createOption(array(
        'name' => __("(Shadow) Expansion ratio", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Spread",
        'type' => 'number',
        'desc' => __("Indicate the rate with which the shading expands. (Default: 10px)", OSP_BLB_HANDLER),
        'default' => "2",
        'min' => "-200",
        "max" => "200",
        'depends' => $depends
    ));

    //OPACIDAD DEL A SOMBRA
    $panel->createOption(array(
        'name' => __("(Shadow) Opacity", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Opacity",
        'type' => 'number',
        'desc' => __("Indicate the level of transparency of shading. (Default: 100)", OSP_BLB_HANDLER),
        'default' => "100",
        'min' => "0",
        "max" => "100",
        'depends' => $depends
    ));

    //GUARDAR DATOS
    osp_blb_options_save($panel);
}
