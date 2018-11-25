<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 20.11.18
 * Time: 06:07
 */

declare(strict_types=1);

namespace Model;

use PHPUnit\Framework\TestCase;
use Tests\Generators\BoxGenerator;

class WallSizesTest extends TestCase
{
    private $box;
    private $sheetFormat;
    private $sizeChecker;

    public function setUp()
    {
        $this->sheetFormat = new SheetFormat();
        $this->sizeChecker = new SizeChecker();
        $this->sheetFormat->addSheetFormat(2500, 1250, $this->sizeChecker);
        $this->box = new Box();
    }

    public function testGetTabWithBoxes()
    {
        BoxGenerator::generateBoxes($this->box);
        $allBoxesTab = $this->box->getTabWithBoxes();
        $expectedFirstSize = 600;
        $expectedFirstWidth = 250;
        $expectedFirstStubTub = 7;
        $expectSizeTab = count($allBoxesTab) * 7;
        $wallSizes = new WallSizes();
        $wallSizes->createTabsWithSizes($allBoxesTab);
        $highTab = $wallSizes->getTabWithHighSize();
        $widthTab = $wallSizes->getTabWithWidthSize();
        $stubTubeTab = $wallSizes->getTabWithQuantityStubTube();
        $actualFirstHighSize = $highTab[0];
        $actualFirstWidth = $widthTab[0];
        $actualFirstStubTub = $stubTubeTab[0];
        $actualSizeTab = count($highTab) + count($widthTab) + count($stubTubeTab);
        $this->assertEquals($expectedFirstSize, $actualFirstHighSize);
        $this->assertEquals($expectedFirstWidth, $actualFirstWidth);
        $this->assertEquals($expectedFirstStubTub, $actualFirstStubTub);
        $this->assertEquals($expectSizeTab, $actualSizeTab);
    }

    public function testCreateTabsFromEmptyTableWithBoxes()
    {
        $this->expectException("\InvalidArgumentException");
        $allBoxesTab = [];
        $wallSizes = new WallSizes();
        $wallSizes->createTabsWithSizes($allBoxesTab);
        $this->fail("add boxes beforehand");
    }
}
