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
        $this->box = new Box();
    }

    public function testAddBox()
    {
        $this->box->addBox(450, 600,
            200, 300,
            200, 300, 2, $this->sizeChecker);
        $expectSizeA = 450;
        $boxesTab = $this->box->getTabWithBoxes();
        $oneBoxTab = $boxesTab[0];
        $actualSizeA = $oneBoxTab["wallAOfTheBoxHigh"];
        $this->assertEquals($expectSizeA, $actualSizeA);

    }

}
