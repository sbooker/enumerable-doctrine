# sbooker/enumerable-doctrine

[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![PHP Version][badge-php]][php]
[![Total Downloads][badge-downloads]][downloads]

The sbooker/enumerable-doctrine package provides the ability to use
[litgroup-enumerable][litgroup-enumerable] as a [Doctrine field type][doctrine-field-type].

## Installation

The preferred method of installation is via [Packagist][] and [Composer][]. Run
the following command to install the package and add it as a requirement to
your project's `composer.json`:

```bash
composer require sbooker/enumerable-doctrine
```

## Examples

### Declare Enum and Doctrine type
```php
class ConcreteEnum extends \LitGroup\Enumerable\Enumerable 
{
    // See LitGroup/enumerable
}

class ConcreteEnumType extends \Sbooker\DoctrineEnumerableType\EnumerableType
{
    protected function getEnumClass() : string {
        return ConcreteEnum::class;
    }

    public function getName() {
        return 'concrete_enum';
    }
}
```

### Configuration
To configure Doctrine to use ramsey/uuid as a field type, you'll need to set up
the following in your bootstrap:

``` php
\Doctrine\DBAL\Types\Type::addType('concrete_enum', ConcreteEnumType::class);
```

In Symfony:

``` yaml
doctrine:
    dbal:
        types:
            concrete_enum: ConcreteEnumType
```

### Usage
Then, in your models, you may annotate properties by setting the `@Column`
type to `concrete_enum`.

``` php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="foo")
 */
class Foo
{
    /**
     * @var ConcreteEnum
     *
     * @ORM\Column(type="concrete_enum")
     */
    protected $enum;
}
```

If you use the XML Mapping instead of PHP annotations.

``` xml
<field name="enum" type="concrete_enum"/>
```

### More Information
For more information on getting started with Doctrine, check out the "[Getting
Started with Doctrine][doctrine-getting-started]" tutorial.

## License
See [LICENSE][license] file.

[badge-release]: https://img.shields.io/packagist/v/sbooker/enumerable-doctrine.svg?style=flat-square
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[badge-php]: https://img.shields.io/packagist/php-v/sbooker/enumerable-doctrine.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/sbooker/enumerable-doctrine.svg?style=flat-square

[release]: https://img.shields.io/packagist/v/sbooker/enumerable-doctrine
[license]: https://github.com/sbooker/enumerable-doctrine/blob/master/LICENSE
[php]: https://php.net
[downloads]: https://packagist.org/packages/sbooker/enumerable-doctrine

[litgroup-enumerable]: https://github.com/LitGroup/enumerable.php
[doctrine-field-type]: https://www.doctrine-project.org/projects/doctrine-dbal/en/2.10/reference/types.html
[packagist]: https://packagist.org/packages/ramsey/uuid-doctrine
[composer]: http://getcomposer.org/
[doctrine-getting-started]: https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html

