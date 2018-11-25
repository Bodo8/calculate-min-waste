<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 15.11.18
 * Time: 20:41
 */

namespace model;


class SizeChecker
{

    /**
     * SizeChecker constructor.
     */
    public function __construct()
    {
    }

    public function checkSides(int $sideHigh, int $sideWidth): void
    {
        if ($sideHigh <= 0 | $sideWidth <= 0) {
            throw new \InvalidArgumentException("the side length must be greater than zero");
        }
    }


}