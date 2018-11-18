<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 14.11.18
 * Time: 21:27
 */

namespace Model;

use PHPUnit\Framework\TestCase;

class BoxTest extends TestCase
{

    private $box;
    private $sizeChecker;
    private $sheetFormat;

    public function setUp()
    {
        $this->sizeChecker = new SizeChecker();
        $this->sheetFormat = new SheetFormat();
        $this->sheetFormat->addSheetFormat(2500, 1250, $this->sizeChecker);
        $this->box = new Box(450, 600,
            200, 300,
            200, 300, 2,
            $this->sizeChecker);
    }

    public function testAddBox()
    {
        $expectSizeA = 450;
        $actualSizeA = $this->box->getWallAOfTheBoxWidth();
        $this->assertEquals($expectSizeA, $actualSizeA);

    }

}
