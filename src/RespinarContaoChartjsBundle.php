<?php

declare(strict_types=1);

/*
 * This file is part of Contao Chart.js Bundle.
 *
 * (c) Hamid Peywasti 2023-2024 <hamid@respinar.com>
 *
 * @license MIT
 */

namespace Respinar\ContaoChartjsBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class RespinarContaoChartjsBundle extends AbstractBundle
{
    public function loadExtension(
        array $config, 
        ContainerConfigurator $containerConfigurator, 
        ContainerBuilder $containerBuilder,
    ): void
    {
        $containerConfigurator->import('../config/services.yaml');
    }
}
