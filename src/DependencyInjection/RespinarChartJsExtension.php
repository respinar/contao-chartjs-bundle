<?php

declare(strict_types=1);

/*
 * This file is part of Contao Chart.js.
 *
 * (c) Hamid Peywasti 2023 <hamid@respinar.com>
 *
 * @license MIT
 */

namespace Respinar\ChartJsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class RespinarChartJsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }
}
