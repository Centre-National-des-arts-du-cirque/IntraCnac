<?php

namespace App\Factory;

use App\Entity\VehicleTicket;
use App\Repository\VehicleTicketRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<VehicleTicket>
 *
 * @method        VehicleTicket|Proxy                     create(array|callable $attributes = [])
 * @method static VehicleTicket|Proxy                     createOne(array $attributes = [])
 * @method static VehicleTicket|Proxy                     find(object|array|mixed $criteria)
 * @method static VehicleTicket|Proxy                     findOrCreate(array $attributes)
 * @method static VehicleTicket|Proxy                     first(string $sortedField = 'id')
 * @method static VehicleTicket|Proxy                     last(string $sortedField = 'id')
 * @method static VehicleTicket|Proxy                     random(array $attributes = [])
 * @method static VehicleTicket|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VehicleTicketRepository|RepositoryProxy repository()
 * @method static VehicleTicket[]|Proxy[]                 all()
 * @method static VehicleTicket[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static VehicleTicket[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static VehicleTicket[]|Proxy[]                 findBy(array $attributes)
 * @method static VehicleTicket[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static VehicleTicket[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VehicleTicketFactory extends ModelFactory
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
            'Brand' => self::faker()->text(255),
            'immat' => self::faker()->text(10),
            'immatriculation' => self::faker()->text(10),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(VehicleTicket $vehicleTicket): void {})
        ;
    }

    protected static function getClass(): string
    {
        return VehicleTicket::class;
    }
}
