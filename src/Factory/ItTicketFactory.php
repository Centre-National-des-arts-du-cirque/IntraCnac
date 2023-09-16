<?php

namespace App\Factory;

use App\Entity\ItTicket;
use App\Repository\ItTicketRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ItTicket>
 *
 * @method        ItTicket|Proxy                     create(array|callable $attributes = [])
 * @method static ItTicket|Proxy                     createOne(array $attributes = [])
 * @method static ItTicket|Proxy                     find(object|array|mixed $criteria)
 * @method static ItTicket|Proxy                     findOrCreate(array $attributes)
 * @method static ItTicket|Proxy                     first(string $sortedField = 'id')
 * @method static ItTicket|Proxy                     last(string $sortedField = 'id')
 * @method static ItTicket|Proxy                     random(array $attributes = [])
 * @method static ItTicket|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ItTicketRepository|RepositoryProxy repository()
 * @method static ItTicket[]|Proxy[]                 all()
 * @method static ItTicket[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ItTicket[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ItTicket[]|Proxy[]                 findBy(array $attributes)
 * @method static ItTicket[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ItTicket[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ItTicketFactory extends ModelFactory
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
            'pcName' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ItTicket $itTicket): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ItTicket::class;
    }
}
