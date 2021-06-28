<?php


class FirstTest extends PHPUnit_Extensions_Selenium2TestCase
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

    public function testTitle()
    {
        $this->url('');
        $this->assertEquals('HTML by Adam Morse, mrmrs.cc',$this->title());
    }

    public function testGettingElements()
    {
        $this->url('');
        $h1 = $this->byCssSelector('header h1'); //first element matched
      //  $h1 = $this->elements($this->using('css selector')->value('h1')); //return all elements
        $this->assertEquals('HTML',$h1->text());

        $field = $this->byId('first-name');
        $this->assertSame('', $field->value());
        // $this->assertSame('Adam', $field->attribute(('value')));

        $link = $this->byId('google-link-id');
        $link->click();
        $this->assertEquals('Google',$this->title());

       // $this->back(); back to previous page
       // $this->forward(); back to previous page
    }

    
}