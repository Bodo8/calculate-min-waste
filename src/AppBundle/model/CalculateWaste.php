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
    private $sheetFormat;
    private $areaWaste;
    private $areaAllWallBoxes;

    /**
     * CalculateWaste constructor.
     * @param SheetFormat $sheetFormat
     */
    public function __construct(SheetFormat $sheetFormat)
    {
        $this->sheetFormat = $sheetFormat;
    }

    public function calculateMaxAreaBoxes(array $aAllHighTab, array $aAllWidthTab)
    {
        $this->setAreaAllWallBoxes(0);
        $tabWithWallsField = $this->getWallsFieldTab($aAllHighTab, $aAllWidthTab);
        $usedWallsTab = $this->getTabWithUsedWalls($tabWithWallsField);
        $sheetField = $this->getSheetField();
        $this->calculateMaxFieldWalls($tabWithWallsField, $usedWallsTab, $sheetField);
    }

    public function calculateMaxFieldWalls(array $tabWithWallsField,
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
        return $this->sheetFormat->getSheetHigh() * $this->sheetFormat->getSheetWeight();
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
