// Settings -> Manufacturers
$browser->driver->findElement(
  WebDriverBy::xpath($settingsXpath)
)->click();
$browser
  ->waitForText('Manufacturers');
$browser->driver->findElement(
  WebDriverBy::xpath($manufacturersXpath)
)->click();
