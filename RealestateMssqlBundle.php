<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Realestate\MssqlBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RealestateMssqlBundle extends Bundle
{
    public function boot()
    {
        // Register custom data types
        \Doctrine\DBAL\Types\Type::addType('uniqueidentifier', 'Realestate\MssqlBundle\Types\UniqueidentifierType');
        \Doctrine\DBAL\Types\Type::overrideType('datetime', 'Realestate\MssqlBundle\Types\DateTimeType');
    }
}