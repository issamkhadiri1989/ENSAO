<?php

declare(strict_types=1);

class Owner
{
    /** @var float Total CA */
    private static float $sum = 0;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $n)
    {
        $this->name = $n;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public static function add(float $s): void
    {
        Owner::$sum += $s;
    }

    public static function getSum(): float
    {
        return Owner::$sum;
    }


}