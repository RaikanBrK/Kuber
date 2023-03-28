<?php

namespace Kuber\Traits;

use \Browser as cbsBrowser;

trait Browser
{
    private $allowedBrowsers = [
        'Chrome',
        'Firefox',
        'Safari',
        'Opera',
        'Edge',
    ];

    private $other = 'Other';

    public function __get($attr)
    {
        return $this->$attr;
    }

    protected function browser()
    {
        $browser = new cbsBrowser();
        $agent = $browser->getBrowser();

        return in_array($agent, $this->allowedBrowsers) ? $agent : $this->other;
    }
}