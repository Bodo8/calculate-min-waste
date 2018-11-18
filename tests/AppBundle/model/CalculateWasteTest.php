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
    private $sheetArea;


    public function setUp()
    {
        $this->sizeChecker = new SizeChecker();
        $this->sheetFormat = new SheetFormat();
        $this->sheetFormat->addSheetFormat(2500, 1250, $this->sizeChecker);
        $this->box = new Box();
        BoxGenerator::generateBoxes($this->box);
        $this->aAllWidthTab = $this->box->getTabWithWidthSize();
        $this->aAllHighTab = $this->box->getTabWithHighSize();
    }

    public function testCalculateMaxAreaBoxes()
    {
        $calculateWaste = new CalculateWaste($this->sheetFormat);
        $calculateWaste->calculateMaxAreaBoxes($this->aAllHighTab, $this->aAllWidthTab);
        $actualAreaWalls = $calculateWaste->getAreaAllWallBoxes();
        $this->assertEquals(3125000, $actualAreaWalls);

    }
}
