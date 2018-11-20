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
        $this->createTablesHighWidth($tabWithBoxes, $allKeysTab);

    }

    private function createTablesHighWidth(array $tabWithBoxes, array $allKeysTab)
    {
        $aAllHighTab = [];
        $aAllWidthTab = [];
        $bAllHighTam = [];
        $bAllWidthTab = [];
        $cAllHighTam = [];
        $cAllWidthTab = [];
        $stubTubeTab = [];

        $keyIndex = count($allKeysTab);
        $keyAH = (string)$allKeysTab[$keyIndex - 7];
        $keyAW = (string)$allKeysTab[$keyIndex - 6];
        $keyBH = (string)$allKeysTab[$keyIndex - 5];
        $keyBW = (string)$allKeysTab[$keyIndex - 4];
        $keyCH = (string)$allKeysTab[$keyIndex - 3];
        $keyCW = (string)$allKeysTab[$keyIndex - 2];
        $keyQ = (string)$allKeysTab[$keyIndex - 1];

        $index = 0;
        foreach ($tabWithBoxes as $wall) {
            $aAllHighTab[$index] = $wall[$keyAH];
            $aAllWidthTab[$index] = $wall[$keyAW];
            $bAllHighTam[$index] = $wall[$keyBH];
            $bAllWidthTab[$index] = $wall[$keyBW];
            $cAllHighTam[$index] = $wall[$keyCH];
            $cAllWidthTab[$index] = $wall[$keyCW];
            $stubTubeTab[$index] = $wall[$keyQ];
            $index++;
        }
        $highTab = array_merge($aAllHighTab, $bAllHighTam, $cAllHighTam);
        $widthTab = array_merge($aAllWidthTab, $bAllWidthTab, $cAllWidthTab);
        $this->setTabWithHighSize($highTab);
        $this->setTabWithWidthSize($widthTab);
        $this->setTabWithQuantityStubTube($stubTubeTab);
    }

    private function getTabWithAllKeys(array $tabWithBoxes): array
    {
        $wallsTab = $tabWithBoxes[0];
        return array_keys($wallsTab);
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