<?php

declare(strict_types=1);

/*
 * This file is part of Oveleon page duplicate bundle.
 *
 * (c) https://www.oveleon.de/
 */

namespace Oveleon\ContaoPageDuplicateBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Oveleon\ContaoPageDuplicateBundle\ContaoPageDuplicateBundle;

/**
 * @internal
 */
class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoPageDuplicateBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['page-duplicate']),
        ];
    }
}
