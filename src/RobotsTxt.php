<?php

namespace OwenMelbz\RobotsTxt;

class RobotsTxt {

    protected static $template;

    public function generate()
    {
        $robots = ['User-agent: *'];

        if ($this->shouldBlockRobots()) {
            $robots[] = 'Disallow: /';
        } else {
            $robots[] = 'Allow: /';
        }

        $robots[] = '';

        $robotTemplate = explode("\n", file_get_contents(self::getTemplatePath()));
        $robots = array_merge($robots, $robotTemplate);

        if ($this->shouldIncludeSitemap()) {
            $robots[] = 'Sitemap: ' . asset('sitemap.xml');
        }

        return implode("\n", $robots);
    }

    private function shouldBlockRobots()
    {
        return config('robots_txt.block_robots') === true;
    }

    private function shouldIncludeSitemap()
    {
        return config('robots_txt.block_robots') === false && config('robots_txt.include_sitemap');
    }

    public static function setTemplatePath($path)
    {
        self::$template = $path;
    }

    public static function getTemplatePath()
    {
        return self::$template;
    }
}
