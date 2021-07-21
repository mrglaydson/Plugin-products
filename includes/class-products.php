<?php

/**
 * Class principal do plugin
 *
 * @since 1
 * @package Products
 * @subpackage Products/includes
 * @author Glaydson Rodrigues  <glaydson012@gmail.com>
 */
class Products {

    /**
     * ID do plugin
     */
	protected $loader;

	/**
	 * ID do plugin
	 */
	protected $plugin_name;

    /**
     * Versão do plugin
     */
	protected $version;

    /**
     * Inicializar a classe e setar as dependencias
     *
     */
	public function __construct()
    {
        $this->version = '1';

		if (defined( 'PRODUCTS_VERSION')) {
			$this->version = PRODUCTS_VERSION;
		}

		$this->plugin_name = 'products';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_api_rest_hooks();
	}

	/**
	 * Carregar dependencias
	 *
	 * - Products_Loader. Registrar todos os hooks
	 * - Products_i18n. Define a funcionalidade de internacionalização.
	 * - Products_Admin. Registrar todos os hooks na area do admin
	 * - Products_Public. Registrar todos os hooks na area do admin
     * - Products_Rest. Registrar todos os hooks no WP API REST
	 *
	 * @since 1
	 */
	private function load_dependencies()
    {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-products-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-products-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-products-admin.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-products-public.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'rest/class-products-rest.php';

		$this->loader = new Products_Loader();
	}

	/**
	 * Defina o local para este plugin para internacionalização.
	 *
	 * @since 1
	 */
	private function set_locale()
    {
		$plugin_i18n = new Products_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Registrar todos os hooks relacionados à funcionalidade da área do admin
	 *
	 * @since 1
	 */
	private function define_admin_hooks()
    {
		$plugin_admin = new Products_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'init', $plugin_admin, 'register_custom_post_types' );

	}

    /**
     * Registrar os hooks API REST
     *
     * @since 1
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new Products_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
    }


	/**
	 * Registrar todos os hooks públicos
	 *
	 * @since 1
	 * @access   private
	 */
	private function define_api_rest_hooks()
    {
		$plugin_public = new Products_Rest($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action( 'rest_api_init', $plugin_public, 'add_routs_products' );

	}

	/**
	 * Executar
	 *
	 * @since 1
	 */
	public function run()
    {
		$this->loader->run();
	}

	/**
	 * Recuperar nome (ID) do plugin
	 *
	 * @since 1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
    {
		return $this->plugin_name;
	}

	/**
	 * Organização dos hooks do plugin
	 *
     * @since 1.0.0
	 */
	public function get_loader()
    {
		return $this->loader;
	}

	/**
	 * Recuperar a versão atual do plugin
	 *
     * @since 1.0.0
	 */
	public function get_version()
    {
		return $this->version;
	}

}
