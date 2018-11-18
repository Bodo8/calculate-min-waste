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
    private $tabWithHighSize = [];
    private $tabWithWidthSize = [];
    private $tabWithQuantityStubTube = [];

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

        $this->tabWithBoxes[] = [
            "wallAOfTheBoxHigh" => $wallAOfTheBoxHigh, "wallAOfTheBoxWidth" => $wallAOfTheBoxWidth,
            "wallBOfTheBoxHigh" => $wallBOfTheBoxHigh, "wallBOfTheBoxWidth" => $wallBOfTheBoxWidth,
            "wallCOfTheBoxHigh" => $wallCOfTheBoxHigh, "wallCOfTheBoxWidth" => $wallCOfTheBoxWidth,
            "quantityStubTube" => $quantityStubTube];
        $this->setTabWithHighSize($this->mergeTabWithHighSize($wallAOfTheBoxHigh));
        $this->setTabWithHighSize($this->mergeTabWithHighSize($wallBOfTheBoxHigh));
        $this->setTabWithHighSize($this->mergeTabWithHighSize($wallCOfTheBoxHigh));
        $this->setTabWithWidthSize($this->mergeTabWithWidthSize($wallAOfTheBoxWidth));
        $this->setTabWithWidthSize($this->mergeTabWithWidthSize($wallBOfTheBoxWidth));
        $this->setTabWithWidthSize($this->mergeTabWithWidthSize($wallCOfTheBoxWidth));
        $this->setTabWithquantityStubTube($this->mergeTabWithQuantityStubTube($quantityStubTube));

    }

    private function checkSides(int $sideHigh, int $sideWidth): void
    {
        if ($sideHigh <= 0 | $sideWidth <= 0) {
            throw new \InvalidArgumentException("the side length must be greater than zero");
        }
    }

    private function mergeTabWithHighSize(int $wallOfTheBoxHigh): array
    {
        $tempTab[] = $wallOfTheBoxHigh;
        $tabWithHighSize = $this->getTabWithHighSize();
        $tabWithHighSize = array_merge($tabWithHighSize, $tempTab);
        return $tabWithHighSize;
    }

    private function mergeTabWithWidthSize(int $wallOfTheBoxWidth): array
    {
        $tempTab[] = $wallOfTheBoxWidth;
        $tabWithWidthSize = $this->getTabWithWidthSize();
        $tabWithWidthSize = array_merge($tabWithWidthSize, $tempTab);
        return $tabWithWidthSize;
    }

    private function mergeTabWithQuantityStubTube(int $QuantityStubTube): array
    {
        $tempTab[] = $QuantityStubTube;
        $tabWithQuantity = $this->getTabWithQuantityStubTube();
        $tabWithQuantity = array_merge($tabWithQuantity, $tempTab);
        return $tabWithQuantity;
    }

    /**
     * @return array
     */
    public function getTabWithBoxes(): array
    {
        return $this->tabWithBoxes;
    }

    /**
     * @return array
     */
    public function getTabWithHighSize(): array
    {
        return $this->tabWithHighSize;
    }

    /**
     * @param array $tabWithHighSize
     */
    private function setTabWithHighSize(array $tabWithHighSize): void
    {
        $this->tabWithHighSize = $tabWithHighSize;
    }

    /**
     * @return array
     */
    public function getTabWithWidthSize(): array
    {
        return $this->tabWithWidthSize;
    }

    /**
     * @param array $tabWithWidthSize
     */
    private function setTabWithWidthSize(array $tabWithWidthSize): void
    {
        $this->tabWithWidthSize = $tabWithWidthSize;
    }

    /**
     * @return array
     */
    public function getTabWithQuantityStubTube(): array
    {
        return $this->tabWithQuantityStubTube;
    }

    /**
     * @param array $tabWithquantityStubTube
     */
    private function setTabWithquantityStubTube(array $tabWithquantityStubTube): void
    {
        $this->tabWithQuantityStubTube = $tabWithquantityStubTube;
    }
}
