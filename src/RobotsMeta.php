<?php

namespace OwenMelbz\RobotsTxt;

class RobotsMeta {

    public function render()
    {
        if ($this->shouldBlockRobots()) {
            return '<meta name="robots" content="noindex, nofollow">';
        }
    }

    private function shouldBlockRobots()
    {
        return config('robots_txt.block_robots') === true;
    }
}
