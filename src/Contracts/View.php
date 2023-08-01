<?php
/**
 * View contract.
 *
 * View classes represent a template partial, generally speaking. Their purpose
 * should be to find a template file and render or display the output.
 *
 * @package   HybridCore
 * @link      https://themehybrid.com/hybrid-core
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2021, Justin Tadlock
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\View\Contracts;

use Hybrid\Contracts\Displayable;
use Hybrid\Contracts\Renderable;

/**
 * View interface.
 *
 * @since  1.0.0
 *
 * @access public
 */
interface View extends Renderable, Displayable {

    /**
     * Returns the array of slugs.
     *
     * @since  5.1.0
     * @return array
     *
     * @access public
     */
    public function slugs();

    /**
     * Returns the absolute path to the template file.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function template();

}
