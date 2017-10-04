<?php

namespace Copromatic\MailgunAdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mailgun_admin');
        $this->addOrmSection($rootNode);
        return $treeBuilder;
    }

    /**
     * Add ORM section to configuration tree
     *
     * @param ArrayNodeDefinition $node
     */
    private function addOrmSection(ArrayNodeDefinition $node) {
        $node
            ->children()
                ->scalarNode('entity_manager')->defaultValue('default')->end()
                ->scalarNode('api_key')->isRequired()->end()
            ->end()
        ->end();
    }

}