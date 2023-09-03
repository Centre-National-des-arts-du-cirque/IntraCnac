<?php

namespace App\Factory;

use App\Entity\Prestataire;
use App\Repository\PrestataireRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Prestataire>
 *
 * @method        Prestataire|Proxy                     create(array|callable $attributes = [])
 * @method static Prestataire|Proxy                     createOne(array $attributes = [])
 * @method static Prestataire|Proxy                     find(object|array|mixed $criteria)
 * @method static Prestataire|Proxy                     findOrCreate(array $attributes)
 * @method static Prestataire|Proxy                     first(string $sortedField = 'id')
 * @method static Prestataire|Proxy                     last(string $sortedField = 'id')
 * @method static Prestataire|Proxy                     random(array $attributes = [])
 * @method static Prestataire|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PrestataireRepository|RepositoryProxy repository()
 * @method static Prestataire[]|Proxy[]                 all()
 * @method static Prestataire[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Prestataire[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Prestataire[]|Proxy[]                 findBy(array $attributes)
 * @method static Prestataire[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Prestataire[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PrestataireFactory extends ModelFactory
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
            'email' => self::faker()->text(255),
            'lastname' => self::faker()->text(255),
            'name' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Prestataire $prestataire): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Prestataire::class;
    }
}
