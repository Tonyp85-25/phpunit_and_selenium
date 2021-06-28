<?php

class WaitingTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        // "--no-sandbox" and "--disable-dev-shm-usage"
        $this->setDesiredCapabilities(["chromeOptions"=>[
            "args"=>[
                // "no-sandbox",
                // "disable-dev-shm-usage",
                "headless"
            ],
            "w3c"=>false
        ]]);
        // $this->setHost('http://localhost:4444/wd/hub/static/resource/hub');
        //$this->setDesiredCapabilities((['firefoxOptions'=>['w3c'=>false]]));
        // phpunit does not suppôrt w3c mode yet
        $this->setBrowserUrl('http://localhost:5500/src/testingHtmlPage.html');
        $this->setBrowser('chrome');
    }

    public function testExplicitWait()
    {
        $this->url('');
        $driver=$this;
        $this->waitUntil(function()use($driver){
            $item = $driver->byId('first-name');
            if($item->value() === 'Adam') return true;
            return null;
        },4000);

        $this->assertSame('Adam',$this->byId('first-name')->value());
    }
}