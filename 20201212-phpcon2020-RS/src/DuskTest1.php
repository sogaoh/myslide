$browser->visit('/login')
  ->type('username', BrowserTestConst::USERNAME)
  ->type('password', BrowserTestConst::PASSWORD)
  ->press('Login')
  ->waitForText('Snipe-IT Demo')
  ->assertSee('Snipe-IT Demo')
  ->assertSee('Dashboard')
  ->assertSee('Recent Activity')
  ->assertSee('Assets by Status')
  ->assertSee('Asset Categories')
