<?php

declare(strict_types=1);

require_once 'Owner.php';
/**
 * Class House.
 * superficie, price,rooms, address, owner
 */
class House
{
    /** @var int Added taxes */
    const VAT = 20;

    /**
     * @var float the house's price
     */
    private float $price;

    /**
     * @var int number of rooms
     */
    private int $rooms;

    /**
     * @var string The house's postal address
     */
    private string $address;

    /** @var Owner The property owner */
    private Owner $owner;

    public function __construct(float $p, int $r, string $a, Owner $o)
    {
        $this->price = $p;
        $this->rooms = $r;
        $this->address = $a;
        $this->owner = $o;
        Owner::add($p);
    }

    /**
     * @return Owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }


}