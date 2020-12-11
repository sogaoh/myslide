->assertSee('E-mail Address')
->assertDisabled('#agreeSubmit')
->keys('#interimEmail01', Const::EMAIL, '{tab}','{tab}')  //入力後にフォーカスを移す
->script('window.scrollTo(0, 500);'); //ボタンを画面内に収まるように

//reCAPTCHA対策
$browser->script(
  "document.querySelector('#agreeSubmit').disabled = ''"
);
$browser->press('[type="submit"]')
