<?php

/* Plugin Name: Border Loading Bar
  Description: This plugin displays on the edge of the screen a lively bar that tells the users the load progress of the page that they are viewing at the time, ideal for pages that have a large weight; for example containing many images and users must wait while it loads the entire content.
  Author: John H. Ospina - Ospisoft Inc.
  Version: 1.0
  Author URI: http://ospisoft.com
  Plugin URI: https://wordpress.org/plugins/border-loading-bar/
  Text Domain: border-loading-bar
  Domain Path: /languages
 */

//Evita las notificaciones de errores
error_reporting(0);

require 'config.php';
require 'titan-framework/titan-framework-embedder.php';
require 'utilities.php';
require 'templates/borderLoadingBar.php';
require 'options-management.php';
require 'admin-plugin.php';

//add_filter('plugin_row_meta', 'osp_blb_pluginLinks', 10, 2);
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'osp_blb_pluginSettingsLink');
register_activation_hook(__FILE__, "osp_blb_justActivated");
register_deactivation_hook(__FILE__, 'osp_blb_justDeactivated');

add_action('wp_enqueue_scripts', "osp_blb_init_scripts");
add_action('plugins_loaded', 'osp_blb_loadTextDomain');

/**
 * Carga las traducciones
 *
 * @return	void
 * @since	1.0
 */
function osp_blb_loadTextDomain() {
    load_plugin_textdomain(OSP_BLB_HANDLER, false, basename(dirname(__FILE__)) . '/languages/');
}

/**
 * Inicializa y agrega los enlaces del plugin.
 *
 * @return	void
 * @since	1.0
 */
function osp_blb_init_scripts() {

    $titan = TitanFramework::getInstance(OSP_BLB_HANDLER);

    //Evita el funcionamiento, si no se ha activado
    if (!$titan->getOption("enable"))
        return;

    //MODO DE PRUEBAS
    //Activa el modo de prueba, solo para el administrador
    if ($titan->getOption("testMode") && !current_user_can('activate_plugins'))
        return;

    //indica si se debe mostrar la barra de progreso en la pagina actual
    if (!osp_blb_validateLocation())
        return;

    //Imprime el CSS personalizado
    osp_blb_printCSS($titan->getOption(OSP_BLB_ID . "_customCSS"));

    //Carga la hoja de estilo para el tipo de indicador de progreso escogido
    wp_register_style(OSP_BLB_HANDLER . "-style", plugins_url('controller/css/' . OSP_BLB_HANDLER . '.css', __FILE__));
    wp_enqueue_style(OSP_BLB_HANDLER . "-style");

    //Carga el scripto para el tipo de indicador de progreso escogido
    wp_register_script(OSP_BLB_HANDLER . "-script-utilities", plugins_url('/js/utilities.js', __FILE__), array('jquery'));
    wp_enqueue_script(OSP_BLB_HANDLER . "-script-utilities");

    //Carga el scripto para el tipo de indicador de progreso escogido
    wp_register_script(OSP_BLB_HANDLER . "-script", plugins_url('controller/js/jquery.' . OSP_BLB_HANDLER . '.js', __FILE__), array('jquery'));
    wp_enqueue_script(OSP_BLB_HANDLER . "-script");


    osp_blb_create_script();

    //Inicializa el indicador seleccionado
    wp_register_script(OSP_BLB_HANDLER . "-controller-init", plugins_url('controller/initialize.js', __FILE__), array('jquery'));
    wp_enqueue_script(OSP_BLB_HANDLER . "-controller-init");
}

/**
 * Imprime el script que inicializa la barra de progreso en pantalla.
 *
 * @return	void
 * @since	1.0
 */
function osp_blb_create_script() {

    echo "<script>";
    echo "function osp_blb_init_loadingBar(){" . osp_blb_getScript() . "}";
    echo "var osp_blb_prefix='" . OSP_BLB_PREFIX . "';";
    echo "var osp_blb_content=\"" . osp_blb_borderLoadingBar() . "\";";
    //Carga el contenido determinado de carga
    echo "document.write(osp_blb_content);";

    echo "</script>";
}

/**
 * Imprime codigo CSS dentro las etiquetas <style></style>.
 *
 * @access	public
 * @param	String $css El codigo CSS
 * @return	void
 * @since	1.0
 * */
function osp_blb_printCSS($css) {
    echo "<style>" . $css . "</style>";
}

/**
 * Valida la ubicación actual, para evaluar si se debe mostrar la barra de progreso.
 *
 * @return	boolean
 * @since	1.0
 * */
function osp_blb_validateLocation() {

    $titan = TitanFramework::getInstance(OSP_BLB_HANDLER);

    $locationPages = $titan->getOption(OSP_BLB_ID . '_locationPages');
    $locationCategories = $titan->getOption(OSP_BLB_ID . '_locationCategories');

//VALIDACIÓN DE UBICACIONES DE PAGINA
    if (is_page() || is_home()) {
        $pages = $titan->getOption(OSP_BLB_ID . '_selectPages');

        //Todas las paginas
        if ($locationPages == "all")
            return true;

        //Pagina principal
        if ($locationPages == "homepage")
            if (is_home())
                return true;

        //Paginas seleccionadas especificamente
        if (in_array(get_the_ID(), $pages))
            return true;
    }

    if (is_single(get_the_ID())) {

        $categories = $titan->getOption(OSP_BLB_ID . '_selectCategories');

        //Todas las categorias
        if ($locationCategories == "all")
            return true;

        foreach ((get_the_category()) as $category) {
            //C seleccionadas especificamente
            if (in_array($category->cat_ID, $categories))
                return true;
        }
    }

    if ($locationPages == "all" && $locationCategories == "all")
        return true;


    if ($locationCategories == "all")
        return true;


    return false;
}
