<?php

add_action('admin_notices', 'osp_blb_settingsAndSupport');

/**
 * Realiza un registro transitorio indicando la activación del plugin
 *
 * @return	void
 * @since	1.0
 */
function osp_blb_justActivated() {
    delete_transient(OSP_BLB_HANDLER . '-activated');
    set_transient(OSP_BLB_HANDLER . '-activated', time(), 60);
}

/**
 * Elimina cualquier registro transitorio de activación
 *
 * @return	void
 * @since	1.0
 */
function osp_blb_justDeactivated() {
    delete_transient(OSP_BLB_HANDLER . '-activated');
}

/**
 * Imprime en pantalla un mensaje de bienvenida e indicaciones relevantes, dentro del tiempo indicando de activación
 *
 * @return	void
 * @since	1.0
 */
function osp_blb_settingsAndSupport() {

    if (!get_transient(OSP_BLB_HANDLER . '-activated')) {
        return;
    }

    echo '<div class="updated" style="border-left-color: #3498db">
				<p>
					<img src="' . plugins_url('images/ospisoft-logo.jpg', __FILE__) . '" style="display: block; margin-bottom: 10px"/>
					<strong>' . sprintf(__('Thank you for activating %s!', OSP_BLB_HANDLER), OSP_BLB_NAME) . '</strong><br>' .
    __('You can personalize and adjust the use of this plugin in', OSP_BLB_HANDLER) . ' <em><a href="' . admin_url('options-general.php?page=options-general.php-' . OSP_BLB_HANDLER) . '">' . __('Settings', OSP_BLB_HANDLER) . ' &gt; ' . OSP_BLB_NAME . '</a></em>.<br>' .
    __('If you need help or have any problem, please write us an e-mail ', OSP_BLB_HANDLER) . '<a href="mailto:ospisoft@gmail.com" target="_blank">ospisoft@gmail.com</a> ' . __('and we will be more than happy to clear up any problems you might have.', OSP_BLB_HANDLER) . '<br>' .
    '<a href="https://wordpress.org/plugins/border-loading-bar/" class="button button-default" style="margin: 10px 0;text-decoration:none;" target="_blank">' . __('Visit the plugin page', OSP_BLB_HANDLER) . '</a>' .
    '<br>' .
    '<em style="color: #999">' . __('Developed by: ', OSP_BLB_HANDLER) . OSP_BLB_AUTHOR . '</em><br>
				</p>
			</div>';
}

/**
 * Agrega un link de opciones al administrador del plugin en wordpress
 *
 * @param	array $links The current set of links
 * @since	1.0
 * */
function osp_blb_pluginSettingsLink($links) {
    $settings_link = '<a href="' . admin_url('options-general.php?page=options-general.php-' . OSP_BLB_HANDLER) . '">' . __('Settings', OSP_BLB_HANDLER) . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}

/**
 * Agrega un link de soporte en la referencias del plugin
 *
 * @param	array $links The current set of links
 * @since	1.0
 * */
function osp_blb_pluginLinks($plugin_meta, $plugin_file) {

    if ($plugin_file == OSP_BLB_BASE) {
        $plugin_meta[] = sprintf("<a href='%s' target='_blank'>%s</a>", "https://wordpress.org/plugins/border-loading-bar/", __("To receive personalized support", OSP_BLB_HANDLER));
    }
    return $plugin_meta;
}
