<?php

declare(strict_types=1);

class Book extends Article
{
    /** @var int  */
    private int $nbPages;

    public function __construct(string $t, string $c, int $n)
    {
        parent::__construct($t, $c);
        $this->nbPages = $n;
    }

    public function displayTitle()
    {
        echo \sprintf('This book titled with %s', parent::creaotr);
    }

    public function __toString(): string
    {
        return \sprintf(
          '%s. This book has %d pages',
            parent::__toString() ,
            $this->nbPages
        );
    }
}