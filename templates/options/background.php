<?php

//PROPIEDAD =>FONDO

/**
 * Crea la sección de opciones para el fondo de la barra de progreso
 * @param TitanFramework-createAdminPanel $panel Objeto funcional del panel donde se debe crear las opciones.
 * @return	void
 * @since	1.0
 */
function osp_blb_options_background($panel) {

    //ENCABEZADO DE SECCIÓN "FONDO"
    $panel->createOption(array(
        'name' => __('Background', OSP_BLB_HANDLER),
        'type' => 'heading'
    ));

    $propiety = "background";

    //MOSTRAR FONDO
    $panel->createOption(array(
        'name' => __('Show Background', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety,
        'type' => 'enable',
        'desc' => __('Indicate if you want to show the background behind the loading bar.', OSP_BLB_HANDLER),
        'default' => true,
        'enabled' => __('Show', OSP_BLB_HANDLER),
        'disabled' => __('Hide', OSP_BLB_HANDLER)
    ));

    $propiety = "backgroundColor";
    $panel->createOption(array(
        'name' => __('(Background) Color', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety,
        'type' => 'color',
        'desc' => __('Indicate the background color of the container. (Default: #FFFFFF)', OSP_BLB_HANDLER),
        'default' => "#FFFFFF",
        'depends' => array(OSP_BLB_ID . '_background' => true)
    ));

    //GUARDAR LOS DATOS
    osp_blb_options_save($panel);
}

