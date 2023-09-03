<?php

namespace App\Factory;

use App\Entity\ErrorType;
use App\Repository\ErrorTypeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ErrorType>
 *
 * @method        ErrorType|Proxy                     create(array|callable $attributes = [])
 * @method static ErrorType|Proxy                     createOne(array $attributes = [])
 * @method static ErrorType|Proxy                     find(object|array|mixed $criteria)
 * @method static ErrorType|Proxy                     findOrCreate(array $attributes)
 * @method static ErrorType|Proxy                     first(string $sortedField = 'id')
 * @method static ErrorType|Proxy                     last(string $sortedField = 'id')
 * @method static ErrorType|Proxy                     random(array $attributes = [])
 * @method static ErrorType|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ErrorTypeRepository|RepositoryProxy repository()
 * @method static ErrorType[]|Proxy[]                 all()
 * @method static ErrorType[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ErrorType[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ErrorType[]|Proxy[]                 findBy(array $attributes)
 * @method static ErrorType[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ErrorType[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ErrorTypeFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'lib' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ErrorType $errorType): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ErrorType::class;
    }
}
