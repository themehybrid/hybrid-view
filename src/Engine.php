<?php
/**
 * Engine class.
 *
 * A wrapper around the `View` class with methods for quickly working with views
 * without having to manually instantiate a view object.  It's also useful
 * because it passes an `$engine` variable to all views.
 *
 * @package   HybridCore
 * @link      https://github.com/themehybrid/hybrid-view
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2021, Justin Tadlock
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\View;

use Hybrid\Proxies\App;
use Hybrid\Tools\Collection;
use Hybrid\View\Contracts\View;

/**
 * Engine class.
 *
 * @since  5.1.0
 *
 * @access public
 */
class Engine {

    /**
     * Returns a View object.
     *
     * @since  5.1.0
     * @param  string                         $name
     * @param  array|string                   $slugs
     * @param  array|\Hybrid\Tools\Collection $data
     * @return \Hybrid\View\Contracts\View
     *
     * @access public
     */
    public function view( $name, $slugs = [], $data = [] ) {

        if ( ! $data instanceof Collection ) {
            $data = new Collection( (array) $data );
        }

        // Pass the engine itself along so that it can be used directly
        // in views.
        $data->add( 'engine', $this );

        return App::resolve( View::class, compact( 'name', 'slugs', 'data' ) );
    }

    /**
     * Outputs a view template.
     *
     * @since  5.1.0
     * @param  string                         $name
     * @param  array|string                   $slugs
     * @param  array|\Hybrid\Tools\Collection $data
     * @return void
     *
     * @access public
     */
    public function display( $name, $slugs = [], $data = [] ) {
        $this->view( $name, $slugs, $data )->display();
    }

    /**
     * Returns a view template as a string.
     *
     * @since  5.1.0
     * @param  string                         $name
     * @param  array|string                   $slugs
     * @param  array|\Hybrid\Tools\Collection $data
     * @return string
     *
     * @access public
     */
    public function render( $name, $slugs = [], $data = [] ) {
        return $this->view( $name, $slugs, $data )->render();
    }

}
