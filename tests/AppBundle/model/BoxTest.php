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

    public function setUp()
    {
        $this->box = new Box();
        $this->sizeChecker = new SizeChecker();
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

    public function testAddBoxWith0size()
    {
        $this->expectException("\InvalidArgumentException");
        $this->box->addBox(450, 0,
            200, 300,
            200, 300, -1);
        $this->fail("the side length must be greater than zero,
            or quantity stub tube can be 0");
    }

    public function testAddBoxWithMinus1StubTube()
    {
        $this->expectException("\InvalidArgumentException");
        $this->box->addBox(450, 200,
            200, 300,
            200, 300, -1);
        $this->fail("the side length must be greater than zero,
            only quantity stub tube can be 0");
    }

}
