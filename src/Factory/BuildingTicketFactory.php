<?php

namespace App\Factory;

use App\Entity\BuildingTicket;
use App\Repository\BuildingTicketRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<BuildingTicket>
 *
 * @method        BuildingTicket|Proxy                     create(array|callable $attributes = [])
 * @method static BuildingTicket|Proxy                     createOne(array $attributes = [])
 * @method static BuildingTicket|Proxy                     find(object|array|mixed $criteria)
 * @method static BuildingTicket|Proxy                     findOrCreate(array $attributes)
 * @method static BuildingTicket|Proxy                     first(string $sortedField = 'id')
 * @method static BuildingTicket|Proxy                     last(string $sortedField = 'id')
 * @method static BuildingTicket|Proxy                     random(array $attributes = [])
 * @method static BuildingTicket|Proxy                     randomOrCreate(array $attributes = [])
 * @method static BuildingTicketRepository|RepositoryProxy repository()
 * @method static BuildingTicket[]|Proxy[]                 all()
 * @method static BuildingTicket[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static BuildingTicket[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static BuildingTicket[]|Proxy[]                 findBy(array $attributes)
 * @method static BuildingTicket[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static BuildingTicket[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class BuildingTicketFactory extends ModelFactory
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
            'Localisation' => self::faker()->text(255),
            'site' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(BuildingTicket $buildingTicket): void {})
        ;
    }

    protected static function getClass(): string
    {
        return BuildingTicket::class;
    }
}
