<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 14.11.18
 * Time: 06:54
 */

namespace Model;

class Box
{
    private $tabWithBoxes = [];

    /**
     * Box constructor.
     */
    public function __construct()
    {
    }

    /**
     * add new box to the tab.
     * @param int $wallAOfTheBoxHigh - wall height A one box.
     * @param int $wallAOfTheBoxWidth - wall width A one box.
     * @param int $wallBOfTheBoxHigh - wall height B one box.
     * @param int $wallBOfTheBoxWidth - wall width B one box.
     * @param int $wallCOfTheBoxHigh - wall height C one box.
     * @param int $wallCOfTheBoxWidth - wall width C one box.
     * @param int $quantityStubTube - quantity stub tube one box.
     */
    public function addBox(int $wallAOfTheBoxHigh, int $wallAOfTheBoxWidth,
                           int $wallBOfTheBoxHigh, int $wallBOfTheBoxWidth,
                           int $wallCOfTheBoxHigh, int $wallCOfTheBoxWidth,
                           int $quantityStubTube, SizeChecker $sizeChecker,
                           SheetFormat $sheetFormat): void
    {
        $sizeChecker->checkSidesBox($wallAOfTheBoxHigh, $wallAOfTheBoxWidth,
            $wallBOfTheBoxHigh, $wallBOfTheBoxWidth,
            $wallCOfTheBoxHigh, $wallCOfTheBoxWidth, $quantityStubTube);

        $sizeChecker->checkLengthOfWall($wallAOfTheBoxHigh, $wallAOfTheBoxWidth,
            $wallBOfTheBoxHigh, $wallBOfTheBoxWidth,
            $wallCOfTheBoxHigh, $wallCOfTheBoxWidth,
            $sheetFormat);

        $this->tabWithBoxes[] = ["wallAOfTheBoxHigh" => $wallAOfTheBoxHigh, "wallAOfTheBoxWidth" => $wallAOfTheBoxWidth,
            "wallBOfTheBoxHigh" => $wallBOfTheBoxHigh, "wallBOfTheBoxWidth" => $wallBOfTheBoxWidth,
            "wallCOfTheBoxHigh" => $wallCOfTheBoxHigh, "wallCOfTheBoxWidth" => $wallCOfTheBoxWidth,
            "quantityStubTube" => $quantityStubTube];
    }

    /**
     * @return array - tan with all boxes.
     */
    public function getTabWithBoxes(): array
    {
        return $this->tabWithBoxes;
    }
}
