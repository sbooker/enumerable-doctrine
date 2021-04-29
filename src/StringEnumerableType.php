<?php

declare(strict_types=1);

namespace Sbooker\DoctrineEnumerableType;

use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class StringEnumerableType extends AbstractEnumerableType
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL(array_merge(['length' => 63], $column));
    }
}