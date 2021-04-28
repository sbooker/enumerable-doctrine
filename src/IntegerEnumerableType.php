<?php

declare(strict_types=1);

namespace Sbooker\DoctrineEnumerableType;

use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class IntegerEnumerableType extends AbstractEnumerableType
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL(array_merge(['unsigned' => true], $fieldDeclaration));
    }
}