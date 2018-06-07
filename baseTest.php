<?php
namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
require_once ('vendor/autoload.php');

class baseTest
{

    protected $driver;

    public function __construct()
    {
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::chrome();
        $this->driver = RemoteWebDriver::create($host, $capabilities, 5000);
    }
}

?>

