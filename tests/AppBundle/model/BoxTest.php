<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 14.11.18
 * Time: 21:27
 */

declare(strict_types=1);

namespace Model;

use PHPUnit\Framework\TestCase;

class BoxTest extends TestCase
{

    private $box;
    private $sizeChecker;
    private $sheetFormat;

    public function setUp()
    {
        $this->box = new Box();
        $this->sizeChecker = new SizeChecker();
        $this->sheetFormat = new SheetFormat();
        $this->sheetFormat->addSheetFormat(2500, 1200, $this->sizeChecker);
    }

    public function testAddBox()
    {
        $this->box->addBox(450, 600,
            200, 300,
            200, 300, 2, $this->sizeChecker, $this->sheetFormat);
        $expectSizeA = 450;
        $boxesTab = $this->box->getTabWithBoxes();
        $oneBoxTab = $boxesTab[0];
        $actualSizeA = $oneBoxTab["wallAOfTheBoxHigh"];
        $this->assertEquals($expectSizeA, $actualSizeA);

    }

    public function testAddBoxWith0size()
    {
        $this->expectException("\InvalidArgumentException");
        $this->box->addBox(450, 0,
            200, 300, 200, 300, 8,
            $this->sizeChecker, $this->sheetFormat);
        $this->fail("the side length must be greater than zero,
            or quantity stub tube can be 0");
    }

    public function testAddBoxWithMinus1StubTube()
    {
        $this->expectException("\InvalidArgumentException");
        $this->box->addBox(450, 200,
            200, 300, 200, 300, -1,
            $this->sizeChecker, $this->sheetFormat);
        $this->fail("the side length must be greater than zero,
            only quantity stub tube can be 0");
    }

    public function testAddBoxWithGreaterWall()
    {
        $this->expectException("\InvalidArgumentException");
        $this->box->addBox(450, 2600,
            200, 300, 200, 300, 5,
            $this->sizeChecker, $this->sheetFormat);
        $this->fail("the size of the box must be smaller 
        than the size of the sheet");
    }

    public function testAddBoxWith2000LongWall()
    {
        $this->expectException("\InvalidArgumentException");
        $this->box->addBox(200, 300,
            200, 300, 2000, 2000, 5,
            $this->sizeChecker, $this->sheetFormat);
        $this->fail("the size of the box must be smaller 
        than the size of the sheet");
    }
}
