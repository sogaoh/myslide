// 左上の navigation を click
// してサブメニューを表示
$browser->driver->findElement(
  WebDriverBy::xpath($navigationXpath)
)->click();
$browser
  ->waitForText('Requestable')
  ->assertSee('Settings');
