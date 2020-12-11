class BrowserTestDataSeeder extends Seeder
{
  public function run()
  {
    DB::beginTransaction();
    try {
      $this->call([
        DuskTestDataSeeder::class,
      ]);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }
}
