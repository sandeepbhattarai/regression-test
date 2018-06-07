<?php
// An example of using php-webdriver.
// Do not forget to run composer install before and also have Selenium server started and listening on port 4444.
namespace Facebook\WebDriver;
require_once 'baseTest.php';
require_once 'utility.php';


class CreateNewContact extends BaseTest
{
    private $utility;
    public function __construct()
    {
        parent::__construct();
        $this->utility = new utility($this->driver);
    }
    public function startTest() 
    {
        // navigate to 'http://www.seleniumhq.org/'
        $this->utility->login();
        
        // click on the plus button
        $plusButton = $this->driver->findElement(WebDriverBy::id('edutoolbarnewbutton-1044-btnIconEl'));
        $plusButton->click();
        sleep(3);
        // selects contacts
        $contactsOption = $this->driver->findElement(WebDriverBy::id('edutoolbarnewbuttonmenuitem-1084-itemEl'));
        $contactsOption->click();
        sleep(3);
        // wait until staff is visible
        $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('edutoolbarnewbuttonmenuitem-1089-itemEl')));
        
        // select staff
        $newStaff = $this->driver->findElement(WebDriverBy::id('edutoolbarnewbuttonmenuitem-1089-itemEl'));
        sleep(3);
        $newStaff->click();
        
        // wait until the page is fully loaded
        $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::titleIs('New Staff General Tab'));
        // find the iframe element through tagname
        $iframe_e = $this->driver->findElement(WebDriverBy::tagName("iframe"));
        if ($this->checkOnlyOneIframePresent($iframe_e)) { // Function to getinto the iframe if only one iframe present
            $this->driver->switchTo()->frame($iframe_e);
        }
        
        // updating the firstname
        $staffFirstName = $this->driver->findElement(WebDriverBy::name('_firstname'))->sendkeys("Paul");
        // updating the surname
        $staffLastName = $this->driver->findElement(WebDriverBy::name('_surname'))->sendkeys("McCartney`");
        // storing the save button
        sleep(3);
        $saveButton = $this->driver->findElement(WebDriverBy::xpath('//*[@id="OperationDivSave"]/span'));
        // Calling the function to check if the save button turned green
        $this->checkSaveButtonGreen($saveButton, "opBarBtnLabel saved opBarBtnLabelDisabled");
        sleep(10);
        // switches out of the iframe
        $this->driver->switchTo()->defaultContent();
        // storing the search textbox and searching the created staff
        $searchCreatedStaffBox = $this->driver->findElement(WebDriverBy::id('textfield-1050-inputEl'))->sendkeys("Paul McCartney");
        sleep(3);
        // clicking the search button
        $searchCreatedStaffButton = $this->driver->findElement(WebDriverBy::id('button-1053-btnIconEl'))->click();
        
        // switching iframe
        $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::titleContains('Staff Profile Tab'));
        $iframe_e = $this->driver->findElement(WebDriverBy::tagName("iframe"));
        if ($this->checkOnlyOneIframePresent($iframe_e)) { // Function to getinto the iframe if only one iframe present
            $this->driver->switchTo()->frame($iframe_e);
        }
        // finding the delete button
        $deleteNewRecord = $this->driver->findElement(WebDriverBy::id('OperationDivDelete'))->click();
        sleep(3);
        
        // switching to alert
        $alertElement = $this->driver->wait()->until(WebDriverExpectedCondition::alertIsPresent());
        // accepting the alert
        $this->driver->switchTo()
            ->alert()
            ->accept();
        // waiting until the page reloads to contact lists
        $contactListPage = $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::titleIs('Contact List'));
        $errorMessage = "(New staff contact added and then deleted)";
        $this->checkTestpassed($contactListPage, $errorMessage);
        
        sleep(5);
        
        // Create new enquiry
        $this->driver->switchTo()->defaultContent();
        $plusButton = $this->driver->findElement(WebDriverBy::id('edutoolbarnewbutton-1044-btnIconEl'));
        $plusButton->click();
        $contactsOption = $this->driver->findElement(WebDriverBy::id('edutoolbarnewbuttonmenuitem-1081-itemEl'));
        $contactsOption->click();
        $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('edutoolbarnewbuttonmenuitem-1083-itemEl')));
        $newEnquiry = $this->driver->findElement(WebDriverBy::id('edutoolbarnewbuttonmenuitem-1083-itemEl'))->click();
        $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::titleIs('New Inquiry General Tab'));
        $iframe_e = $this->driver->findElement(WebDriverBy::tagName("iframe"));
        if ($this->checkOnlyOneIframePresent($iframe_e)) { // Function to getinto the iframe if only one iframe present
            $this->driver->switchTo()->frame($iframe_e);
        }
        $parentOneFirstName = $this->driver->findElement(WebDriverBy::name('parent1_firstname'))->sendkeys("Will");
        $parentOneSurName = $this->driver->findElement(WebDriverBy::name('parent1_surname'))->sendkeys("Smith");
        $parentOneMobile = $this->driver->findElement(WebDriverBy::name('parent1_mobile_phone'))->sendkeys("0444444444");
        sleep(10);
        $studentOneFirstName = $this->driver->findElement(WebDriverBy::name('student1_firstname'))->sendkeys("Jaden");
        $studentOneSurName = $this->driver->findElement(WebDriverBy::name('student1_surname'))->sendkeys("Smith");
        sleep(5);
        $saveButton = $this->driver->findElement(WebDriverBy::xpath('//*[@id="OperationDivSave"]/span'));
        
        $this->checkSaveButtonGreen($saveButton, "opBarBtnLabel saved opBarBtnLabelDisabled");
        sleep(15);
        
        $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::titleContains('Student Profile Tab'));
        
        $deleteNewRecord = $this->driver->findElement(WebDriverBy::id('OperationDivDelete'))->click();
        sleep(3);
        // switching to alert
        $alertElement = $this->driver->wait()->until(WebDriverExpectedCondition::alertIsPresent());
        // accepting the alert
        $this->driver->switchTo()
            ->alert()
            ->accept();
        // waiting until the page reloads to contact lists
        $contactListPage = $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::titleIs('Contact List'));
        $errorMessage = "(New student contact added and then deleted)";
        $this->checkTestPassed($contactListPage, $errorMessage);
        
        $this->driver->switchTo()->defaultContent();
        // storing the search textbox and searching the created staff
        $searchBoxCreatedStaffBox = $this->driver->findElement(WebDriverBy::id('textfield-1050-inputEl'))->sendkeys("Will Smith");
        // clicking the search button
        $searchCreatedStaffButton = $this->driver->findElement(WebDriverBy::id('button-1053-btnIconEl'))->click();
        
        // switching iframe
        $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::titleContains('Profile Tab'));
        $iframe_e = $this->driver->findElement(WebDriverBy::tagName("iframe"));
        if ($this->checkOnlyOneIframePresent($iframe_e)) { // Function to getinto the iframe if only one iframe present
            $this->driver->switchTo()->frame($iframe_e);
        }
        // finding the delete button
        $deleteNewRecord = $this->driver->findElement(WebDriverBy::id('OperationDivDelete'))->click();
        sleep(3);
        
        // switching to alert
        $alertElement = $this->driver->wait()->until(WebDriverExpectedCondition::alertIsPresent());
        // accepting the alert
        sleep(3);
        $this->driver->switchTo()
            ->alert()
            ->accept();
        // waiting until the page reloads to contact lists
        $contactListPage = $this->driver->wait(20, 1000)->until(WebDriverExpectedCondition::titleIs('Contact List'));
        $errorMessage = "(New staff contact added and then deleted)";
        $this->checkTestpassed($contactListPage, $errorMessage);
    }

    

    // exception handling and making sure there is only one iframe present in the page
    private function checkOnlyOneIframePresent($iframe_element)
    {
        $iframeSize = count($iframe_element);
        
        if (! $iframeSize) {
            echo "iframe is not present\n";
            exit();
        } else if ($iframeSize == 1) {
            return true;
        } else {
            echo "more than one iframe present. !!REWRITE THE CODE!! \n";
            exit();
        }
    }

    // checking if the save button turns green when clicking on it
    private function checkSaveButtonGreen($button, $changedClassName)
    {
        $button->click();
        sleep(5); // waiting for the save button to turn green
        $afterSave = $button->getAttribute("class"); // getting the class after save
                                                     // checking if the class name has been changed
        if ($afterSave == $changedClassName) {
            echo "\nSave button turned green";
        } else {
            echo "\nSave Button did not turn green and form not saved ";
            exit();
        }
    }

    private function checkTestPassed($contactListPage, $errorMessage)
    {
        if ($contactListPage)
            echo "\nTest passed \n" . $errorMessage;
        
        else
            echo "Test Failed";
    }
}

$createNewContact = new CreateNewContact();
$createNewContact->startTest();

