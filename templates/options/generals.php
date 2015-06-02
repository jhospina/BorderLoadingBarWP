<?php

//PROPIEDADES GENERALES

/**
 * Crea un sección de opciones generales para la barra de progreso
 * @param TitanFramework->createAdminPanel $panel Objeto funcional del panel donde se debe crear las opciones.
 * @param array $propierties Array con las propiedades y opciones necesarias para crear las opciones
 * @return	void
 * @since	1.0
 */
function osp_blb_options_generals($panel, $properties) {


    //ANIMACIÓN****************************************************************
    $propiety = "animation";
    if (array_key_exists($propiety, $properties)) {
        $panel->createOption(array(
            'name' => $properties[$propiety][0],
            'id' => OSP_BLB_ID . '_' . $propiety,
            'type' => 'select',
            'options' => array(
                '1' => __("FadeIn/FadeOut", OSP_BLB_HANDLER),
                '2' => __("Toggle", OSP_BLB_HANDLER)
            ),
            'desc' => $properties[$propiety][1],
            'default' => '1'
        ));
    }


    //POSICIÓN****************************************************************
    $propiety = "position";
    if (array_key_exists($propiety, $properties)) {
        $panel->createOption(array(
            'name' => $properties[$propiety][0],
            'id' => OSP_BLB_ID . '_' . $propiety,
            'type' => 'select',
            'options' => array(
                'top' => __("Top", OSP_BLB_HANDLER),
                'right' => __("Right", OSP_BLB_HANDLER),
                'bottom' => __("Bottom", OSP_BLB_HANDLER),
                'left' => __("Left", OSP_BLB_HANDLER)
            ),
            'desc' => $properties[$propiety][1],
            'default' => 'top'
        ));
    }
    //COLOR*******************************************************************
    $propiety = "color";
    if (array_key_exists($propiety, $properties)) {
        $panel->createOption(array(
            'name' => $properties[$propiety][0],
            'id' => OSP_BLB_ID . '_' . $propiety,
            'type' => 'color',
            'desc' => $properties[$propiety][1],
            'default' => "#FF0000"
        ));
    }
    //GROSOR*******************************************************************
    $propiety = "wide";
    if (array_key_exists($propiety, $properties)) {
        $panel->createOption(array(
            'name' => $properties[$propiety][0],
            'id' => OSP_BLB_ID . '_' . $propiety,
            'type' => 'number',
            'desc' => $properties[$propiety][1],
            'default' => '20',
            'min' => '1',
            'max' => '500'
        ));
    }

    //DIRECCIÓN****************************************************************
    $propiety = "direction";
    if (array_key_exists($propiety, $properties)) {
        $panel->createOption(array(
            'name' => $properties[$propiety][0],
            'id' => OSP_BLB_ID . '_' . $propiety,
            'type' => 'enable',
            'desc' => $properties[$propiety][1],
            'default' => true,
            'enabled' => __('Normal', OSP_BLB_HANDLER),
            'disabled' => __('Reverse', OSP_BLB_HANDLER)
        ));
    }
    

    //OPACIDAD****************************************************************
    $propiety = "opacity";
    if (array_key_exists($propiety, $properties)) {
        $panel->createOption(array(
            'name' => $properties[$propiety][0],
            'id' => OSP_BLB_ID . '_' . $propiety,
            'type' => 'number',
            'desc' => $properties[$propiety][1],
            'default' => "100",
            'min' => "0",
            'max' => "100",
        ));
    }


    //CSS PERSONALIZADO*****************************************************************
    $propiety = "customCSS";
    if (array_key_exists($propiety, $properties)) {
        $panel->createOption(array(
            'name' => $properties[$propiety][0],
            'id' => OSP_BLB_ID . '_' . $propiety,
            'type' => 'code',
            'desc' => $properties[$propiety][1],
            'lang' => 'css'
        ));
    }
    
    //GUARDAR DATOS
    osp_blb_options_save($panel);
}
