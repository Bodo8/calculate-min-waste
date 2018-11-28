<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 15.11.18
 * Time: 22:02
 */

declare(strict_types=1);

namespace Model;

use PHPUnit\Framework\TestCase;

class SheetFormatTest extends TestCase
{
    private $sizeChecker;

    public function setUp()
    {
        $this->sizeChecker = new SizeChecker();
    }

    public function testGetSheetHigh()
    {
        $sheet = new SheetFormat();
        $sheet->addSheetFormat(2500, 1250, $this->sizeChecker);
        $expectSideHigh = 2500;
        $expectSideWidth = 1250;
        $actualSideHigh = $sheet->getSheetHeight();
        $actualSideWidth = $sheet->getSheetWidth();
        $this->assertEquals($expectSideHigh, $actualSideHigh);
        $this->assertEquals($expectSideWidth, $actualSideWidth);
    }

    public function testLongSidesSheet()
    {
        $sheet = new SheetFormat();
        $sheet->addSheetFormat(1300, 2700, $this->sizeChecker);
        $expectSideHigh = 2700;
        $expectSideWidth = 1300;
        $actualSideHigh = $sheet->getSheetHeight();
        $actualSideWidth = $sheet->getSheetWidth();
        $this->assertEquals($expectSideHigh, $actualSideHigh);
        $this->assertEquals($expectSideWidth, $actualSideWidth);
    }

    public function testAddSheetFormatWith0SizeSide()
    {
        $this->expectException("\InvalidArgumentException");
        $sheet = new SheetFormat();
        $sheet->addSheetFormat(0, 0, $this->sizeChecker);
        $this->fail("the side length must be greater than zero");
    }

    public function testGetSheetHighWallWhenItIsNull()
    {
        $this->expectException("\InvalidArgumentException");
        $sheet = new SheetFormat();
        $high = $sheet->getSheetHeight();
        $this->fail("please specify the size of the sheet first");
    }

    public function testGetSheetWidthWallWhenItIsNull()
    {
        $this->expectException("\InvalidArgumentException");
        $sheet = new SheetFormat();
        $width = $sheet->getSheetWidth();
        $this->fail("please specify the size of the sheet first");
    }
}
