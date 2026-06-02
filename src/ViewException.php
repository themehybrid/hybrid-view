<?php

namespace Hybrid\View;

use ErrorException;
use Hybrid\Container\Container;
use Hybrid\Tools\Reflection\Reflector;

class ViewException extends ErrorException {
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report() {
        $exception = $this->getPrevious();

        if ( Reflector::isCallable( $reportCallable = [ $exception, 'report' ] ) ) {
            return Container::getInstance()->call( $reportCallable );
        }

        return false;
    }

    /**
     * Render the exception into a response.
     *
     * @return mixed
     */
    public function render() {
        $exception = $this->getPrevious();

        if ( $exception && method_exists( $exception, 'render' ) ) {
            return $exception->render();
        }
    }
}
