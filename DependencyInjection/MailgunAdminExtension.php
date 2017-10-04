<?php

namespace Copromatic\MailgunAdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MailgunAdminExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
        $container->setAlias('mailgun_admin.entity_manager', 'doctrine.orm.'.$config['entity_manager'].'_entity_manager');

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('listener.yml');
        $loader->load('services.yml');

        $securityService = $container->getDefinition('mailgun_admin.security');
        $securityService->replaceArgument(0, $config['api_key']);
    }

    /**
     * {@inheritDoc}
     */
    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration();
    }
}
