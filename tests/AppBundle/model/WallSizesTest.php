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
    private $allBoxesTab;
    private $sheetFormat;
    private $sizeChecker;

    public function setUp()
    {
        $this->sheetFormat = new SheetFormat();
        $this->sizeChecker = new SizeChecker();
        $this->sheetFormat->addSheetFormat(2500, 1250, $this->sizeChecker);
        $this->box = new Box();
        BoxGenerator::generateBoxes($this->box);
        $this->allBoxesTab = $this->box->getTabWithBoxes();
    }

    public function testGetTabWithBoxes()
    {
        $expectedFirstSize = 600;
        $expectedFirstWidth = 250;
        $expectedFirstStubTub = 7;
        $wallSizes = new WallSizes($this->box);
        $wallSizes->createTabsWithSizes();
        $highTab = $wallSizes->getTabWithHighSize();
        $widthTab = $wallSizes->getTabWithWidthSize();
        $stubTubeTab = $wallSizes->getTabWithQuantityStubTube();
        $actualFirstHighSize = $highTab[0];
        $actualFirstWidth = $widthTab[0];
        $actualFirstStubTub = $stubTubeTab[0];
        $this->assertEquals($expectedFirstSize, $actualFirstHighSize);
        $this->assertEquals($expectedFirstWidth, $actualFirstWidth);
        $this->assertEquals($expectedFirstStubTub, $actualFirstStubTub);

    }
}
