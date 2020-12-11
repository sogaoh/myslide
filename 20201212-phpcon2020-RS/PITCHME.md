@toc[Opening]

[drag=100 60, drop=top]
## 本番でしか起きない問題に<br>早く気が付けるように、<br>僕は Laravel Dusk で CI する

[drag=100 65, drop=bottom]
### 2020.12.12

[drag=100 45, drop=bottom]
### @color[#00aced](@fa[twitter-square]) [@sogaoh](https://twitter.com/sogaoh)

[drag=100 20, drop=bottom]
@css[text-gray](25 min Regular Session [Track4-4-A] @) @css[nobr]([PHP Conference Japan 2020](https://phpcon.php.gr.jp/2020/))


+++

[drag=32 16, drop=5 0, set=h2-gray align-left]
## AGENDA

[drag=60 40, drop=5 18, fit=1.4, set=align-left]
- 本番でしか起きない問題
- 平和を求め CI を育てる
- Laravel Dusk を載せる
- まとめ・Appendix

[drag=100 10, drop=5 60, fit=1.2, set=align-left]
資料は公開してあります -> [https://kutt.it/cpvRco](https://kutt.it/cpvRco) @css[text-07]([※'21/02 まで])

[drag=100 24, drop=5 68, fit=0.8, set=align-left]
@css[lh-10](※1. 履歴が増殖するため、@color[yellow](シークレットウィンドウ)でご覧ください（Chromeを推奨）<br>※2. ところどころの@color[orange](オレンジ)の文字はリンクになっています<br>※3. @color[yellow](スペース)で次のページに進みます（[o]でOverviewが見れます）)
<!-- 見辛い場合に備えて @color[#009287](@fab[speaker-deck]) [SpeakerDeck](https://speakerdeck.com/sogaoh/ben-fan-desikaqi-kinaiwen-ti-nizao-kuqi-gafu-keruyouni-pu-ha-laravel-dusk-de-ci-suru) にもあります。-->

+++

[drag=40 16, drop=5 0, set=h2-gray align-left]
## This talk for

[drag=100 50, drop=5 20, fit=1.4, set=align-left]
- リリース後に、確認不足のため<br>切り戻すことになりたくない開発者<br><br>
- 本番で起きるデグレードのたびに<br>ビジネスサイドから詰められたくないQA担当者

[drag=100 20, drop=5 70, fit=1.6, set=align-left text-bold text-green]
「備え万全」でありたい方へ


+++

[drag=30 16, drop=5 0, set=text-bold h2-gray align-left]
## 自己紹介

[drag=35 40 , drop=5 18, set=align-left]
![sogaoh-bio](/20201212-phpcon2020-RS/img/sogaoh-bio.png)  

[drag=35 10, drop=5 60, set=align-left]
@css[text-10](@sogaoh : Hisashi SOGA)

[drag=35 20, drop=5 70, set=align-left]
- @css[text-08](Freelance '19/02〜)
- @css[text-08](Web Enginieer[PHP] '12〜)
- @css[text-07](former Java,C development)

[drag=58 25, drop=42 5, fit=1.0, set=align-left]
- '20/09 [エンジニアの成長を応援する本2](https://techbookfest.org/product/71750011) 寄稿
- '20/07 [July Tech Festa 2020](https://sogaoh.hatenablog.com/entry/2020/07/25/233956) 登壇(15分) @color[#FF0000](@fa[youtube-play]) <!-- https://www.youtube.com/channel/UCKLoUvohjwyohYzKTRyeUBQ/videos -->
- '20/04 [Covid19Radar](https://github.com/Covid-19Radar/Covid19Radar/pull/20)にContribute(1文字)<br><br>

[drag=58 25, drop=42 30, fit=1.0, set=align-left]
- '20/02 [PHPerKaigi2020](https://sogaoh.hatenablog.com/entry/2020/02/11/180000) 当日スタッフ
- '20/01 [SRE NEXT 2020](https://sogaoh.hatenablog.com/entry/2020/01/27/083113) コアスタッフ
- '19/12 [PHP Conference Japan 2019](https://sogaoh.hatenablog.com/entry/2019/12/02/100752) LT<br><br>

[drag=54 30, drop=42 60, fit=1.0, set=align-left]
Several communities belonging<br><br>
![communities](/20201212-phpcon2020-RS/img/communities.png)

+++

[drag=30 16, drop=5 0, fit=1.2, set=text-bold h3-gray align-left]
### 最近の活動

[drag=30 56, drop=5 20]
@tweet[https://twitter.com/sogaoh/status/1320166019336335361]

[drag=30 35, drop=35 20]
@tweet[https://twitter.com/sogaoh/status/1330360325284134912]

[drag=30 60, drop=65 20]
@tweet[https://twitter.com/sogaoh/status/1322550612735660034]

[drag=30 35, drop=35 58]
@tweet[https://twitter.com/sogaoh/status/1318126716850556928]


---
@toc[本番でしか起きない問題たち]

[drag=100 32, drop=0 20, fit=1.2, set=text-bold]
## 本番でしか起きない問題たち

[drag=100 80, drop=0 30, fit=1.8]
こんなこと、ありますか？


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## Login前 (1) 

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
＿人人人人人人人＿
＞　起動しない　＜
￣Y^Y^Y^Y^Y^Y^￣

@code[php, drag=48 45, drop=50 5, fit=1.0, set=align-left fragment](/20201212-phpcon2020-RS/src/BeforeLogin1.php)

[drag=90 40, drop=5 55, fit=1.2, set=align-left fragment]
@fa[quote-left](プロダクション環境がLinuxなので、大文字小文字が<br>一致していないとオートロードが失敗するが、<br>開発環境がMac/Windowsなので開発時は気づかない)
[phpcs-psr4-sniff:クラスがPSR-4に準拠しているかチェックするツールを作った - Qiita](https://qiita.com/suin/items/f3749d27b740cdbc1f80#%E3%81%AA%E3%81%9C%E4%BD%9C%E3%81%A3%E3%81%9F%E3%81%8B)

+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## Login前 (2) 

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
＿人人人人人人人人人＿
＞　問合せが来ない　＜
￣Y^Y^Y^Y^Y^Y^Y^Y^￣

@code[ini, drag=48 45, drop=50 5, fit=1.0, set=align-left fragment](/20201212-phpcon2020-RS/src/BeforeLogin2.env)

[drag=90 40, drop=5 55, fit=1.2, set=align-left fragment]
- AWS ECS タスク定義に 環境変数 MAIL_ENCRYPTION が<br>設定されてなかった...
- 開発環境では運用との区別の意図で別のSMTPサービス：[Mailgun](https://www.mailgun.com/) を用いていた...<br>（検証ではうまくいっていた）


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## Login前 (3) 

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
＿人人人人人人人人人人＿
＞　ログインできない　＜
￣Y^Y^Y^Y^Y^Y^Y^Y^Y￣

@code[json, drag=45 45, drop=55 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/BeforeLogin3.json)

[drag=90 40, drop=5 55, fit=1.2, set=align-left fragment]
- [AWS CodeDeploy での Blue/Green デプロイ](https://docs.aws.amazon.com/ja_jp/AmazonECS/latest/userguide/deployment-type-bluegreen.html)時に置換(ECS)タスクセットへのルーティングが行われるが、(おそらく)上位の front nginx が DNS をキャッシュしていて、back nginx の IPアドレスを入れ替わったものに変えていなかった<br>（次項に参考の構成概要図）


+++

[drag=40 10, drop=5 5, set=text-bold h2-gray align-left]
### 参考：構成概要図

@cloud[drag=90 90, drop=5 10, set=fragment](/20201212-phpcon2020-RS/src/BeforeLogin3.py)


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## Login後 (1) 

[drag=50 30, drop=5 20, fit=1.4, set=align-left align-center]
＿人人人人人人人人人人＿
＞ ある画面が500エラー ＜
￣Y^Y^Y^Y^Y^Y^Y^Y^Y￣

@code[lua, drag=45 45, drop=55 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/AfterLogin1.sh)

[drag=90 40, drop=5 55, fit=1.2, set=align-left fragment]
- 突然、フレームワークに必要なディレクトリが消えてしまっていた。応急処置としてディレクトリを作成し、暫定的にパーミッションをフルコントロール(777)に設定して回避
- (デプロイ時に適切にオーナー・パーミッションを設定する・必要なディレクトリへの書込監視を行うのが良さそう)


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## Login後 (2) 

[drag=50 30, drop=5 20, fit=1.4, set=align-left align-center]
＿人人人人人人人人人＿
＞　翻訳間違ってる　＜
￣Y^Y^Y^Y^Y^Y^Y^Y^￣

![drag=45 45, drop=50 5, stretch=true, set=align-bottom fragment](/20201212-phpcon2020-RS/img/AfterLogin2.png)

[drag=90 40, drop=5 55, fit=1.2, set=align-left fragment]
- 全言語の表示チェックがやりきれていない
- とはいえ、人力で網羅的に全言語分を点検するのには限界があり、一部は機械翻訳を <s>恒久的</s> 暫定的 に使うケースも許容されている現場が多そう


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## Login後 (3) 

[drag=50 30, drop=5 20, fit=1.4, set=align-left align-center]
＿人人人人人人人人人人＿
＞ サムネイルの出方が変 ＜
￣Y^Y^Y^Y^Y^YY^Y^Y^￣

![drag=40 45, drop=55 5, stretch=true, set=align-bottom fragment](/20201212-phpcon2020-RS/img/AfterLogin3.png)

[drag=90 40, drop=5 55, fit=1.2, set=align-left fragment]
- [Amazon S3バージョン 3 での の署名付き URL - AWS SDK for PHP](https://docs.aws.amazon.com/ja_jp/sdk-for-php/v3/developer-guide/s3-presigned-url.html) をよく見るまで、有効期限の指定時に + 符号を入れる必要があることに気付けなかった
- [Laravel ファイルストレージ の ファイル視認性](https://readouble.com/laravel/5.8/ja/filesystem.html#file-visibility) を正しく設定していなかった


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## その他

[drag=90 24, drop=5 20, fit=1.2, set=align-left align-center]
- @css[text-14](webpackのビルドが終わらない...)
   - NODE_OPTIONS の max-old-space-size を調整したり UV_THREADPOOL_SIZE を使ってみたり

[drag=90 60, drop=5 40, fit=1.2, set=align-left align-center]
- @css[text-14](AWS費用が高い...)
   - Blue/Green デプロイで稼働していない方の ECS の desiredCount を制御しようとしてみたが datadog-agent container が schedulingStrategy : "REPLICA" をサポートしてないので踏み切れていない（ [ecspresso](https://github.com/kayac/ecspresso) うまく使いたい） 

---
@toc[平和を求めて CI を育てる]

[drag=100 32, drop=0 20, fit=1.2, set=text-bold]
## 平和を求めて CI を育てる

[drag=100 80, drop=0 30, fit=1.8]
プロダクトと、いっしょに。


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## はじめから Test 

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
graphql-playground と
同じことを Feature テスト

@code[php, drag=45 45, drop=50 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/AbstractGraphQLTestCase.php)

[drag=90 20, drop=5 52, fit=1.2, set=align-left fragment]
- [Laravel 5.7+GraphQL(Test編)-Qiita](https://qiita.com/ucan-lab/items/1815071cd1cf32d53008) を参考に抽象クラスを作成
- 想定結果(JSON)を読み取る共通関数を通して assertJson 

[drag=90 12, drop=10 70, fit=0.8, set=align-left fragment]
```php
$response = $this->graphql($query);
$response->assertStatus(Response::HTTP_OK)->assertJson($expected);
```

[drag=90 10, drop=5 82, fit=1.2, set=align-left fragment]
- 入力graphql・出力jsonをループで回す（容易にケース追加）


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## Test DB を使う

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
Repository の Unit テスト
(CRUD も 普通に)

@code[php, drag=45 45, drop=50 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/AbstractDBRepositoryTestCase.php)

[drag=90 40, drop=5 52, fit=1.2, set=align-left fragment]
- setUp で migrate を１回だけに抑制し DatabaseSeeder 実行
- 登録・更新系は Test 終了時に rollback して後続影響を排除
- 例外発生の検証も finally で rollback して実現
- 必要に応じて tearDownAfterClass で truncate なども


+++

[drag=70 16, drop=5 0, set=text-bold h2-gray align-left]
## CI を作る

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
docker-compose.yml を
紐解き、CI環境を整える

@code[yml, drag=45 45, drop=50 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/docker-compose.yml)

[drag=90 20, drop=5 52, fit=1.2, set=align-left fragment]
- 個々人のPCスペックで Unit Test がやり切れない（メモリ足りない）問題がCI化の発端
- 準備プロセスは [Makefile](https://github.com/sogaoh/snipe-it/blob/dusk/Makefile) でほぼ整えてあった

[drag=90 16, drop=10 70, fit=0.8, set=align-left fragment]
```yml
- make ci-up
- docker-compose exec -T appback make vendor
```

[drag=90 12, drop=5 82, fit=1.2, set=align-left fragment]
- 普段からの開発環境整備簡素化が重要局面で活きる


+++

[drag=40 10, drop=5 5, set=text-bold h2-gray align-left]
### 余談A：CIの定期実行

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
注意事項は、
UTC で設定すること

@code[sh, drag=45 45, drop=50 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/bitbucket-pipelines_schedule.sh)

[drag=90 40, drop=5 50, fit=1.2, set=align-left fragment]
- [Scheduled pipelines | Bitbucket Cloud | Atlassian Documentation](https://ja.confluence.atlassian.com/bitbucket/scheduled-pipelines-933078702.html) を見て、分指定のスケジュールは API で設定することを知り、[APIドキュメント](https://developer.atlassian.com/bitbucket/api/2/reference/resource/repositories/%7Bworkspace%7D/%7Brepo_slug%7D/pipelines_config/schedules/#post)などを調査
- [GitHub Actions では schedule イベント](https://docs.github.com/ja/free-pro-team@latest/actions/reference/events-that-trigger-workflows#%E3%82%B9%E3%82%B1%E3%82%B8%E3%83%A5%E3%83%BC%E3%83%AB%E3%81%97%E3%81%9F%E3%82%A4%E3%83%99%E3%83%B3%E3%83%88) で実現できそう
- [GitLab にも Pipeline schedules API](https://docs.gitlab.com/ee/api/pipeline_schedules.html) があり、可能そう


---
@toc[Laravel Dusk を CI に載せる]

[drag=100 32, drop=0 20, fit=1.2, set=text-bold]
## Laravel Dusk を<br>CI に載せる

[drag=100 80, drop=0 30, fit=1.8]
思いつきからのチャレンジだった


+++

[drag=40 10, drop=5 5, set=text-bold h2-gray align-left]
## Dusk とは？

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
e2e テストツールの１つ
ブラウザの自動操作を実現

@code[php, drag=45 45, drop=50 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/DuskTestCase.php)

[drag=90 20, drop=5 52, fit=1.2, set=align-left fragment]
- [利用が簡単なブラウザの自動操作／テストAPIを提供](https://readouble.com/laravel/5.8/ja/dusk.html)
- standalone の ChromeDriver を使用する（好みの Selenium compatible ドライバも使用可能）

[drag=90 12, drop=10 70, fit=0.8, set=align-left fragment]
```sh
composer require --dev laravel/dusk
```

[drag=90 10, drop=5 80, fit=1.2, set=align-left fragment]
- @color[yellow](@fa[exclamation-triangle]) `本番環境にDuskをインストールしてはいけません`

[drag=90 8, drop=10 88, fit=0.8, set=align-left fragment]
```sh
composer install --no-dev
```

+++

[drag=40 10, drop=5 5, set=text-bold h2-gray align-left]
## CI を拡張

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
backend テストに加えて
frontend ビルドも必要に

@code[dockerfile, drag=45 45, drop=50 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/Dockerfile.dusk)

[drag=90 40, drop=5 50, fit=1.2, set=align-left fragment]
- フロントエンドのビルドができるように、Dockerfile へ node.js と npm のインストールを追加
- 多言語表示ができるように Font と ["Locales alpine 3.9"](https://gist.github.com/Herz3h/0ffc2198cb63949a20ef61c1d2086cc0) を参考に [alpine-pkg-glibc](https://github.com/sgerrand/alpine-pkg-glibc) をインストールして locale を追加
- さらに念の為 [chromium と driver もインストール](https://blog.madworks.net/posts/2020/01/25-0243-php74-alpine-laravel-dusk/)


+++

[drag=50 10, drop=5 5, set=text-bold h2-gray align-left]
## 必須データの整備

[drag=45 30, drop=5 20, fit=1.4, set=align-left align-center]
e2eテスト成立に必要な
データをSeederで投入

@code[php, drag=45 45, drop=55 5, fit=0.8, set=align-left fragment](/20201212-phpcon2020-RS/src/BrowserTestDataSeeder.php)

[drag=90 30, drop=5 50, fit=1.2, set=align-left fragment]
- CI環境の起動-> バックエンドのアプリケーション配備 -> Migration・Seeder実行（データ投入）
- フロントエンドのアプリケーション配備（JSビルドを含む）

[drag=90 10, drop=5 80, fit=1.2, set=align-left fragment]
- これらを行ったうえで、`php artisan dusk` を実行


+++

[drag=50 10, drop=5 5, set=text-bold h2-gray align-left]
## CIに載せた効果

[drag=45 30, drop=5 20, fit=1.5, set=align-left align-center fragment]
@css[text-bold](自動でブラウザテストが<br>回せるようになった)

[drag=45 45, drop=55 5, fit=1.2, set=align-left fragment]
ログイン前の
- 起動しない
- 問合せが来ない
- (ログインできない)

![drag=16 22, drop=80 5, stretch=true, set=fragment](/20201212-phpcon2020-RS/img/hobo_fix.png)

[drag=45 45, drop=8 50, fit=1.2, set=align-left fragment]
ログイン後の
- ある画面が500エラー
- 翻訳間違ってる
- (サムネイルの出方が変)

![drag=16 22, drop=34 50, stretch=true, set=fragment](/20201212-phpcon2020-RS/img/hobo_fix.png)

[drag=45 45, drop=52 50, fit=1.5, set=align-left text-bold text-green fragment]
- 早く検出できることが増えた
- 守備範囲が広がった
- なぜ失敗？を考える<br>ようになった


---
@toc[Dusk Examples]

[drag=100 32, drop=0 0, fit=1.2, set=text-bold]
## (Dusk Examples)

[drag=100 10, drop=0 35, fit=1.6]
生デモは断念して動画です

[drag=100 30, drop=0 45, fit=1.4, set=align-leftfragment]
題材は [Snipe-IT という OSS を <br>fork して少し手を加えたもの](https://github.com/sogaoh/snipe-it)です<br>(Dusk Test を追加)

[drag=100 10, drop=0 80, fit=1.6]
はじめに状況説明を簡単にします



+++

[drag=55 10, drop=5 5, set=text-bold h2-gray align-left]
## 様々な操作の再現 (1)

[drag=100 20, drop=5 20, fit=1.4, set=align-left align-center]
ID・パスワードを入力して、ログインする

![drag=40 50, drop=5 40](/20201212-phpcon2020-RS/gif/snipe-it_1.gif)

@code[php, drag=50 55, drop=48 40, fit=1.0](/20201212-phpcon2020-RS/src/DuskTest1.php)


+++

[drag=55 10, drop=5 5, set=text-bold h2-gray align-left]
## 様々な操作の再現 (2)

[drag=100 20, drop=5 20, fit=1.4, set=align-left align-center]
プロフィールを編集する

![drag=40 50, drop=5 40, fit=1.4](/20201212-phpcon2020-RS/gif/snipe-it_2.gif)

@code[php, drag=50 55, drop=48 40, fit=1.0](/20201212-phpcon2020-RS/src/DuskTest21.php)
@code[php, drag=50 55, drop=48 40, fit=1.0, set=fragment](/20201212-phpcon2020-RS/src/DuskTest22.php)
@code[php, drag=50 55, drop=48 40, fit=1.0,set=fragment](/20201212-phpcon2020-RS/src/DuskTest23.php)


+++

[drag=55 10, drop=5 5, set=text-bold h2-gray align-left]
## 様々な操作の再現 (3)

[drag=100 20, drop=5 20, fit=1.4, set=align-left align-center]
Navigation を展開し、サブメニューを選択

![drag=40 50, drop=5 40, fit=1.4](/20201212-phpcon2020-RS/gif/snipe-it_3.gif)

@code[php, drag=50 55, drop=48 40, fit=1.0](/20201212-phpcon2020-RS/src/DuskTest31.php)
@code[php, drag=50 55, drop=48 40, fit=1.0, set=fragment](/20201212-phpcon2020-RS/src/DuskTest32.php)
@code[php, drag=50 55, drop=48 40, fit=1.0,set=fragment](/20201212-phpcon2020-RS/src/DuskTest33.php)


+++

[drag=70 12, drop=5 3, set=text-bold h2-gray align-left]
## それではごらんください (1)

[drag=80 8, drop=10 88, fix=0.6, set=align-right]
https://youtu.be/TCt6wnf5C-k

![drag=72 72, drop=14 15](https://www.youtube.com/embed/TCt6wnf5C-k)


+++

[drag=70 12, drop=5 3, set=text-bold h2-gray align-left]
## それではごらんください (2)

[drag=80 8, drop=10 88, fix=0.6, set=align-right]
https://youtu.be/pujAkC49gYE

![drag=72 72, drop=14 15](https://www.youtube.com/embed/pujAkC49gYE)


+++

[drag=55 10, drop=5 5, set=text-bold h2-gray align-left]
### 余談B：reCAPTCHAの突破

![drag=40 16, drop=58 5, stretch=true](/20201212-phpcon2020-RS/img/reCAPTCHA.png)

[drag=100 10, drop=5 25, fit=1.2, set=align-left align-center]
(例) `#Submit` ボタンを script で解放

@code[php, drag=90 55, drop=5 40, fit=1.0,set=fragment](/20201212-phpcon2020-RS/src/reCAPTCHA_Thru.php)


---
@toc[Closing]

[drag=40 16, drop=5 5, fit=1.4, set=text-bold align-left]
## まとめ

[drag=100 80, drop=5 0, fit=1.4, set=align-left fragment]
- プロダクトに潜む落とし穴は数知れず、<br>動かしてみないとわからないことがたくさんある。

[drag=100 80, drop=5 20, fit=1.4, set=align-left fragment]
- それを巡回する手段の１つとして選択したのが<br>Laravel Dusk。けっこうオススメできる。

[drag=100 80, drop=5 40, fit=1.4, set=align-left fragment]
- CI を組んでプロダクト一式の構造を掴むことは、<br>自分の力にもチームの力にも大いになる。


+++

[drag=96 16, drop=5 0, set=text-bold h2-gray align-left]
## Appendix (1)

[drag=95 70, drop=5 18, fit=1.0, set=align-left]
- [PSR-4: Autoloader - PHP-FIG](https://www.php-fig.org/psr/psr-4/)
- [Flexible Pricing & Email Delivery Plans - Email API Service | Mailgun](https://www.mailgun.com/plans-and-pricing/)
  - @css[text-08](Flex Plan は 3 months 以降 5000 通を超えると$0.80 / 1000 emails) 
- [TLS暗号化対応｜Cuenote FC](https://www.cuenote.jp/fc/capability/starttls.html)
- [nginx の名前解決について - Qiita](https://qiita.com/toshihirock/items/1c711a7e9f054605323f)
- [Nginx のDNS 名前解決とS3 やELB へのリバースプロキシ](https://yulii.github.io/nginx-dns-cache-20150815.html)
- [Cloud Diagrams - GitPitch Documentation](https://docs.gitpitch.com/#/diagrams/cloud-architecture)
- [Diagrams · Diagram as Code](https://diagrams.mingrammer.com/)
- [Amazon ECS - (Datadog) Agent をデーモンサービスとして実行](https://docs.datadoghq.com/ja/agent/amazon_ecs/?tab=awscli#agent-%E3%82%92%E3%83%87%E3%83%BC%E3%83%A2%E3%83%B3%E3%82%B5%E3%83%BC%E3%83%93%E3%82%B9%E3%81%A8%E3%81%97%E3%81%A6%E5%AE%9F%E8%A1%8C)
- [ecspresso Advent Calendar 2020](https://adventar.org/calendars/5916)



+++

[drag=96 16, drop=5 0, set=text-bold h2-gray align-left]
## Appendix (2)

[drag=95 70, drop=5 18, fit=1.0, set=align-left]
- [UnitTestを効率的に作り・回す継承](https://fortee.jp/object-oriented-conference-2020/proposal/df87fcae-8aed-41b6-9acf-43344d6765ed)
- [Laravel開発での手間を少なくするMakefile作戦](https://fortee.jp/laravel-jp-conference-2020/proposal/ab619ef2-b905-4132-8429-45ee5b2859b9)
- [Snipe-IT Free open source IT asset management](https://snipeitapp.com/) -> @fa[github] [GitHub](https://github.com/snipe/snipe-it)
- [Solved: What is wrong to create pipeline schedule ? - Atlassian Comunity](https://community.atlassian.com/t5/Bitbucket-Pipelines-questions/What-is-wrong-to-create-pipeline-schedule/qaq-p/1443953)
- [Free Online Cron Expression Generator and Describer - FreeFormatter.com](https://www.freeformatter.com/cron-expression-generator-quartz.html)
- [laravel5.5でduskがうごかへんねん - Qiita](https://qiita.com/chtzmrtshgh/items/cea990e1d6bbd60bd823)
- [Dockerfile に apt, apt-get, source コマンドを書く時のTips](https://tech-blog.cloud-config.jp/2019-09-09-dockerfile-apt-apt-get-source-tips/)
- [Complex Selectors in Dusk](https://laracasts.com/discuss/channels/testing/complex-selectors-in-dusk)
- [Laravel Dusk on Homestead | by Mike Smith | Medium](https://medium.com/@splatEric/laravel-dusk-on-homestead-dc5711987595)
- [Laravel Dusk テストコード作成時の困った場合の対処法 | LaptrinhX](https://laptrinhx.com/laravel-dusk-tesutokodo-zuo-cheng-shino-kuntta-chang-heno-dui-chu-fa-121875384/)
- [Selenium webdriverメソッド~PHP~ - Qiita](https://qiita.com/yukanashi/items/9c32891171dd09c40be2)

+++

[drag=100 24, drop=5 16, fit=1.4]
お気づきの点あれば<br>@color[#00aced](@fa[twitter-square]) [@sogaoh](https://twitter.com/sogaoh) まで

[drag=100 24, drop=5 40, fit=1.4]
Discord @color[#7289DA](@fab[discord]) Ask the Speaker へも<br>お気軽にどうぞ -> [#track4-4-a-laravel-dusk](https://discord.com/channels/771998946854830111/775879941048893441)

[drag=100 16, drop=5 70, fit=1.2]
(End)
