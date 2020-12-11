// Asset Manufacturers 画面へ遷移
$browser
  ->waitForText('Support Email')
  ->assertPathIs('/manufacturers')
  ->assertSee('Asset Manufacturers')
;



