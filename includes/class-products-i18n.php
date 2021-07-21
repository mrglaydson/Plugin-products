<?php

/**
 * Defina a funcionalidade de internacionalização
 */

class Products_i18n {

	public function load_plugin_textdomain()
    {
		load_plugin_textdomain(
			'products',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

}
