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
    //field stub tube(króćca) fi 50, result of the calculation: 25mm*3,1416.
    const AREA_ONE_STUB_TUBE = 78.54;
    private $sheetFormat;
    private $areaWaste;
    private $areaAllWallBoxes;

    /**
     * CalculateWaste constructor.
     * @param SheetFormat $sheetFormat - object SheetFormat class.
     */
    public function __construct(SheetFormat $sheetFormat)
    {
        $this->sheetFormat = $sheetFormat;
    }

    /**
     * @param array $aAllHighTab - tab with all heights of the all of the boxes.
     * @param array $aAllWidthTab - tab with all widths of the all of the boxes.
     * @param array $tabWithQuantityStubTube - tab with all quantities stub tube of the boxes.
     */
    public function calculateMaxAreaBoxes(array $aAllHighTab, array $aAllWidthTab, array $tabWithQuantityStubTube)
    {
        $this->setAreaAllWallBoxes(0);
        $tabWithWallsField = $this->getWallsFieldTab($aAllHighTab, $aAllWidthTab);
        $usedWallsTab = $this->getTabWithUsedWalls($tabWithWallsField);
        $sheetField = $this->getSheetField();
        $this->calculateMaxFieldWalls($tabWithWallsField, $usedWallsTab, $sheetField);
        $wasteWithStubTube = $this->getStubTubeField($tabWithQuantityStubTube);
        $maxFieldWalls = $this->getAreaAllWallBoxes();
        $waste = ($sheetField - $maxFieldWalls) + $wasteWithStubTube;
        $this->setAreaWaste($waste);

    }

    private function calculateMaxFieldWalls(array $tabWithWallsField,
                                            array $usedWallsTab, int $sheetField)
    {
        $counter = 0;
        while ($counter < count($tabWithWallsField)) {
            $fieldOneWall = $tabWithWallsField[$counter];
            $actualFieldBoxes = $this->getAreaAllWallBoxes();
            $tempWallsField = $actualFieldBoxes + $fieldOneWall;

            $counter++;
            if ($tempWallsField > $sheetField) {
                $this->addSmallField($tabWithWallsField,
                    $usedWallsTab, $counter, $sheetField);
                break;
            }
            $this->sumAreaAllWallBoxes($fieldOneWall);
            if ($this->getAreaAllWallBoxes() == $sheetField) {
                break;
            }

        }
    }

    private function getStubTubeField(array $quantityStubTubeTab): int
    {
        $quantityStubTubes = array_sum($quantityStubTubeTab);
        $stubTubesField = CalculateWaste::AREA_ONE_STUB_TUBE * $quantityStubTubes;
        return $stubTubesField;
    }

    private function addSmallField(array $tabWithWallsField,
                                   array $usedWallsTab, int $counter, int $sheetField)
    {
        $usedWallsTab = array_fill(0, $counter, "true");
        while ($counter < count($tabWithWallsField)) {
            $fieldSmallWall = $tabWithWallsField[$counter];
            $waste = $sheetField - $this->getAreaAllWallBoxes();
            if ($fieldSmallWall <= $waste) {
                $this->sumAreaAllWallBoxes($fieldSmallWall);
                $usedWallsTab[$counter] = true;
            }
            $counter++;
        }
    }

    private function getWallsFieldTab(array $allWidthTab, array $allHighTab): array
    {
        $tabWithWallsField = [];

        for ($i = 0; $i < count($allWidthTab); $i++) {
            $widthWall = isset($allWidthTab[$i])
                ? $allWidthTab[$i] : null;
            $highWall = isset($allHighTab[$i])
                ? $allHighTab[$i] : null;
            $areOneWall = $widthWall * $highWall;
            $tabWithWallsField[$i] = $areOneWall;
        }
        arsort($tabWithWallsField);
        return $tabWithWallsField;
    }

    private function getTabWithUsedWalls(array $tabWithWallsField): array
    {
        $size = count($tabWithWallsField);
        $usedWalls = array_fill(0, $size, "false");
        return $usedWalls;
    }


    private function getSheetField(): int
    {
        return $this->sheetFormat->getSheetHigh() * $this->sheetFormat->getSheetWidth();
    }

    /**
     * @return mixed - return tab with all wall fields, all boxes.
     */
    public function getAreaAllWallBoxes(): int
    {
        return $this->areaAllWallBoxes;
    }

    /**
     * @param $areaAllWall - tab with sum wall fields, all boxes.
     */
    private function sumAreaAllWallBoxes($areaAllWall): void
    {
        $sum = $this->getAreaAllWallBoxes() + $areaAllWall;
        $this->setAreaAllWallBoxes($sum);
    }

    /**
     * @param mixed $areaAllWallBoxes - sets the actual value of the wall field.
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
