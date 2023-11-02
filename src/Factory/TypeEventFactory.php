<?php

namespace App\Factory;

use App\Entity\TypeEvent;
use App\Repository\TypeEventRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<TypeEvent>
 *
 * @method        TypeEvent|Proxy create(array|callable $attributes = [])
 * @method static TypeEvent|Proxy createOne(array $attributes = [])
 * @method static TypeEvent|Proxy find(object|array|mixed $criteria)
 * @method static TypeEvent|Proxy findOrCreate(array $attributes)
 * @method static TypeEvent|Proxy first(string $sortedField = 'id')
 * @method static TypeEvent|Proxy last(string $sortedField = 'id')
 * @method static TypeEvent|Proxy random(array $attributes = [])
 * @method static TypeEvent|Proxy randomOrCreate(array $attributes = [])
 * @method static TypeEventRepository|RepositoryProxy repository()
 * @method static TypeEvent[]|Proxy[] all()
 * @method static TypeEvent[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static TypeEvent[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static TypeEvent[]|Proxy[] findBy(array $attributes)
 * @method static TypeEvent[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TypeEvent[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TypeEventFactory extends ModelFactory
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
            'CalendarColor' => self::faker()->hexColor(),
            'lib' => self::faker()->text(20),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(TypeEvent $typeEvent): void {})
        ;
    }

    protected static function getClass(): string
    {
        return TypeEvent::class;
    }
}
