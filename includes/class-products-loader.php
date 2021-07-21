<?php

/**
 * Registre todas as ações e filtros para o plugin
 *
 * @package Products
 * @subpackage Products/includes
 */
class Products_Loader {

	/**
	 * Registrar actions com o wordpress
     *
	 * @since    1.0.0
	 * @var array $actions
	 */
	protected $actions;

	/**
	 * Registrar filtros com o wordpress
	 *
	 * @since    1.0.0
     * @var array $filters
	 */
	protected $filters;

	/**
	 * Iniciar collections
	 *
	 * @since    1.0.0
	 */
	public function __construct()
    {
		$this->actions = array();
		$this->filters = array();
	}

	/**
	 * Adicionar uma nova ação à coleção a ser registrada no WordPress.
	 *
	 * @since 1.0.0
	 * @param string $hook
	 * @param object $component
	 * @param string $callback
	 * @param int $priority
	 * @param int $acceptedArgs
	 */
	public function add_action($hook, $component, $callback, $priority = 10, $acceptedArgs = 1)
    {
		$this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $acceptedArgs);
	}

	/**
     * Adicione um novo filtro à coleção para ser registrado no WordPress.
     *
     * @since 1.0.0
     * @param string $hook
     * @param object $component
     * @param string $callback
     * @param int $priority
     * @param int $acceptedArgs
	 */
	public function add_filter($hook, $component, $callback, $priority = 10, $acceptedArgs = 1)
    {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $acceptedArgs );
	}

	/**
	 * Uma função de utilidade que é usada para registrar as ações e hooks em uma única
     * coleção.
	 *
	 * @since    1.0.0
     * @param string $hook
     * @param object $component
     * @param string $callback
     * @param int $priority
     * @param int $acceptedArgs
	 */
	private function add($hooks, $hook, $component, $callback, $priority, $acceptedArgs)
    {
		$hooks[] = array(
			'hook' => $hook,
			'component' => $component,
			'callback' => $callback,
			'priority' => $priority,
			'accepted_args' => $acceptedArgs
		);

		return $hooks;
	}

	/**
	 * Registre os filtros e ações com o WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
    {
		foreach ($this->filters as $hook) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ($this->actions as $hook) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}
	}

}
