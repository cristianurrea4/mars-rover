<?php

namespace App;

class Rover
{
    private int $x;
    private int $y;
    private string $direction;
    private Grid $grid;

    private array $directions = ['N', 'E', 'S', 'W'];

    public function __construct(int $x, int $y, string $direction, Grid $grid)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = strtoupper($direction);
        $this->grid = $grid;
    }

    public function executeCommands(string $commands): array
    {
        $commands = strtoupper($commands);
        for ($i = 0; $i < strlen($commands); $i++) {
            $command = $commands[$i];
            if ($command === 'L') {
                $this->turnLeft();
            } elseif ($command === 'R') {
                $this->turnRight();
            } elseif ($command === 'F') {
                if (!$this->moveForward()) {
                    return [
                        'status' => 'obstacle',
                        'x' => $this->x,
                        'y' => $this->y,
                        'direction' => $this->direction
                    ];
                }
            }
        }

        return [
            'status' => 'ok',
            'x' => $this->x,
            'y' => $this->y,
            'direction' => $this->direction
        ];
    }

    private function turnLeft(): void
    {
        $index = array_search($this->direction, $this->directions);
        $this->direction = $this->directions[($index + 3) % 4];
    }

    private function turnRight(): void
    {
        $index = array_search($this->direction, $this->directions);
        $this->direction = $this->directions[($index + 1) % 4];
    }

    private function moveForward(): bool
    {
        $dx = 0;
        $dy = 0;

        switch ($this->direction) {
            case 'N': $dy = 1; break;
            case 'S': $dy = -1; break;
            case 'E': $dx = 1; break;
            case 'W': $dx = -1; break;
        }

        $newX = $this->x + $dx;
        $newY = $this->y + $dy;

        $this->grid->wrapCoordinates($newX, $newY);

        if ($this->grid->hasObstacle($newX, $newY)) {
            return false;
        }

        $this->x = $newX;
        $this->y = $newY;
        return true;
    }
}