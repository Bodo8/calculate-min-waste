<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 19.11.18
 * Time: 21:17
 */

namespace Model;


class WallSizes
{
    private $tabWithHighSize = [];
    private $tabWithWidthSize = [];
    private $tabWithQuantityStubTube = [];

    /**
     * WallSizes constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param array $tabWithBoxes - create table with the dimensions of boxes to be placed on the sheet.
     */
    public function createTabsWithSizes(array $tabWithBoxes): void
    {
        if (empty($tabWithBoxes)) {
            throw new \InvalidArgumentException("add boxes beforehand");
        }

        $this->createTablesUsingKeys($tabWithBoxes);
    }

    /**
     * This function create tabs with High Size, Width Size, Quantity StubTube.
     * @param array $tabWithBoxes - table with the dimensions of boxes to be placed on the sheet.
     */
    private function createTablesUsingKeys(array $tabWithBoxes)
    {
        $allKeysTab = $this->getTabWithAllKeys($tabWithBoxes);
        $sizeTabKeys = count($allKeysTab);
        $index = (int)($sizeTabKeys / 2);

        for ($k = 0; $k < $index; $k++) {
            $temp = $k;

            for ($i = $temp; $i < $sizeTabKeys - 1; $i++) {
                $keyWall = $allKeysTab[$i];
                if ($temp == 2) {
                    $keyWall = $allKeysTab[$sizeTabKeys - 1];
                    $i = $sizeTabKeys;
                }
                $this->createTabsWithOneDimensionOfWalls($tabWithBoxes, $keyWall, $k);
                $i++;
            }
        }
    }

    /**
     * The function searches for all wall sizes with the same key, example: $wallAOfTheBoxHigh.
     * @param array $tabWithBoxes - tab with boxes.
     * @param string $keyWall - key, example: $wallAOfTheBoxHigh.
     * @param int $counter - number key from the tab with all the keys.
     */
    private function createTabsWithOneDimensionOfWalls(array $tabWithBoxes, string $keyWall, int $counter): void
    {
        $tempOneSize = [];

        $count = 0;
        foreach ($tabWithBoxes as $sizesWall) {
            $tempOneSize[$count] = $sizesWall[$keyWall];
            $count++;
        }

        if ($counter == 0) {
            $this->mergeTabs($tempOneSize, $counter);
        }
        if ($counter == 1) {
            $this->mergeTabs($tempOneSize, $counter);
        }
        if ($counter == 2) {
            $this->mergeTabs($tempOneSize, $counter);
        }
    }

    private function getTabWithAllKeys(array $tabWithBoxes): array
    {
        $wallsTab = $tabWithBoxes[0];
        return array_keys($wallsTab);
    }

    /**
     * This function merge tabs with High Size, Width Size, Quantity StubTube.
     * @param array $oneSizesTab - tab with one size.
     * @param int $counter - number determines witch tab wil be merge.
     */
    private function mergeTabs(array $oneSizesTab, int $counter): void
    {
        if ($counter == 0) {
            $tabWithHighSize = $this->getTabWithHighSize();
            $this->setTabWithHighSize(array_merge($tabWithHighSize, $oneSizesTab));
        }
        if ($counter == 1) {
            $tabWithWidthSize = $this->getTabWithWidthSize();
            $this->setTabWithWidthSize(array_merge($tabWithWidthSize, $oneSizesTab));
        }

        if ($counter == 2) {
            $stubTubeTab = $this->getTabWithQuantityStubTube();
            $this->setTabWithQuantityStubTube(array_merge($stubTubeTab, $oneSizesTab));
        }
    }

    /**
     * @return array - tab with all wall heights.
     */
    public function getTabWithHighSize(): array
    {
        return $this->tabWithHighSize;
    }

    /**
     * @param array - set $tabWithHighSize.
     */
    private function setTabWithHighSize(array $tabWithHighSize): void
    {
        $this->tabWithHighSize = $tabWithHighSize;
    }

    /**
     * @return array - tab with all wall widths.
     */
    public function getTabWithWidthSize(): array
    {
        return $this->tabWithWidthSize;
    }

    /**
     * @param array - set $tabWithWidthSize
     */
    private function setTabWithWidthSize(array $tabWithWidthSize): void
    {
        $this->tabWithWidthSize = $tabWithWidthSize;
    }

    /**
     * @return array - tab with quantity stub tube.
     */
    public function getTabWithQuantityStubTube(): array
    {
        return $this->tabWithQuantityStubTube;
    }

    /**
     * @param array $tabWithQuantityStubTube
     */
    private function setTabWithQuantityStubTube(array $tabWithQuantityStubTube): void
    {
        $this->tabWithQuantityStubTube = $tabWithQuantityStubTube;
    }
}