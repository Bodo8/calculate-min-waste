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
    private $sheet;

    public function setUp()
    {
        $sizeChecker = new SizeChecker();
        $this->sheet = new SheetFormat();
        $this->sheet->addSheetFormat(2500, 1250, $sizeChecker);
    }

    public function testGetSheetHigh()
    {
        $expectSideHigh = 2500;
        $expectSideWidth = 1250;
        $actualSideHigh = $this->sheet->getSheetHigh();
        $actualSideWidth = $this->sheet->getSheetWidth();
        $this->assertEquals($expectSideHigh, $actualSideHigh);
        $this->assertEquals($expectSideWidth, $actualSideWidth);

    }
}
