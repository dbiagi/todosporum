<?php

namespace DBiagi\UploadBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class DBiagiUploadExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');        
    }

    public function prepend(ContainerBuilder $container) {       
        $configPath = (new FileLocator(__DIR__ . '/../Resources/config'))->locate('config.yml');
        $configs = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($configPath));
        $container->prependExtensionConfig('vich_uploader', $configs['vich_uploader']);
    }

}
