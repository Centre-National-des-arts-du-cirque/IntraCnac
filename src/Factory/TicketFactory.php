<?php

namespace App\Factory;

use App\Entity\Ticket;
use App\Repository\TicketRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Ticket>
 *
 * @method        Ticket|Proxy                     create(array|callable $attributes = [])
 * @method static Ticket|Proxy                     createOne(array $attributes = [])
 * @method static Ticket|Proxy                     find(object|array|mixed $criteria)
 * @method static Ticket|Proxy                     findOrCreate(array $attributes)
 * @method static Ticket|Proxy                     first(string $sortedField = 'id')
 * @method static Ticket|Proxy                     last(string $sortedField = 'id')
 * @method static Ticket|Proxy                     random(array $attributes = [])
 * @method static Ticket|Proxy                     randomOrCreate(array $attributes = [])
 * @method static TicketRepository|RepositoryProxy repository()
 * @method static Ticket[]|Proxy[]                 all()
 * @method static Ticket[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Ticket[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Ticket[]|Proxy[]                 findBy(array $attributes)
 * @method static Ticket[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Ticket[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class TicketFactory extends ModelFactory
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
            'date' => self::faker()->dateTime(),
            'description' => self::faker()->text(255),
            'solved' => self::faker()->boolean(),
            'title' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Ticket $ticket): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Ticket::class;
    }
}
