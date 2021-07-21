<?php

/**
 * Adicionar funcionalidade ao administrador
 *
 * @package Products
 * @subpackage Products/admin
 */

class Products_Admin {

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
     * Registrar Custom Post Type Produtos
     *
     * @since    1.0.0
     */
    function register_custom_post_types()
    {
        $name = 'Produtos';
        $singularName = 'Produto';

        $labels = array(
            'name' => $name,
            'singular_name' => $singularName,
            'menu_name' => $name,
            'parent_item_colon' => 'Parent',
            'all_items' => "Todos os {$name}",
            'view_item' => "Visualizar {$singularName}",
            'add_new_item' => "Adicionar Novo {$singularName}",
            'add_new' => "Adicionar {$singularName}",
            'edit_item' => "Editar {$singularName}",
            'update_item' => "Atualizar {$singularName}",
            'search_items' => "Pesquisar {$singularName}",
            'not_found' => 'Registro não encontrado',
            'not_found_in_trash' => 'Nenhum registro encontrado na lixeira',
        );

        register_post_type( 'post_product',
            array(
                'menu_icon' => 'dashicons-cart',
                'labels' => $labels,
                'public' => true,
                'has_archive' => false,
                'supports'  => array('title', 'editor', 'thumbnail'),
            )
        );
    }

	/**
	 * Registrar página de estilo para admin, caso seja necessario o uso
	 *
	 * @since 1
	 */
	public function enqueue_styles()
    {
		wp_enqueue_style($this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/products-admin.css', array(), $this->version, 'all' );
	}

    /**
     * Registrar javascript personalizado par o admin, caso seja necessario o uso
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/products-admin.js', array( 'jquery' ), $this->version, false );
    }

}
