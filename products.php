<?php

/**
 * @link              #
 * @since             1.0.0
 * @package           Products
 *
 * @wordpress-plugin
 * Plugin Name:       Produtos
 * Plugin URI:        #
 * Description:       Plugin de criação de post produto - Plugin teste
 * Version:           1.0.0
 * Author:            Glaydson Rodrigues 
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       products
 * Domain Path:       /languages
 */


if (!defined( 'WPINC')) {
	die;
}

/**
 * Definir versão do plugin
 * Iniciar versão 1.0.0 e usar SemVer - https://semver.org
 */
define('PRODUCTS_VERSION', '1');

/**
 * Código executado durante a ativação do plugin
 */
function activate_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-activator.php';
	Products_Activator::activate();
}

/**
 * Código executado dureante a desativação do plugin
 */
function deactivate_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-deactivator.php';
	Products_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_products' );
register_deactivation_hook( __FILE__, 'deactivate_products' );

/**
* A classe principal que é usada para definir internacionalização,
 * hooks específicos do administrador, públicos e para REST API
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-products.php';

/**
 * Começa a execução do plugin.
 */
function run_products()
{
	$plugin = new Products();
	$plugin->run();
}
run_products();
