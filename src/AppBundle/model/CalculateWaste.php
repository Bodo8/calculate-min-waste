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
        $sheetField = $this->getSheetField();
        $this->calculateMaxFieldWalls($tabWithWallsField, $sheetField);
        $wasteWithStubTube = $this->getStubTubeField($tabWithQuantityStubTube);
        $maxFieldWalls = $this->getAreaAllWallBoxes();
        $waste = ($sheetField - $maxFieldWalls) + $wasteWithStubTube;
        $this->setAreaWaste($waste);

    }

    private function calculateMaxFieldWalls(array $tabWithWallsField, int $sheetField)
    {
        $counter = 0;
        while ($counter < count($tabWithWallsField)) {
            $fieldOneWall = $tabWithWallsField[$counter];
            $actualFieldBoxes = $this->getAreaAllWallBoxes();
            $tempWallsField = $actualFieldBoxes + $fieldOneWall;

            $counter++;
            if ($tempWallsField > $sheetField) {
                $tempSumsFieldsTab = $this->getSumsSmallFieldsTab($tabWithWallsField,
                    $counter, $sheetField);
                $maxSmallField = !empty($tempSumsFieldsTab) ? $tempSumsFieldsTab[0] : 0;
                $this->sumAreaAllWallBoxes($maxSmallField);
                break;
            }
            if ($tempWallsField == $sheetField) {
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


    private function getSumsSmallFieldsTab(array $tabWithWallsField,
                                           int $counter, int $sheetField): array
    {
        $sumsSmallFieldsTab = [];
        $sortSumsSmallFieldsTab = [];
        $waste = $sheetField - $this->getAreaAllWallBoxes();
        $sizeTab = count($tabWithWallsField);

        for ($i = $counter; $i < $sizeTab - 1; $i++) {
            $fieldFirstWall = $tabWithWallsField[$i];

            $indexInside = $sizeTab;
            $smallWallsSum = $fieldFirstWall;
            if ($fieldFirstWall < $waste) {
                while ($indexInside > $counter + 1) {
                    $nextFieldWall = $tabWithWallsField[$indexInside - 1];

                    $tempSum = $smallWallsSum + $nextFieldWall;
                    if ($tempSum < $waste) {
                        $smallWallsSum += $nextFieldWall;
                        $sumsSmallFieldsTab[] = $smallWallsSum;
                    } else {
                        if ($tempSum > $waste) {
                            $sumsSmallFieldsTab[] = $smallWallsSum;
                            break;
                        }
                        if ($tempSum == $waste) {
                            $sumsSmallFieldsTab[] = $tempSum;
                            break;
                        }
                    }
                    $indexInside--;
                }
            }
        }
        rsort($sumsSmallFieldsTab);
        foreach ($sumsSmallFieldsTab as $field) {
            $sortSumsSmallFieldsTab[] = $field;
        }
        return $sortSumsSmallFieldsTab;
    }

    private function getWallsFieldTab(array $allWidthTab, array $allHighTab): array
    {
        $tabWithWallsField = [];
        $sortTabWithWallsField = [];

        for ($i = 0; $i < count($allWidthTab); $i++) {
            $widthWall = isset($allWidthTab[$i])
                ? $allWidthTab[$i] : null;
            $highWall = isset($allHighTab[$i])
                ? $allHighTab[$i] : null;
            $fieldOneWall = $widthWall * $highWall;
            $tabWithWallsField[$i] = $fieldOneWall;
        }
        rsort($tabWithWallsField);
        foreach ($tabWithWallsField as $field) {
            $sortTabWithWallsField[] = $field;
        }
        return $sortTabWithWallsField;
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
