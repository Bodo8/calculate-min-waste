<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 17.11.18
 * Time: 20:02
 */

namespace Model;

use PHPUnit\Framework\TestCase;
use Tests\Generators\BoxGenerator;

class CalculateWasteTest extends TestCase
{
    private $box;
    private $sizeChecker;
    private $sheetFormat;
    private $aAllWidthTab;
    private $aAllHighTab;
    private $quantityStubTubeTab;
    private $wallSizes;


    public function setUp()
    {
        $this->sizeChecker = new SizeChecker();
        $this->sheetFormat = new SheetFormat();
        $this->box = new Box();
        $this->wallSizes = new WallSizes($this->box);
        $this->sheetFormat->addSheetFormat(2500, 1250, $this->sizeChecker);
        BoxGenerator::generateBoxes($this->box);
        $this->wallSizes->createTabsWithSizes();
        $this->aAllWidthTab = $this->wallSizes->getTabWithWidthSize();
        $this->aAllHighTab = $this->wallSizes->getTabWithHighSize();
        $this->quantityStubTubeTab = $this->wallSizes->getTabWithQuantityStubTube();
    }

    public function testCalculateMaxAreaBoxes()
    {
        $calculateWaste = new CalculateWaste($this->sheetFormat);
        $calculateWaste->calculateMaxAreaBoxes($this->aAllHighTab, $this->aAllWidthTab, $this->quantityStubTubeTab);
        $actualAreaWalls = $calculateWaste->getAreaAllWallBoxes();
        $actualWaste = $calculateWaste->getAreaWaste();
        $this->assertEquals(3122500, $actualAreaWalls);
        $this->assertEquals(17265, $actualWaste);

    }
}
