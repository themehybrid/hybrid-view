<?php
/**
 * View template tags.
 *
 * Template functions related to views.
 *
 * @package   HybridCore
 * @link      https://themehybrid.com/hybrid-core
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2021, Justin Tadlock
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\View;

use Hybrid\Proxies\App;
use Hybrid\View\Contracts\Engine;

if ( ! function_exists( __NAMESPACE__ . '\\view' ) ) {
    /**
     * Returns a view object.
     *
     * @since  1.0.0
     * @param  string                        $name
     * @param  array|string                  $slugs
     * @param  array|\Hybrid\View\Collection $data
     * @return \Hybrid\View\View
     *
     * @access public
     */
    function view( $name, $slugs = [], $data = [] ) {
        return App::resolve( Engine::class )->view( $name, $slugs, $data );
    }
}

if ( ! function_exists( __NAMESPACE__ . '\\display' ) ) {
    /**
     * Outputs a view template.
     *
     * @since  1.0.0
     * @param  string                        $name
     * @param  array|string                  $slugs
     * @param  array|\Hybrid\View\Collection $data
     * @return void
     *
     * @access public
     */
    function display( $name, $slugs = [], $data = [] ) {
        view( $name, $slugs, $data )->display();
    }
}

if ( ! function_exists( __NAMESPACE__ . '\\render' ) ) {
    /**
     * Returns a view template as a string.
     *
     * @since  1.0.0
     * @param  string                        $name
     * @param  array|string                  $slugs
     * @param  array|\Hybrid\View\Collection $data
     * @return string
     *
     * @access public
     */
    function render( $name, $slugs = [], $data = [] ) {
        return view( $name, $slugs, $data )->render();
    }
}
