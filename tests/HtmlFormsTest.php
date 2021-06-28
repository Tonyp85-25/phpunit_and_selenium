
<?php

class HtmlFormsTest extends PHPUnit_Extensions_Selenium2TestCase
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
    
    public function testForms()
    {
        $this->url('');
        $this->select($this->byId('option-element'))->selectOptionByLabel("Option 2");
        $this->assertSame('Option 2', $this->select($this->byId('option-element'))->selectedValue());

        $usernameInput = $this->byName('some_input_name');
        $usernameInput->value('Adam');
        //$usernameInput->clear();
        $this->assertSame('Adam', $usernameInput->value());

        $radios =$this->elements($this->using('css selector')->value('input[type="radio"]'));
        $radios[0]->click();

        $this->byCssSelector('input[type="checkbox"]')->click();

        $this->byTag('textarea')->value('Some text');

        $this->clickOnElement('submit-button');
       // $this->byId('submit-button')->submit(); does not care about frontend validation

        $this->assertContains('The form was sent!',$this->source());
    }

    public function testAnother()
    {
        // $this->markTestIncomplete('Firefox does not support this command yet');
       // $this->assertSame('John', 'John');

        $this->url('');

        $this->cookie()->add('user','logged-in')->set();
       // $this->cookie()->remove('user');

        $authCookie = $this->cookie()->get('user');
        $this->assertEquals('logged-in', $authCookie);
    }
}