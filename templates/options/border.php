<?php

//PROPIEDAD =>BORDE

/**
 * Crea la sección de opciones para el borde de la barra de progreso
 * @param TitanFramework->createAdminPanel $panel Objeto funcional del panel donde se debe crear las opciones.
 * @return	void
 * @since	1.0
 */
function osp_blb_options_border($panel) {

    $propiety = "border";

    $depends[OSP_BLB_ID . '_' . $propiety] = true;

    //ENCABEZADO DE SECCIÓN "Opciones Generales"
    $panel->createOption(array(
        'name' => __('Border', OSP_BLB_HANDLER),
        'type' => 'heading'
    ));

    //ACTIVAR BORDE
    $panel->createOption(array(
        'name' => __('Show Border', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety,
        'type' => 'enable',
        'desc' => __('Indicate if you want to show the border that surrounds loading bar.', OSP_BLB_HANDLER),
        'default' => false,
        'enabled' => __('Show', OSP_BLB_HANDLER),
        'disabled' => __('Hide', OSP_BLB_HANDLER)
    ));

    //COLOR DEL BORDE
    $panel->createOption(array(
        'name' => __("(Border) Color", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Color",
        'type' => 'color',
        'desc' => __("Indicate the color of the borders. (Default: #000000)", OSP_BLB_HANDLER),
        'default' => "#000000",
        'depends' => $depends
    ));

    //ANCHO DEL BORDE
    $panel->createOption(array(
        'name' => __("(Border) Width", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Width",
        'type' => 'number',
        'desc' => __("Indicate the thickness of the borders. (Default:  1px)", OSP_BLB_HANDLER),
        'default' => "1",
        'min' => "0",
        "max" => "200",
        'depends' => $depends
    ));

    //VISUALIZACIÓN DE BORDES
    $panel->createOption(array(
        'name' => __("(Border) Visibility", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Visibility",
        'type' => 'multicheck',
        'desc' => __("Indicate specifically that the borders should be shown.", OSP_BLB_HANDLER),
        'options' => array(
            'top' => __("Top", OSP_BLB_HANDLER),
            'right' => __("Right", OSP_BLB_HANDLER),
            'bottom' => __("Bottom", OSP_BLB_HANDLER),
            'left' => __("Left", OSP_BLB_HANDLER)
        ),
        'default' => array('top', 'right', 'bottom', 'left'),
        'depends' => $depends
    ));

    //RADIO DE REDONDEO DEL BORDE
    $panel->createOption(array(
        'name' => __("(Border) Rounded", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Radius",
        'type' => 'number',
        'desc' => __("Indicate the radius of the rounded borders. (Default: 0px)", OSP_BLB_HANDLER),
        'default' => "0",
        'min' => "0",
        "max" => "100",
        'depends' => $depends
    ));

    //ESTILO DEL BODE
    $panel->createOption(array(
        'name' => __("(Border) Style", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Style",
        'type' => 'select',
        'desc' => __("Indicate the type of style of the borders. (Default: Solid)", OSP_BLB_HANDLER),
        'options' => array(
            'solid' => __("Solid", OSP_BLB_HANDLER),
            'dotted' => __("Dotted", OSP_BLB_HANDLER),
            'dashed' => __("Dashed", OSP_BLB_HANDLER),
            'double' => __("Double", OSP_BLB_HANDLER),
            'ridge' => __("Ridge", OSP_BLB_HANDLER),
            'inset' => __("Inset", OSP_BLB_HANDLER),
            'outset' => __("Outset", OSP_BLB_HANDLER),
        ),
        'default' => 'solid',
        'depends' => $depends
    ));


    //OPACIDAD DEL BORDE
    $panel->createOption(array(
        'name' => __("(Border) Opacity", OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Opacity",
        'type' => 'number',
        'desc' => __("Indicate the level of transparency of the borders. (Default: 100) ", OSP_BLB_HANDLER),
        'default' => "100",
        'min' => "0",
        "max" => "100",
        'depends' => $depends
    ));

    //GUARDAR DATOS
    osp_blb_options_save($panel);
}
