// Admin (User Name) を click して
// サブメニューを表示
$browser->driver->findElement(
  WebDriverBy::xpath($userMenuXpath)
)->click();
$browser
  ->waitForText('Edit Your Profile');
