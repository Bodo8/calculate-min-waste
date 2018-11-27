<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 17.11.18
 * Time: 19:30
 */

namespace Tests\Generators;


use Model\Box;
use Model\SheetFormat;
use model\SizeChecker;

class BoxGenerator
{

    private static $tabWithSizeBoxes = [600, 250, 100, 200, 100, 200, 7,
        300, 125, 50, 100, 50, 100, 8,
        1200, 500, 400, 200, 400, 200, 12, 300, 125, 100, 50, 100, 50, 9,
        300, 125, 50, 100, 50, 100, 8, 300, 125, 100, 50, 100, 50, 9,
        600, 250, 100, 200, 100, 200, 7, 600, 250, 100, 200, 100, 200, 7,
        300, 125, 50, 100, 50, 100, 8, 300, 125, 50, 100, 50, 100, 8,
        1200, 500, 400, 200, 400, 200, 12, 300, 125, 100, 50, 100, 50, 9,
        1200, 500, 400, 200, 400, 200, 12, 300, 125, 100, 50, 100, 50, 9,
        1200, 500, 400, 200, 400, 200, 12, 300, 125, 100, 50, 100, 50, 9,
        1200, 500, 400, 200, 400, 200, 12, 300, 125, 100, 50, 100, 50, 9,
        1200, 500, 400, 200, 400, 200, 12, 300, 125, 100, 50, 100, 50, 9,
        200, 50, 50, 200, 50, 200, 5];

    private static $tabWithThreeSmallBoxes = [300, 125, 50, 100, 50, 100, 8,
        200, 50, 50, 200, 50, 200, 5, 100, 25, 25, 100, 25, 100, 3];

    private static $tabWithThreeSmallBoxesAndZeroStubTube = [300, 125, 50, 100, 50, 100, 0,
        200, 50, 50, 200, 50, 200, 0, 100, 25, 25, 100, 25, 100, 0];

    public static function generateBoxes(Box $box): void
    {
        $tabWithSizeBoxes = BoxGenerator::$tabWithSizeBoxes;
        $sizeChecker = new SizeChecker();
        $sheetFormat = new SheetFormat();
        $sheetFormat->addSheetFormat(2500, 1200, $sizeChecker);
        $i = 0;
        $index = 0;

        while ($index < count($tabWithSizeBoxes) / 7) {
            $box->addBox($tabWithSizeBoxes[$i], $tabWithSizeBoxes[$i + 1],
                $tabWithSizeBoxes[$i + 2], $tabWithSizeBoxes[$i + 3], $tabWithSizeBoxes[$i + 4],
                $tabWithSizeBoxes[$i + 5], $tabWithSizeBoxes[$i + 6],
                $sizeChecker, $sheetFormat);
            $i += 7;
            $index++;
        }

    }

    public static function generateThreeSmallBoxes(Box $box): void
    {
        $tabWithSizeBoxes = BoxGenerator::$tabWithThreeSmallBoxes;
        $sizeChecker = new SizeChecker();
        $sheetFormat = new SheetFormat();
        $sheetFormat->addSheetFormat(2500, 1200, $sizeChecker);
        $i = 0;
        $index = 0;

        while ($index < count($tabWithSizeBoxes) / 7) {
            $box->addBox($tabWithSizeBoxes[$i], $tabWithSizeBoxes[$i + 1],
                $tabWithSizeBoxes[$i + 2], $tabWithSizeBoxes[$i + 3], $tabWithSizeBoxes[$i + 4],
                $tabWithSizeBoxes[$i + 5], $tabWithSizeBoxes[$i + 6],
                $sizeChecker, $sheetFormat);
            $i += 7;
            $index++;
        }
    }

    public static function generateThreeSmallBoxesAnnZeroStubTube(Box $box): void
    {
        $tabWithSizeBoxes = BoxGenerator::$tabWithThreeSmallBoxesAndZeroStubTube;
        $sizeChecker = new SizeChecker();
        $sheetFormat = new SheetFormat();
        $sheetFormat->addSheetFormat(2500, 1200, $sizeChecker);
        $i = 0;
        $index = 0;

        while ($index < count($tabWithSizeBoxes) / 7) {
            $box->addBox($tabWithSizeBoxes[$i], $tabWithSizeBoxes[$i + 1],
                $tabWithSizeBoxes[$i + 2], $tabWithSizeBoxes[$i + 3], $tabWithSizeBoxes[$i + 4],
                $tabWithSizeBoxes[$i + 5], $tabWithSizeBoxes[$i + 6],
                $sizeChecker, $sheetFormat);
            $i += 7;
            $index++;
        }

    }

    public static function getTabWithAllKeys(array $tabWithBoxes): array
    {
        $wallsTab = $tabWithBoxes[0];
        return array_keys($wallsTab);
    }
}
