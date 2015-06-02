<?php

//PROPIEDAD =>FUENTE

/**
 * Crea la sección de opciones para el texto a mostrar de la barra de progreso
 * @param TitanFramework->createAdminPanel $panel Objeto funcional del panel donde se debe crear las opciones.
 * @return	void
 * @since	1.0
 */
function osp_blb_options_font($panel) {

    $propiety = "font";

    $depends[OSP_BLB_ID . '_' . $propiety] = true;

    //ENCABEZADO DE SECCIÓN "TEXTO"
    $panel->createOption(array(
        'name' => __('Text', OSP_BLB_HANDLER),
        'type' => 'heading'
    ));

    //ACTIVAR ETIQUETA DE PROGRESO
    $panel->createOption(array(
        'name' => __('Show Text', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety,
        'type' => 'enable',
        'desc' => __('Indicate if you want a descriptive text inside the loading bar.', OSP_BLB_HANDLER),
        'default' => true,
        'enabled' => __('Show', OSP_BLB_HANDLER),
        'disabled' => __('Hide', OSP_BLB_HANDLER)
    ));

    //APARIENCIA DE LA FUENTE
    $panel->createOption(array(
        'name' => __('(Texto) Appearance', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Style",
        'type' => 'font',
        // 'show_google_fonts' => false,
        'desc' => __('Select the style that you want for the font of the text. We recommend that you choose <strong>(Web Safe Fonts)</strong> so that the load bar will be faster. The use of fonts from "Google WebFonts" may slow the display of the load bar, so that it will have to be loaded in advance.', OSP_BLB_HANDLER),
        'preview_text' => __('0% 20% 40% 60% 80% 100% | Loading Page', OSP_BLB_HANDLER),
        'show_text_transform' => false,
        'show_font_variant' => false,
        'default' => array(
            'font-family' => 'Arial',
            'color' => '#000000',
            'font-size' => '15px',
            'font-weight' => 'bold',
            'line-height' => '1em',
        ),
        'depends' => $depends
    ));

    //ALINEACIÓN HORIZONTAL
    $panel->createOption(array(
        "name" => __('(Text) Horizontal Alignment', OSP_BLB_HANDLER),
        "id" => OSP_BLB_ID . '_' . $propiety . "AlignH",
        "type" => "select",
        'options' => array(
            'center' => __("Center", OSP_BLB_HANDLER),
            'left' => __("Left", OSP_BLB_HANDLER),
            'right' => __("Right", OSP_BLB_HANDLER)
        ),
        "desc" => __('Indicate the alignment of text horizontally. (Default: Center)', OSP_BLB_HANDLER),
        "default" => "center",
        'depends' => $depends
    ));


    //ALINEACIÓN VERTICAL
    $panel->createOption(array(
        "name" => __('(Text) Vertical Alignment', OSP_BLB_HANDLER),
        "id" => OSP_BLB_ID . '_' . $propiety . "AlignV",
        "type" => "select",
        'options' => array(
            'middle' => __("Middle", OSP_BLB_HANDLER),
            'top' => __("Top", OSP_BLB_HANDLER),
            'bottom' => __("Bottom", OSP_BLB_HANDLER)
        ),
        "desc" => __('Indicate the alignment of the text vertically. (Default:Middle)', OSP_BLB_HANDLER),
        "default" => "middle",
        'depends' => $depends
    ));

    //ORIENTACIÓN DEL TEXTO
    $panel->createOption(array(
        'name' => __('(Text) Rotation', OSP_BLB_HANDLER),
        'id' => OSP_BLB_ID . '_' . $propiety . "Orient",
        'type' => 'number',
        'desc' => __('Rotates text orientation, measured in degrees of angle. (Default:0)</br><strong>Warning:</strong>This attribute is only compatible with modern browsers.', OSP_BLB_HANDLER),
        'default' => '0',
        'min' => '0',
        'max' => '360',
        'step' => '10',
        'depends' => $depends
    ));


    //TEXTO A MOSTRAR
    $panel->createOption(array(
        "name" => __('(Text) Content', OSP_BLB_HANDLER),
        "id" => OSP_BLB_ID . '_' . $propiety . "Text",
        "type" => "text",
        "desc" => __('Write the text contents that you want to show in the loading bar. There are special  tags that you can use.<ul><li><code>{title}</code> - This tag writes the title of the entry or page that is loading at that moment.</li><li><code>{progress}</code> - This tag writes the progress loading of the current page in percentage units. </li><li><code>{username}</code> - This tag writes the username that is loading the page.  The user should have logged in, or on the other hand it show the word "Visitor".</li></ul>', OSP_BLB_HANDLER),
        "default" => "{progress}%",
        'depends' => $depends
    ));
    
    //GUARDAR DATOS
    osp_blb_options_save($panel);
}
