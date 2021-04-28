<?php

declare(strict_types=1);

namespace Sbooker\DoctrineEnumerableType;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use LitGroup\Enumerable\Enumerable;

/**
 * @internal
 */
abstract class AbstractEnumerableType extends Type
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }
        /** @var Enumerable $class */
        $class = $this->getEnumClass();

        return $class::getValueOf($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }
        if (!$value instanceof Enumerable) {
            throw new \InvalidArgumentException('Value must be ' . Enumerable::class . ' type');
        }
        return $value->getRawValue();
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    abstract protected function getEnumClass(): string;
}
