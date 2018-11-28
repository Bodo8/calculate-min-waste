<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 15.11.18
 * Time: 20:41
 */

namespace model;


class SizeChecker
{

    /**
     * SizeChecker constructor.
     */
    public function __construct()
    {
    }

    /**
     * check the dimension of the sheet.
     * @param int $sideHigh - length of the side of the sheet.
     * @param int $sideWidth - length of the side of the sheet.
     */
    public function checkSidesSheet(int $sideHigh, int $sideWidth): void
    {
        if ($sideHigh <= 0 | $sideWidth <= 0) {
            throw new \InvalidArgumentException("the side length must be greater than zero");
        }
    }

    /**
     * check the dimension of the sheet.
     * @param int $sideHigh - length of the side of the sheet.
     * @param int $sideWidth - length of the side of the sheet.
     * @return bool - true when height is longer than width.
     */
    public function checkLongSheet(int $sideHigh, int $sideWidth): bool
    {
        if ($sideHigh < $sideWidth) {
            return false;
        }
        return true;
    }

    /**
     * check the dimension of the box walls.
     * @param int $wallAOfTheBoxHigh - wall height A one box.
     * @param int $wallAOfTheBoxWidth - wall width A one box.
     * @param int $wallBOfTheBoxHigh - wall height B one box.
     * @param int $wallBOfTheBoxWidth - wall width B one box.
     * @param int $wallCOfTheBoxHigh - wall height C one box.
     * @param int $wallCOfTheBoxWidth - wall width C one box.
     * @param int $quantityStubTube - quantity stub tube one box.
     */
    public function checkSidesBox(int $wallAOfTheBoxHigh, int $wallAOfTheBoxWidth,
                                  int $wallBOfTheBoxHigh, int $wallBOfTheBoxWidth,
                                  int $wallCOfTheBoxHigh, int $wallCOfTheBoxWidth,
                                  int $quantityStubTube): void
    {
        if ($wallAOfTheBoxHigh <= 0 | $wallAOfTheBoxWidth <= 0 |
            $wallBOfTheBoxHigh <= 0 | $wallBOfTheBoxWidth <= 0 |
            $wallCOfTheBoxHigh <= 0 | $wallCOfTheBoxWidth <= 0 |
            $quantityStubTube < 0) {
            throw new \InvalidArgumentException("the side length must be greater than zero,
            only quantity stub tube can be 0");
        }
    }

    /**
     * @param int $wallAOfTheBoxHigh - wall height A one box.
     * @param int $wallAOfTheBoxWidth - wall width A one box.
     * @param int $wallBOfTheBoxHigh - wall height B one box.
     * @param int $wallBOfTheBoxWidth - wall width B one box.
     * @param int $wallCOfTheBoxHigh - wall height C one box.
     * @param int $wallCOfTheBoxWidth - wall width C one box.
     * @param SheetFormat $sheetFormat - object the SheetFormat class.
     */
    public function checkLengthOfWall(int $wallAOfTheBoxHigh, int $wallAOfTheBoxWidth,
                                      int $wallBOfTheBoxHigh, int $wallBOfTheBoxWidth,
                                      int $wallCOfTheBoxHigh, int $wallCOfTheBoxWidth,
                                      SheetFormat $sheetFormat): void
    {
        $sheetHighLength = $sheetFormat->getSheetHeight();
        if (isset($sheetHighLength)) {
            if ($wallAOfTheBoxHigh > $sheetHighLength | $wallAOfTheBoxWidth > $sheetHighLength |
                $wallBOfTheBoxHigh > $sheetHighLength | $wallBOfTheBoxWidth > $sheetHighLength |
                $wallCOfTheBoxHigh > $sheetHighLength | $wallCOfTheBoxWidth > $sheetHighLength) {
                throw new \InvalidArgumentException(
                    "the size of the box must be smaller than the size of the sheet");
            }
        }
    }
}