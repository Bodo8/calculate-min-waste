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
    private $sheetWidth;

    /**
     * SheetFormat constructor.
     */
    public function __construct()
    {
    }


    /**
     * SheetFormat constructor.
     * @param $sheetHigh
     * @param $sheetWidth
     * @param SizeChecker $sizeChecker
     */
    public function addSheetFormat($sheetHigh, $sheetWidth, SizeChecker $sizeChecker): void
    {
        $this->sheetHigh = $sheetHigh;
        $this->sheetWidth = $sheetWidth;
        if (!$sizeChecker->checkSides($sheetHigh, $sheetWidth)) {
            $this->setSheetHigh($sheetWidth);
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

    public function getSheetWidth(): int
    {
        return $this->sheetWidth;
    }

    private function setSheetWeight(int $sheetWeight): void
    {
        $this->sheetWidth = $sheetWeight;
    }

}
