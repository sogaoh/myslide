protected function driver()
{
  $options = (new ChromeOptions)->addArguments(['--disable-gpu','--headless','--window-size=1920,1080','--no-sandbox',]);
  return RemoteWebDriver::create(
    //'http://localhost:9515',
    'http://selenium:4444/wd/hub',
    DesiredCapabilities::chrome()->setCapability(
      ChromeOptions::CAPABILITY, $options
    )
  );
}
