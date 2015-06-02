<?php

/* PLANTILLAS DE OPCIONES */
require 'templates/options/generals.php';
require 'templates/options/shadow.php';
require 'templates/options/border.php';
require 'templates/options/font.php';
require 'templates/options/locations.php';
require 'templates/options/background.php';

add_action('tf_create_options', 'osp_blb_create_options');

/**
 * Inicializa y crear todas las opciones del plugin
 *
 * @return	void
 * @since	1.0
 */
function osp_blb_create_options() {

    $titan = TitanFramework::getInstance(OSP_BLB_NAME);
    $titan->set('css', false);

    //ENCABEZADO DE LA PAGINA
    $panel = $titan->createAdminPanel(array(
        'name' => __(OSP_BLB_NAME, OSP_BLB_HANDLER),
        'parent' => 'options-general.php',
        'desc' => __('Make all the settings to the appearance and functionality that you would like your personalize it to your taste ', OSP_BLB_HANDLER) . '"' . OSP_BLB_NAME . "'",
    ));


    //**************************************************************************
    //**SECCIÓN: OPCIONES GENERALES*********************************************
    //**************************************************************************
    //ENCABEZADO DE SECCIÓN "Opciones Generales"
    $panel->createOption(array(
        'name' => __('General Settings', OSP_BLB_HANDLER),
        'type' => 'heading'
    ));

    //ACTIVAR/DESACTICAR EL PLUGIN
    $panel->createOption(array(
        'name' => __('Enable - ', OSP_BLB_HANDLER) . OSP_BLB_NAME,
        'id' => 'enable',
        'type' => 'enable',
        'desc' => __('It permits you to activate or deactivate the appearance of the progress bar on the front-end of your website.', OSP_BLB_HANDLER),
        'default' => false,
        "enabled" => __("Enabled", OSP_BLB_HANDLER),
        "disabled" => __("Disabled", OSP_BLB_HANDLER)
    ));


    //MODO DE PRUEBA
    $panel->createOption(array(
        'name' => '<div class="dashicons dashicons-admin-tools"></div>' . __('Test Mode', OSP_BLB_HANDLER),
        'id' => 'testMode',
        'type' => 'enable',
        'desc' => __('It allows the test mode so that only the administrator can see the loading bar. This helps to observe the adjustments that the administrator is currently making with the plugin.', OSP_BLB_HANDLER),
        'default' => false,
        "enabled" => __("Enabled", OSP_BLB_HANDLER),
        "disabled" => __("Disabled", OSP_BLB_HANDLER)
    ));

    //NO OCULTAR LA BARRA DE PROGRESO
    $panel->createOption(array(
        'name' => '<div class="dashicons dashicons-admin-tools"></div>' . __('Don’t Hide Bar Loading', OSP_BLB_HANDLER),
        'id' => 'testMode_showBar',
        'type' => 'enable',
        'desc' => __('Keep the loading bar hidden until the page is 100% loaded. It is very useful in carrying out the necessary adjustments.', OSP_BLB_HANDLER),
        'default' => false,
        "enabled" => __("Enabled", OSP_BLB_HANDLER),
        "disabled" => __("Disabled", OSP_BLB_HANDLER),
        "depends" => array("testMode" => true)
    ));


    //GUARDAR DATOS
    osp_blb_options_save($panel);

    //**************************************************************************
    //**SECCIÓN: PROPIEDADES DE LA BARRA DE PROGRESO****************************
    //**************************************************************************
    //
    //ENCABEZADO DE SECCIÓN "PROPIEDADES DE LA BARRA DE PROGRESO"
    $panel->createOption(array(
        'name' => __('Properties of the Loading Bar', OSP_BLB_HANDLER),
        'type' => 'heading'
    ));

    //***PROPIEDADES BARRA DE PROGRESO - BORDE DE PANTALLA*********************
    $properties_generals = array("animation" => array(__('Animation', OSP_BLB_HANDLER), __('Indicate the type of animation using the loading bar that appears on the screen.', OSP_BLB_HANDLER)),
        "position" => array(__('Position', OSP_BLB_HANDLER), __('Select the location where the border for the loading bar will appear. (Default: Top', OSP_BLB_HANDLER)),
        "color" => array(__('Color', OSP_BLB_HANDLER), __('Select the color of the loading bar. (Default: #FF0000)', OSP_BLB_HANDLER)),
        "wide" => array(__('Wide', OSP_BLB_HANDLER), __('Indicate the thickness of the loading bar. (Default: 20px)', OSP_BLB_HANDLER)),
        "direction" => array(__('Direction', OSP_BLB_HANDLER), __('Indicate the filling direction of the loading bar. That is to say, from where to where should the bar move. (Default: Normal)', OSP_BLB_HANDLER)),
        "opacity" => array(__('Opacity', OSP_BLB_HANDLER), __('Indicate the level of transparency of the loading bar. (Default: 100)', OSP_BLB_HANDLER)));

    //Muestra las propieades del indicador
    osp_blb_options_generals($panel, $properties_generals);
    //PROPIEDADES (BORDE)
    osp_blb_options_border($panel);
    //PROPIEDADES (SOMBRA)
    osp_blb_options_shadow($panel);
    //FONDO DE LA BARRA DE PROGRESO
    osp_blb_options_background($panel);
    //PROPIEDADES (FUENTE)
    osp_blb_options_font($panel);



    //**************************************************************************
    //**SECCIÓN: UBICACIONES****************************************************
    //**************************************************************************
    //
   osp_blb_options_locations($panel);

    //ENCABEZADO DE SECCIÓN "CSS PERSONALIZADO"
    $panel->createOption(array(
        'name' => __('Custom CSS', OSP_BLB_HANDLER),
        'type' => 'heading'
    ));
    osp_blb_options_generals($panel, array("customCSS" => array(__('CSS Personalizado', OSP_BLB_HANDLER), __('If you want to custom "'.OSP_BLB_NAME.'" even more, you can write your own rules in the CSS. "'.OSP_BLB_NAME.'" the options under three main elements and they are the following:<br><ul>' .
                    '<li><code>#' . OSP_BLB_PREFIX . 'loading-bar</code> - This is the progress bar.</li>' .
                    '<li><code>#' . OSP_BLB_PREFIX . 'loading-bar-container</code> - This is the container that holds the progress bar.</li>' .
                    '<li><code>#' . OSP_BLB_PREFIX . 'text</code> - This is the container where the contents of the text described by the administrator writes.</li>' .
                    '</ul>', OSP_BLB_HANDLER))));
}

/**
 * Crea la opción predefinida para Guardar o restablecer los datos
 *
 * @return	void
 * @since	1.0
 */
function osp_blb_options_save($panel) {
    $panel->createOption(array(
        'type' => 'save',
        "save" => __("Save Changes", OSP_BLB_HANDLER),
        "reset" => __("Reset", OSP_BLB_HANDLER)
    ));
}
