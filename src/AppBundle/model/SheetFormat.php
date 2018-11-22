<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 14.11.18
 * Time: 22:21
 */

namespace Model;


class SheetFormat
{

    private $sheetHigh;
    private $sheetWeight;

    /**
     * SheetFormat constructor.
     */
    public function __construct()
    {
    }


    /**
     * SheetFormat constructor.
     * @param $sheetHigh
     * @param $sheetWeight
     * @param SizeChecker $sizeChecker
     */
    public function addSheetFormat($sheetHigh, $sheetWeight, SizeChecker $sizeChecker): void
    {
        $this->sheetHigh = $sheetHigh;
        $this->sheetWeight = $sheetWeight;
        if (!$sizeChecker->checkSides($sheetHigh, $sheetWeight)) {
            $this->setSheetHigh($sheetWeight);
            $this->setSheetWeight($sheetHigh);
        }
    }

    public function getSheetHigh(): int
    {
        return $this->sheetHigh;
    }

    /**
     * @param mixed $sheetHigh
     */
    private function setSheetHigh($sheetHigh): void
    {
        $this->sheetHigh = $sheetHigh;
    }

    public function getSheetWeight(): int
    {
        return $this->sheetWeight;
    }

    private function setSheetWeight(int $sheetWeight): void
    {
        $this->sheetWeight = $sheetWeight;
    }

}
