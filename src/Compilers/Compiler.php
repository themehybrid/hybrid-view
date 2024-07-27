<?php

namespace Hybrid\View\Compilers;

use Hybrid\Filesystem\Filesystem;
use Hybrid\Tools\Str;

abstract class Compiler {
    /**
     * The filesystem instance.
     *
     * @var \Hybrid\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The cache path for the compiled views.
     *
     * @var string
     */
    protected $cachePath;

    /**
     * The base path that should be removed from paths before hashing.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Determines if compiled views should be cached.
     *
     * @var bool
     */
    protected $shouldCache;

    /**
     * The compiled view file extension.
     *
     * @var string
     */
    protected $compiledExtension = 'php';

    /**
     * Create a new compiler instance.
     *
     * @param \Hybrid\Filesystem\Filesystem $files
     * @param string $cachePath
     * @param string $basePath
     * @param bool $shouldCache
     * @param string $compiledExtension
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(
        Filesystem $files,
        $cachePath,
        $basePath = '',
        $shouldCache = true,
        $compiledExtension = 'php'
    ) {
        if ( ! $cachePath ) {
            throw new \InvalidArgumentException( 'Please provide a valid cache path.' );
        }

        $this->files             = $files;
        $this->cachePath         = $cachePath;
        $this->basePath          = $basePath;
        $this->shouldCache       = $shouldCache;
        $this->compiledExtension = $compiledExtension;
    }

    /**
     * Get the path to the compiled version of a view.
     *
     * @param string $path
     * @return string
     */
    public function getCompiledPath( $path ) {
        // Note: Downgraded it to ensure PHP 8.0 compatibility,
        // as the `xxh128` algo is available in versions >=8.1.
        // Thus, utilizing `md5` instead.
        // @see https://www.php.net/manual/en/function.hash-algos.php
        // @see https://github.com/laravel/framework/discussions/46074
        // @see \Rector\Tests\DowngradePhp81\Rector\FuncCall\DowngradeHashAlgorithmXxHash\DowngradeHashAlgorithmXxHashRectorTest
        return $this->cachePath . '/' . hash( 'md5', 'v2' . Str::after( $path, $this->basePath ) ) . '.' . $this->compiledExtension;
    }

    /**
     * Determine if the view at the given path is expired.
     *
     * @param string $path
     * @return bool
     *
     * @throws \ErrorException
     */
    public function isExpired( $path ) {
        if ( ! $this->shouldCache ) {
            return true;
        }

        $compiled = $this->getCompiledPath( $path );

        // If the compiled file doesn't exist we will indicate that the view is expired
        // so that it can be re-compiled. Else, we will verify the last modification
        // of the views is less than the modification times of the compiled views.
        if ( ! $this->files->exists( $compiled ) ) {
            return true;
        }

        try {
            return $this->files->lastModified( $path ) >= $this->files->lastModified( $compiled );
        } catch ( \ErrorException $exception ) {
            if ( ! $this->files->exists( $compiled ) ) {
                return true;
            }

            throw $exception;
        }
    }

    /**
     * Create the compiled file directory if necessary.
     *
     * @param string $path
     * @return void
     */
    protected function ensureCompiledDirectoryExists( $path ) {
        if ( ! $this->files->exists( dirname( $path ) ) ) {
            $this->files->makeDirectory( dirname( $path ), 0777, true, true );
        }
    }
}
