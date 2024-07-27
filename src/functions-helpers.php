<?php
/**
 * View template tags.
 *
 * Template functions related to views.
 *
 * @package   HybridCore
 *
 * @link      https://themehybrid.com/hybrid-core
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2021, Justin Tadlock
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\View;

use Hybrid\Contracts\View\Factory as ViewFactory;
use function Hybrid\app;

if ( ! function_exists( __NAMESPACE__ . '\\view' ) ) {

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string|null $view
     * @param \Hybrid\Contracts\Arrayable|array $data
     * @param array $mergeData
     * @return ($view is null ? \Hybrid\Contracts\View\Factory : \Hybrid\Contracts\View\View)
     */
    function view( $view = null, $data = [], $mergeData = [] ) {
        $factory = app( ViewFactory::class );

        if ( func_num_args() === 0 ) {
            return $factory;
        }

        return $factory->make( $view, $data, $mergeData );
    }
}

if ( ! function_exists( __NAMESPACE__ . '\\display' ) ) {

    /**
     * Display the evaluated view contents for the given view.
     *
     * @param string|null $view
     * @param \Hybrid\Contracts\Arrayable|array $data
     * @param array $mergeData
     * @return \Hybrid\Contracts\View\View|\Hybrid\Contracts\View\Factory
     */
    function display( $view = null, $data = [], $mergeData = [] ) {
        view( $view, $data, $mergeData )->display();
    }
}

if ( ! function_exists( __NAMESPACE__ . '\\render' ) ) {

    /**
     * Return the evaluated view contents for the given view.
     *
     * @param string|null $view
     * @param \Hybrid\Contracts\Arrayable|array $data
     * @param array $mergeData
     * @return \Hybrid\Contracts\View\View|\Hybrid\Contracts\View\Factory
     */
    function render( $view = null, $data = [], $mergeData = [] ) {
        return view( $view, $data, $mergeData )->render();
    }
}
