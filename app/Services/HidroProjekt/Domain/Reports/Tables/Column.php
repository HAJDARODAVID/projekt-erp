<?php

namespace App\Services\HidroProjekt\Domain\Reports\Tables;

class Column
{
    const DEF_COLOR = 'black';
    const DEF_BORDER_TYPE = 'solid';
    const DEF_BORDER_PX = '1';

    public $title;
    public $from;

    public function __construct(string $title, ?string $from = null)
    {
        $this->title = $title;
        $this->from = $from;
    }

    /**
     * @return static
     */
    public static function make(string $title, ?string $from = null): Column
    {
        return new static($title, $from);
    }

}