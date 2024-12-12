<?php

namespace App\Services\HidroProjekt\Domain\Reports\Tables;

class Column
{
    const DEF_COLOR = 'black';
    const DEF_BORDER_TYPE = 'solid';
    const DEF_BORDER_PX = '1';

    const DEF_CURRENCY_SYMBOL = '€';

    public $title;
    public $from;
    private $cellType = NULL;

    public $style=[];

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

    public function setTd(){
        $this->cellType = 'td';
        return $this;
    }

    public function setTh(){
        $this->cellType = 'th';
        return $this;
    }

    public function isCurrency($bool = TRUE, $symbol = self::DEF_CURRENCY_SYMBOL){
        if($this->isCellTypeSet()){
            $this->style[$this->cellType]['isCurrency'] = [$bool, $symbol];
        }
        return $this;
    }

    public function isNumber($bool = TRUE){
        if($this->isCellTypeSet()){
            $this->style[$this->cellType]['isNumber'] = [$bool];
        }
        return $this;
    }

    public function setBorder($orientation)

    private function isCellTypeSet(): bool{
        return $this->cellType != NULL ? TRUE : FALSE;
    }

}