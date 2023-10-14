<?php

declare(strict_types=1);

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\ChartJsBundle\Tests;

use Contao\ChartJsBundle\ContaoSkeletonBundle;
use PHPUnit\Framework\TestCase;

class ContaoSkeletonBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new ContaoSkeletonBundle();

        $this->assertInstanceOf('Contao\ChartJsBundle\ContaoSkeletonBundle', $bundle);
    }
}
