<?php

namespace BeSimple\Bundle\MustacheBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class BeSimpleMustacheExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('mustache.xml');

        if (in_array('AsseticBundle', array_keys($container->getParameter('kernel.bundles')))) {
            $loader->load('assetic.xml');
        }
    }
}
