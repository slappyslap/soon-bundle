<?php

namespace SoonBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SoonBundleExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        try {
            new \DateTimeImmutable($config['release_date']);
        } catch (\Exception) {
            $config['release_date'] = false;
        }

        $container->setParameter('soon.config.title', $config['title']);
        $container->setParameter('soon.config.logo', $config['logo']);
        $container->setParameter('soon.config.background', $config['background']);
        $container->setParameter('soon.config.color', $config['color']);
        $container->setParameter('soon.config.description', $config['description']);
        $container->setParameter('soon.config.release_date', $config['release_date']);
        $container->setParameter('soon.config.exclude_ips', $config['exclude_ips']);
        $container->setParameter('soon.config.exclude_routes', $config['exclude_routes']);
        $container->setParameter('soon.config.socials', $config['socials']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../config/'));
        $loader->load('service.yaml');
    }
}