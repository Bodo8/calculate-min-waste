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
     * add side selections for shorter and longer ones.
     * @param int $wallAOfTheBoxHigh
     * @param int $wallAOfTheBoxWidth
     * @param int $wallBOfTheBoxHigh
     * @param int $wallBOfTheBoxWidth
     * @param int $wallCOfTheBoxHigh
     * @param int $wallCOfTheBoxWidth
     * @param int $quantityStubTube
     */
    public function addBox(int $wallAOfTheBoxHigh, int $wallAOfTheBoxWidth,
                           int $wallBOfTheBoxHigh, int $wallBOfTheBoxWidth,
                           int $wallCOfTheBoxHigh, int $wallCOfTheBoxWidth,
                           int $quantityStubTube): void
    {
        $this->checkSides($wallAOfTheBoxHigh, $wallAOfTheBoxWidth);
        $this->checkSides($wallBOfTheBoxHigh, $wallBOfTheBoxWidth);
        $this->checkSides($wallCOfTheBoxHigh, $wallCOfTheBoxWidth);

        $this->tabWithBoxes[] = ["wallAOfTheBoxHigh" => $wallAOfTheBoxHigh, "wallAOfTheBoxWidth" => $wallAOfTheBoxWidth,
            "wallBOfTheBoxHigh" => $wallBOfTheBoxHigh, "wallBOfTheBoxWidth" => $wallBOfTheBoxWidth,
            "wallCOfTheBoxHigh" => $wallCOfTheBoxHigh, "wallCOfTheBoxWidth" => $wallCOfTheBoxWidth,
            "quantityStubTube" => $quantityStubTube];
    }

    private function checkSides(int $sideHigh, int $sideWidth): void
    {
        if ($sideHigh <= 0 | $sideWidth <= 0) {
            throw new \InvalidArgumentException("the side length must be greater than zero");
        }
    }

    /**
     * @return array
     */
    public function getTabWithBoxes(): array
    {
        return $this->tabWithBoxes;
    }
}
