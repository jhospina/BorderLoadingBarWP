<?php

//PROPIEDAD =>UBICACIONES

/**
 * Crea la sección de opciones para indicar en donde se debe mostrar la barra de progreso
 * @param TitanFramework->createAdminPanel $panel Objeto funcional del panel donde se debe crear las opciones.
 * @return	void
 * @since	1.0
 */

function osp_blb_options_locations($panel) {

    //ENCABEZADO DE SECCIÓN "¿DONDE QUIERES VISUALIZARLO?"
    $panel->createOption(array(
        'name' => __('Display Locations', OSP_BLB_HANDLER),
        'type' => 'heading'
    ));

    //PAGINAS
    $panel->createOption(array(
        'name' => __('Pages', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_locationPages',
        'type' => 'select',
        'desc' => __('Select the pages where you want the loading bar to appear.', OSP_BLB_HANDLER),
        'options' => array(
            'all' => __('All Pages', OSP_BLB_HANDLER),
            'homepage' => __('Homepage', OSP_BLB_HANDLER),
            'select' => __('Let me select the pages where to show it', OSP_BLB_HANDLER),
        ),
        'default' => 'all',
    ));

    //SELECCIONAR PAGINAS
    $panel->createOption(array(
        'name' => __('Select Pages', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_selectPages',
        'type' => 'multicheck-pages',
        'desc' => __('Select specifically the pages where you want to show the loading bar.', GAMBIT_LOADING_BAR),
        'depends' => array(
            OSP_BLB_ID . '_locationPages' => 'select',
        )
    ));



    //CATEGORIAS
    $panel->createOption(array(
        'name' => __('Posts Categories', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_locationCategories',
        'type' => 'select',
        'desc' => __('Select the posts categories where you want to show the loading bar.', OSP_BLB_HANDLER),
        'options' => array(
            'all' => __('All Categories', OSP_BLB_HANDLER),
            'select' => __('Let me select the categories where to show it', OSP_BLB_HANDLER),
        ),
        'default' => 'all',
    ));

    //SELECCIONAR CATEGORIAS
    $panel->createOption(array(
        'name' => __('Select Categories', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_selectCategories',
        'type' => 'multicheck-categories',
        'desc' => __('Select specifically the posts categories where you want to show the loading bar.', GAMBIT_LOADING_BAR),
        'depends' => array(
            OSP_BLB_ID . '_locationCategories' => 'select',
        )
    ));

    osp_blb_options_save($panel);
}
