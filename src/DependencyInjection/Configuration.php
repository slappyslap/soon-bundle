<?php

namespace SoonBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder("soon_bundle");

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode("title")->defaultFalse()->end()
            ->scalarNode("logo")->defaultFalse()->end()
            ->scalarNode("background")->defaultFalse()->end()
            ->scalarNode("color")->defaultFalse()->end()
            ->scalarNode("description")->defaultFalse()->end()
            ->scalarNode("release_date")->defaultFalse()->end()
            ->arrayNode("exclude_ips")->scalarPrototype()->end()->end()
            ->arrayNode("exclude_routes")->scalarPrototype()->end()->end()
            ->arrayNode("socials")->arrayPrototype()
            ->children()
            ->scalarNode("link")->end()
            ->scalarNode("icon")->end()
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}