# Hybrid\\View

Hybrid View is an add-on package for the [Hybrid Core](https://github.com/themehybrid/hybrid-core) WordPress framework. This file maintains the `View` class.  It's used for setting up and rendering theme template files. Views are a bit like a suped-up version of the core WordPress `get_template_part()` function. However, it allows you to build a hierarchy of potential templates as well as pass in any arbitrary data to your templates for use. Every effort has been made to make this compliant with WordPress.org theme directory guidelines by providing compatible action hooks with WordPress core `get_template_part()` and other `get_*()` functions for templates.

## Requirements

* WordPress 4.9+.
* PHP 5.6+ (preferably 7+).
* [Composer](https://getcomposer.org/) for managing PHP dependencies.

## Documentation

This project is a part of the Hybrid Core framework. It may require other packages, which will be installed via Composer.

### Installation

First, you'll need to open your command line tool and change directories to your theme folder.

```bash
cd path/to/wp-content/themes/<your-theme-name>
```

Then, use Composer to install the package.

```bash
composer require themehybrid/hybrid-view
```

### Register the service provider

You need to register the service provider during your bootstrapping process.  In your bootstrapping code, you should have something like the following:

```php
$theme = new \Hybrid\Core\Application();
```

After that point, you can register the service provider:

```php
$theme->provider( \Hybrid\View\ViewServiceProvider::class );
```

## Copyright and License

This project is licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 or later.

2008&thinsp;&ndash;&thinsp;2021 &copy; [Justin Tadlock](https://themehybrid.com).
