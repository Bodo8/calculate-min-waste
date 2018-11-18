<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 16.11.18
 * Time: 09:03
 */

namespace model;


class CalculateWaste
{

    private $areaWaste;
    private $areaAllWallBoxes;

    /**
     * CalculateWaste constructor.
     */
    public function __construct()
    {
    }

    public function calculateMaxAreaBoxes(array $aAllHighTab, array $aAllWidthTab, int $sheetArea)
    {
        $this->setAreaAllWallBoxes(0);
        $this->calculateAreaWall($aAllHighTab, $aAllWidthTab, $sheetArea);
    }


    private function calculateAreaWall(array $allWidthTab, array $allHighTab, int $sheetArea)
    {
        $counter = 0;
        while ($counter < count($allWidthTab)) {
            $widthWall = isset($allWidthTab[$counter])
                ? $allWidthTab[$counter] : null;
            $highWall = isset($allHighTab[$counter])
                ? $allHighTab[$counter] : null;
            $areOneWall = $widthWall * $highWall;
            $tempAreaWalls = $this->getAreaAllWallBoxes() + $areOneWall;
            $counter++;
            $tempCounter = $counter + 1;
            if ($tempAreaWalls > $sheetArea) {
                //check others walls
                break;
            }
            $this->sumAreaAllWallBoxes($areOneWall);

            if ($this->getAreaAllWallBoxes() == $sheetArea) {
                break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getAreaAllWallBoxes(): int
    {
        return $this->areaAllWallBoxes;
    }

    /**
     * @param $areaAllWall
     */
    private function sumAreaAllWallBoxes($areaAllWall): void
    {
        $sum = $this->getAreaAllWallBoxes() + $areaAllWall;
        $this->setAreaAllWallBoxes($sum);
    }

    /**
     * @param mixed $areaAllWallBoxes
     */
    private function setAreaAllWallBoxes($areaAllWallBoxes): void
    {
        $this->areaAllWallBoxes = $areaAllWallBoxes;
    }


    /**
     * @return mixed
     */
    public function getAreaWaste(): int
    {
        return $this->areaWaste;
    }

    /**
     * @param mixed $areaWaste
     */
    private function setAreaWaste($areaWaste): void
    {
        $this->areaWaste = $areaWaste;
    }
}
