<?php

declare(strict_types=1);

class Video extends Article
{
    /** @var string  */
    private string $type;

    /** @var int  */
    private int $duration;

    /** @var string  */
    private string $quality;

    /**
     * Video constructor.
     * @param string $type
     * @param int $duration
     * @param string $quality
     */
    public function __construct(
        string $title,
        string $creator,
        string $type,
        int $duration,
        string $quality
    ) {
//        parent::setTitle($title);
//        parent::setCreator($creator);
        parent::__construct($title, $creator);
        $this->type = $type;
        $this->duration = $duration;
        $this->quality = $quality;
    }


}