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
     * @param array $tabWithBoxes - table with the dimensions of boxes to be placed on the sheet.
     */
    public function createTabsWithSizes(array $tabWithBoxes): void
    {
        if (empty($tabWithBoxes)) {
            throw new \InvalidArgumentException("add boxes beforehand");
        }

        $this->createTablesUsingKeys($tabWithBoxes);
    }

    /**
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
     * @param array $tabWithQuantityStubTube
     */
    private function setTabWithQuantityStubTube(array $tabWithQuantityStubTube): void
    {
        $this->tabWithQuantityStubTube = $tabWithQuantityStubTube;
    }


}