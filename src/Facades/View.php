<?php

namespace Hybrid\View\Facades;

use Hybrid\Core\Facades\Facade;

/**
 * @see \Hybrid\View\Factory
 *
 * @method static \Hybrid\Contracts\View\Factory addNamespace(string $namespace, string|array $hints)
 * @method static \Hybrid\Contracts\View\View first(array $views, \Hybrid\Contracts\Arrayable|array $data = [], array $mergeData = [])
 * @method static \Hybrid\Contracts\View\Factory replaceNamespace(string $namespace, string|array $hints)
 * @method static \Hybrid\Contracts\View\Factory addExtension(string $extension, string $engine, \Closure|null $resolver = null)
 * @method static \Hybrid\Contracts\View\View file(string $path, array $data = [], array $mergeData = [])
 * @method static \Hybrid\Contracts\View\View make(string $view, array $data = [], array $mergeData = [])
 * @method static array composer(array|string $views, \Closure|string $callback)
 * @method static array creator(array|string $views, \Closure|string $callback)
 * @method static bool exists(string $view)
 * @method static mixed share(array|string $key, $value = null)
 * @method static mixed shared(string $key, $default = null)
 */
class View extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'view';
    }

}
