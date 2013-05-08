<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DABSquared\MssqlBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Types\Type;

class DABSquaredMssqlBundle extends Bundle
{
    public function boot()
    {
        // Register custom data types
        if(!Type::hasType('uniqueidentifier')) {
            Type::addType('uniqueidentifier', 'DABSquared\MssqlBundle\Types\UniqueidentifierType');
        }

        if(Type::hasType('varbinary')) {
            Type::overrideType('varbinary', 'DABSquared\MssqlBundle\Types\VarBinaryType');
        } else {
            Type::addType('varbinary', 'DABSquared\MssqlBundle\Types\VarBinaryType');
        }

        Type::overrideType('date', 'DABSquared\MssqlBundle\Types\DateType');
        Type::overrideType('datetime', 'DABSquared\MssqlBundle\Types\DateTimeType');
    }
}
