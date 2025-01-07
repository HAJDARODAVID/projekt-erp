<?php

namespace App\Services\HidroProjekt\Domain\Reports\Tables;

class Column
{
    const DEF_COLOR = 'black';
    const DEF_BORDER_TYPE = 'solid';
    const DEF_BORDER_PX = '1';

    const DEF_CURRENCY_SYMBOL = '€';

    const ORIENTATION=[
        'l' => 'left',
        'r' => 'right',
        't' => 'top',
        'b' => 'bottom',
    ];

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
        $this->style[$this->cellType] = NULL;
        return $this;
    }

    public function setTh(){
        $this->cellType = 'th';
        $this->style[$this->cellType] = NULL;
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

    public function setBorder($orientation, $size = self::DEF_BORDER_PX, $style= self::DEF_BORDER_TYPE,$color= self::DEF_COLOR){
        if($this->isCellTypeSet()){
            $orientation = strtolower($orientation);
            if(isset(self::ORIENTATION[$orientation])){
                if(isset($this->style[$this->cellType]['border'])){
                    $this->style[$this->cellType]['border'] = [$this->style[$this->cellType]['border'][0] .' '.'border-'.self::ORIENTATION[$orientation].': '.$size.'px '.$style.' '.$color.';'];
                }
                else{
                    $this->style[$this->cellType]['border'] = ['border-'.self::ORIENTATION[$orientation].': '.$size.'px '.$style.' '.$color.';'];
                }
            }
        }
        return $this;
    }

    public function textCenter(){
        if($this->isCellTypeSet()){         
            if(isset($this->style[$this->cellType]['textCenter'])){
                $this->style[$this->cellType]['textCenter'] = [$this->style[$this->cellType]['textCenter'][0] .' '.'text-center'];
            }
            else{
                $this->style[$this->cellType]['textCenter'] = ['text-center'];
            }
        }
        return $this;
    }

    private function isCellTypeSet(): bool{
        return $this->cellType != NULL ? TRUE : FALSE;
    }

}