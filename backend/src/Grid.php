<?php

namespace App;

class Grid {
    private $width;
    private $height;

    public function __construct($width = 5, $height = 5) {
        $this->width = $width;
        $this->height = $height;
    }

    public function isPositionValid($x, $y) {
        return $x >= 0 && $x < $this->width && $y >= 0 && $y < $this->height;
    }
}
