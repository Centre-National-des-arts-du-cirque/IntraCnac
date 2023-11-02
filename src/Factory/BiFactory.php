<?php

namespace App\Factory;

use App\Entity\Bi;
use App\Repository\BiRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Bi>
 *
 * @method        Bi|Proxy create(array|callable $attributes = [])
 * @method static Bi|Proxy createOne(array $attributes = [])
 * @method static Bi|Proxy find(object|array|mixed $criteria)
 * @method static Bi|Proxy findOrCreate(array $attributes)
 * @method static Bi|Proxy first(string $sortedField = 'id')
 * @method static Bi|Proxy last(string $sortedField = 'id')
 * @method static Bi|Proxy random(array $attributes = [])
 * @method static Bi|Proxy randomOrCreate(array $attributes = [])
 * @method static BiRepository|RepositoryProxy repository()
 * @method static Bi[]|Proxy[] all()
 * @method static Bi[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Bi[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Bi[]|Proxy[] findBy(array $attributes)
 * @method static Bi[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Bi[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class BiFactory extends ModelFactory
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
            'createAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'description' => self::faker()->text(1000),
            'title' => self::faker()->text(100),
            'updateAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'week' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Bi $bi): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Bi::class;
    }
}
