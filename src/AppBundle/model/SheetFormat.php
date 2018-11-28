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

    private $sheetHeight;
    private $sheetWidth;

    /**
     * SheetFormat constructor.
     */
    public function __construct()
    {
    }

    /**
     * SheetFormat constructor.
     * @param $sheetHeight
     * @param $sheetWidth
     * @param SizeChecker $sizeChecker
     */
    public function addSheetFormat(int $sheetHeight, int $sheetWidth, SizeChecker $sizeChecker): void
    {
        $sizeChecker->checkSidesSheet($sheetHeight, $sheetWidth);
        $this->sheetHeight = $sheetHeight;
        $this->sheetWidth = $sheetWidth;
        $longSidesIsOk = $sizeChecker->checkLongSheet($sheetHeight, $sheetWidth);
        if (!$longSidesIsOk) {
            $this->setSheetWidth($sheetHeight);
            $this->setSheetHigh($sheetWidth);
        }
    }

    /**
     * @return int - sheet height.
     */
    public function getSheetHeight(): int
    {
        if ($this->sheetHeight === null) {
            throw new \InvalidArgumentException(
                "please specify the size of the sheet first");
        }
        return $this->sheetHeight;
    }

    /**
     * @return int - sheet width.
     */
    public function getSheetWidth(): int
    {
        if ($this->sheetWidth === null) {
            throw new \InvalidArgumentException(
                "please specify the size of the sheet first");
        }
        return $this->sheetWidth;
    }

    /**
     * @param mixed $sheetHeight
     */
    private function setSheetHigh($sheetHeight): void
    {
        $this->sheetHeight = $sheetHeight;
    }

    /**
     * @param mixed $sheetWidth
     */
    private function setSheetWidth($sheetWidth): void
    {
        $this->sheetWidth = $sheetWidth;
    }
}
