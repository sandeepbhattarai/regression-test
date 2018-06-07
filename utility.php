<?php
namespace Facebook\WebDriver;



class utility
{
    private $driver;
    public function __construct($driver)
    {
        $this->driver = $driver;
        
    }
    function login()
    {
        $this->driver->get('https://demo.edumate.net/myedumate/myedumate5/web/app.php/login/');
        
        // input the username
        $username = $this->driver->findElement(WebDriverBy::id('textfield-1017-inputEl'))->sendkeys("admin");
        
        // input the password
        $passkey = $this->driver->findElement(WebDriverBy::id('textfield-1018-inputEl'))->sendkeys("640LC4e");
        sleep(3);
        // click on the login button
        $login = $this->driver->findElement(WebDriverBy::id('button-1021-btnInnerEl'))->click();
        
        // wait until the page is loaded
        $this->driver->wait(20)->until(WebDriverExpectedCondition::urlContains('dashboard'));
    }
}
?>