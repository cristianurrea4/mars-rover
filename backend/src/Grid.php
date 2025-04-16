<?php

namespace App;

class Grid
{
    private int $width;
    private int $height;
    private array $obstacles;

    public function __construct(int $width = 200, int $height = 200, array $obstacles = [])
    {
        $this->width = $width;
        $this->height = $height;
        $this->obstacles = $obstacles;
    }

    public function hasObstacle(int $x, int $y): bool
    {
        foreach ($this->obstacles as $obs) {
            if ($obs['x'] === $x && $obs['y'] === $y) {
                return true;
            }
        }
        return false;
    }

    public function wrapCoordinates(int &$x, int &$y): void
    {
        $x = ($x + $this->width) % $this->width;
        $y = ($y + $this->height) % $this->height;
    }
}