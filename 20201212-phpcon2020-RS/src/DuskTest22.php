// Edit Your Profile 画面へ遷移
$browser->driver->findElement(
  WebDriverBy::xpath($editProfileXpath)
)->click();
$browser
  ->waitForText('Gravatar Email Address (Private)')
  ->assertPathIs('/account/profile');
