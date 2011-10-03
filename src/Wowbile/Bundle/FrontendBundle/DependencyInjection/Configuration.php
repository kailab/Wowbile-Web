<?php

namespace Wowbile\Bundle\FrontendBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wowbile_frontend');

        $rootNode
            ->children()
                ->scalarNode('site_name')->defaultValue('wöwbile')->end()
                ->scalarNode('twitter')->defaultValue('wowbile')->end()
            ->end();

        return $treeBuilder;
    }
}
