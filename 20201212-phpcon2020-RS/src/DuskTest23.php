// Language を Japanese に変更して Save
$browser->driver->findElement(
  WebDriverBy::xpath($languageXpath)
)->click();
$browser->driver->findElement(
  WebDriverBy::xpath($japaneseXpath)
)->click();
$browser
  ->press('Save')
  ->waitForText('プロファイルを編集')  // 日本語に変わってる
  ->assertSee('Account successfully updated')
;
