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
    private $box;

    /**
     * WallSizes constructor.
     * @param $box
     */
    public function __construct(Box $box)
    {
        $this->box = $box;
    }

    public function createTabsWithSizes(): void
    {
        $tabWithBoxes = $this->box->getTabWithBoxes();
        $allKeysTab = $this->getTabWithAllKeys($tabWithBoxes);
        $this->createTablesUsingKeysTable($tabWithBoxes, $allKeysTab);
    }

    /**
     * @param array $tabWithBoxes -
     * @param array $allKeysTab
     */
    private function createTablesUsingKeysTable(array $tabWithBoxes, array $allKeysTab)
    {
        $sizeTab = count($allKeysTab);
        $index = (int)($sizeTab / 2);

        for ($k = 0; $k < $index; $k++) {
            $tempOneSize = [];
            $temp = $k;

            for ($i = $temp; $i < count($allKeysTab) - 1; $i++) {
                $key = $allKeysTab[$i];
                if ($temp == 2) {
                    $key = $allKeysTab[$sizeTab - 1];
                    $i = $sizeTab;
                }

                $i++;
                $count = 0;
                foreach ($tabWithBoxes as $size) {
                    $tempOneSize[$count] = $size[$key];
                    $count++;
                }

                if ($k == 0) {
                    $counter = $k;
                    $this->mergeTabs($tempOneSize, $counter);
                }
                if ($k == 1) {
                    $counter = $k;
                    $this->mergeTabs($tempOneSize, $counter);
                }
                if ($k == 2) {
                    $counter = $k;
                    $this->mergeTabs($tempOneSize, $counter);
                }
            }

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