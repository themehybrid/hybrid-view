<?php

namespace Hybrid\View;

use Hybrid\Contracts\Arrayable;
use Hybrid\Contracts\View\View as ViewContract;

class MockView implements ViewContract {

    public function __construct( $view, $path, $data = [] ) {
        $this->view = $view;
        $this->path = $path;

        $this->data = $data instanceof Arrayable ? $data->toArray() : (array) $data;
    }

    public function name() {
        return $this->getName();
    }

    public function with( $key, $value = null ) {
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function getName() {
        return $this->view;
    }

    public function render() {
        return '';
    }

    public function display() {
        echo $this->render();
    }

    public function toHtml() {
        return $this->render();
    }

}
