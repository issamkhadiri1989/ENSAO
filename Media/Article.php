<?php

declare(strict_types=1);

class Article
{
    /** @var string */
    protected string $title;

    /** @var string  */
    private string $creator;

    public function __construct(string $t, string $c)
    {
        $this->title = $t;
        $this->creator = $c;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCreator(): string
    {
        return $this->creator;
    }

    /**
     * @param string $creator
     */
    public function setCreator(string $creator)
    {
        $this->creator = $creator;
    }

    public function __toString(): string
    {
        return \sprintf(
            'Article created by "%s" with title "%s"',
            $this->creator,
            $this->title
        );
    }
}
