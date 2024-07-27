<?php

namespace Hybrid\View;

use Hybrid\Container\Container;
use Hybrid\Core\ServiceProvider;
use Hybrid\View\Engines\EngineResolver;
use Hybrid\View\Engines\FileEngine;
use Hybrid\View\Engines\PhpEngine;

class Provider extends ServiceProvider {
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Register the view aliases in the container.
        $key     = 'view';
        $aliases = [ Factory::class, \Hybrid\Contracts\View\Factory::class ];
        foreach ( $aliases as $alias ) {
            $this->app->alias( $key, $alias );
        }

        $this->registerFactory();
        $this->registerViewFinder();
        $this->registerEngineResolver();
    }

    /**
     * Register the view environment.
     *
     * @return void
     */
    public function registerFactory() {
        $this->app->singleton( 'view', function ( $app ) {
            // Next we need to grab the engine resolver instance that will be used by the
            // environment. The resolver will be used by an environment to get each of
            // the various engine implementations such as plain PHP engine.
            $resolver = $app['view.engine.resolver'];

            $finder = $app['view.finder'];

            $factory = $this->createFactory( $resolver, $finder, $app['events'] );

            // We will also set the container instance on this view environment since the
            // view composers may be classes registered in the container, which allows
            // for great testable, flexible composers for the application developer.
            $factory->setContainer( $app );

            $factory->share( 'app', $app );

            return $factory;
        } );
    }

    /**
     * Create a new Factory Instance.
     *
     * @param \Hybrid\View\Engines\EngineResolver $resolver
     * @param \Hybrid\View\ViewFinderInterface $finder
     * @param \Hybrid\Contracts\Events\Dispatcher $events
     * @return \Hybrid\View\Factory
     */
    protected function createFactory( $resolver, $finder, $events ) {
        return new Factory( $resolver, $finder, $events );
    }

    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder() {
        $this->app->bind( 'view.finder', static fn( $app ) => new FileViewFinder( $app['files'], $app['config']['view.paths'] ?: [] ) );
    }

    /**
     * Register the engine resolver instance.
     *
     * @return void
     */
    public function registerEngineResolver() {
        $this->app->singleton( 'view.engine.resolver', function () {
            $resolver = new EngineResolver;

            // Next, we will register the various view engines with the resolver so that the
            // environment will resolve the engines needed for various views based on the
            // extension of view file. We call a method for each of the view's engines.
            foreach ( [ 'file', 'php' ] as $engine ) {
                $this->{'register' . ucfirst( $engine ) . 'Engine'}( $resolver );
            }

            return $resolver;
        } );
    }

    /**
     * Register the file engine implementation.
     *
     * @param \Hybrid\View\Engines\EngineResolver $resolver
     * @return void
     */
    public function registerFileEngine( $resolver ) {
        $resolver->register( 'file', static fn() => new FileEngine( Container::getInstance()->make( 'files' ) ) );
    }

    /**
     * Register the PHP engine implementation.
     *
     * @param \Hybrid\View\Engines\EngineResolver $resolver
     * @return void
     */
    public function registerPhpEngine( $resolver ) {
        $resolver->register( 'php', static fn() => new PhpEngine( Container::getInstance()->make( 'files' ) ) );
    }
}
