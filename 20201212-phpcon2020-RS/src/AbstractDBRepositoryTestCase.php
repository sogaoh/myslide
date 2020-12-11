
protected function setUp(): void
{
  parent::setUp();
  $appEnv = config('app.env');
  if (!self::$migrated) {
    $this->artisan('migrate:fresh --seed');
    self::$migrated = true;
  }
}
