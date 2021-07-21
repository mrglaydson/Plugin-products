<?php

/**
 * Adicionar funcionalidade ao publicas
 *
 * @package    Products
 * @subpackage Products/public
 */
class Products_Public {

    /**
     * Id do plugin
     */
	private $plugin_name;

    /**
     * Versão do plugin
     */
	private $version;

    /**
     * Inicializar a classe
     *
     * @param String $plugin_name
     * @param String $version
     */
	public function __construct($plugin_name, $version)
    {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Registre as folhas de estilo para o lado voltado para o público do site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
    {
		wp_enqueue_style($this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/products-public.css', array(), $this->version, 'all');
	}

	/**
     * Registrar javascript personalizado par o admin, caso seja necessario o uso
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
    {
		wp_enqueue_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/products-public.js', array('jquery'), $this->version, false);
	}

}
