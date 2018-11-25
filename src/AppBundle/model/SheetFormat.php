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
        $sizeChecker->checkSides($sheetHigh, $sheetWidth);
        $this->sheetHigh = $sheetHigh;
        $this->sheetWidth = $sheetWidth;
    }

    public function getSheetHigh(): int
    {
        return $this->sheetHigh;
    }

    public function getSheetWidth(): int
    {
        return $this->sheetWidth;
    }
}
