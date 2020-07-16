<?php
require 'Robot.php';
class Simulator
{
    private $command;

    const PLACE = 'PLACE';
    const MOVE = 'MOVE';
    const RIGHT = 'RIGHT';
    const LEFT = 'LEFT';
    const REPORT = 'REPORT';

    function __construct($command)
    {
        $this->command = $command;
    }

    function executeCommand()
    {
        $h = new Robot();
        for ($i=0;$i<sizeof($this->command);$i++){
            if ($i==0){
                $firstValue = explode(" ",$this->command[$i]);
                if ($firstValue[0]!=self::PLACE){
                    echo "Invalid starting command";
                    return;
                }else{
                    $location = explode(",",$firstValue[1]);
                    if ($location[0]>5 or $location[1]>5){
                        echo "Invalid starting position";
                        return;
                    }else{
                        $h->updateStartingPosition($location[0],$location[1],$location[2]);
                        continue;
                    }
                }
            }
            switch ($this->command[$i]) {
                case self::MOVE:
                    $h->move();
                    break;
                case self::RIGHT:
                    $h->right();
                    break;
                case self::LEFT:
                    $h->left();
                    break;
                case self::REPORT:
                    $h->report();
                    $currentLocation = $h->getCurrentLocation();
                    echo $currentLocation;
                    break;
            }
        }
    }
}