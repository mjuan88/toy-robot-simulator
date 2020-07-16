<?php

class Robot
{

    public $x;
    public $y;
    public $direction;
    public $boardWidth = 5;
    public $boardHeight = 5;

    protected $directionMap = [
        'NORTH' => 'EAST',
        'EAST'  => 'SOUTH',
        'SOUTH' => 'WEST',
        'WEST'  => 'NORTH',
    ];

    function __construct($x=0,$y=0,$direction='NORTH')
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
    }

    function getCurrentLocation()
    {
        return $this->x.",".$this->y.",". $this->direction;
    }


    function move()
    {
// Get current robot position
        $x = $this->x;
        $y = $this->y;

        // Determine new position based on current direction
        switch ($this->direction) {
            case "NORTH":
                $y += 1;
                break;

            case "EAST":
                $x += 1;
                break;

            case "SOUTH":
                $y -= 1;
                break;

            case "WEST":
                $x -= 1;
                break;
        }

        // Check if new x,y coordinates within board bounds
        if (! $this->inBoardArea($x, $y)) return;

        $this->x = $x;
        $this->y = $y;
    }

    function right()
    {
        $this->direction = $this->directionMap[$this->direction];
    }

    function left(){
        $this->direction = array_flip($this->directionMap)[$this->direction];
    }

    function report()
    {
        return $this->getCurrentLocation();
    }

    function updateStartingPosition($x,$y,$direction){
        $this->__construct($x,$y,$direction);
    }

    public function inBoardArea($x, $y)
    {
        return (0 <= $x && $x <= $this->boardWidth) && (0 <= $y && $y <=  $this->boardHeight);
    }

}