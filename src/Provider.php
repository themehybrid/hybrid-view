<?php
/**
 * View service provider.
 *
 * This is the service provider for the view system. The primary purpose of
 * this is to use the container as a factory for creating views. By adding this
 * to the container, it also allows the view implementation to be overwritten.
 * That way, any custom functions will utilize the new class.
 *
 * @package   HybridCore
 * @link      https://themehybrid.com/hybrid-core
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2021, Justin Tadlock
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\View;

use Hybrid\Core\ServiceProvider;
use Hybrid\View\Contracts\Engine as EngineContract;
use Hybrid\View\Contracts\View as ViewContract;

/**
 * View provider class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds the implementation of the view contract to the container.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {

        // Bind the view contract.
        $this->app->bind( ViewContract::class, View::class );

        // Bind a single instance of the engine contract.
        $this->app->singleton( EngineContract::class, Engine::class );
    }

}
