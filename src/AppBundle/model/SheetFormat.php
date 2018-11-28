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
    public function addSheetFormat(int $sheetHigh, int $sheetWidth, SizeChecker $sizeChecker): void
    {
        $sizeChecker->checkSidesSheet($sheetHigh, $sheetWidth);
        $this->sheetHigh = $sheetHigh;
        $this->sheetWidth = $sheetWidth;
        $longSidesIsOk = $sizeChecker->checkLongSheet($sheetHigh, $sheetWidth);
        if (!$longSidesIsOk) {
            $this->setSheetWidth($sheetHigh);
            $this->setSheetHigh($sheetWidth);
        }
    }

    public function getSheetHigh(): int
    {
        if ($this->sheetHigh === null) {
            throw new \InvalidArgumentException(
                "please specify the size of the sheet first");
        }
        return $this->sheetHigh;
    }

    public function getSheetWidth(): int
    {
        if ($this->sheetWidth === null) {
            throw new \InvalidArgumentException(
                "please specify the size of the sheet first");
        }
        return $this->sheetWidth;
    }

    /**
     * @param mixed $sheetHigh
     */
    private function setSheetHigh($sheetHigh): void
    {
        $this->sheetHigh = $sheetHigh;
    }

    /**
     * @param mixed $sheetWidth
     */
    private function setSheetWidth($sheetWidth): void
    {
        $this->sheetWidth = $sheetWidth;
    }


}
