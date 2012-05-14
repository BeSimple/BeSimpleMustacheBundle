MustacheBundle, using Mustache in Symfony2
==========================================

## Information

You can use multiple templating engine in Symfony2.
This bundle enables the possibility to use Mustache template for your Symfony2 project.

## Installation

### Add BeSimpleMustacheBundle and Mustache PHP to your vendor/bundles dir

**Using the vendors script**

Add the following lines in your `deps` file:

``` ini
; deps

[BeSimpleMustacheBundle]
    git=https://github.com/BeSimple/BeSimpleMustacheBundle.git
    target=bundles/BeSimple/Bundle/MustacheBundle

[mustache-php]
    git=https://github.com/bobthecow/mustache.php.git
    target=mustache-php
    version=v1.1.0
```

Now, run the vendors script to download the bundle:

``` bash
$ php bin/vendors install
```

**Using submodules**

If you prefer instead to use git submodules, the run the following:

``` bash
$ git submodule add https://github.com/BeSimple/BeSimpleMustacheBundle.git vendor/bundles/BeSimple/Bundle/MustacheBundle
$ git submodule add git submodule add https://github.com/bobthecow/mustache.php.git vendor/mustache-php v1.1.0
$ git submodule update --init
```

### Add BeSimpleMustacheBundle to your application kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        // ...
        new BeSimple\Bundle\MustacheBundle\BeSimpleMustacheBundle(),
        // ...
    );
}
```

### Register the BeSimple namespace and Mustache prefix

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    'BeSimple\\Bundle' => __DIR__.'/../vendor/bundles',
    // your other namespaces
));

$loader->registerPrefixes(array(
    'Mustache' => __DIR__.'/../vendor/mustache-php',
    // your other prefixes
));
```

### Update your configuration

Added mustache engine for framework templating:

``` yaml
# app/config/config.yml

framework:
    templating: { engines: ['twig', 'mustache'] }
```

## HowTo use

### With an Action

``` php
<?php
// src/Your/Bundle/ProjectBundle/Controller/DefaultController.php

namespace Your\Bundle\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('YourProjectBundle:Default:index.html.mustache', array(
            'name' => 'Mustache!',
        ));
    }
}
```

### With Twig

``` twig
{% include 'YourProjectBundle:Default:index.html.mustache' with {
    'name': 'Mustache!'
} %}
```
