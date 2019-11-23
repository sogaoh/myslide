[Presentation Slide](https://gitpitch.com/sogaoh/myslide?p=20191201-phpcon2019-LT#/)

## PHP-CS-Fixerを IDEに取り込ませて PSRを強制する 開発スタイル

2019/12/01  
LT @ [PHPカンファレンス 2019](https://phpcon.connpass.com/event/151396/) [^1]  
Twitter HashTag: [#phpcon](https://twitter.com/search?f=tweets&vertical=default&q=%23phpcon)  

```
PHPの開発でコーディング規約をどうするかはどの現場でも悩ましい話だと思います。
キャメルケースにする / スネークケースにする、などある程度の選択は個々に必要になるものの、
PHP-CS-Fixerに整形を委ねるのも１つの手ではないかと思います。

現在自分が参画している開発プロジェクトではPHP-CS-Fixerを利用しているので、
利用中の課題点と自分が感じた「クセ」について、簡単にお話しできればと思います。
```

- ToC
    - [PHP-CS-Fixer](#PHP-CS-Fixer)
    - [IDEでの設定](#IDEでの設定)
        - [PhpStorm など](#PhpStorm)
        - [Visual Studio Code](#Visual_Studio_Code)
    - [利用における注意点](#利用における注意点)
    - [PSR](#PSR)

### PHP-CS-Fixer
- コーディング規約チェック＋自動修正ツール
- FriendsOfPHP/PHP-CS-Fixer v2.16.0 
    - 2019/11/3 released
    - PHP 5.6.0 以上
- fix コマンド一発で自動修正を行える
- .php_cs.dist/.php_cs に設定
    - 採用するルール
    - 除外対象
    - キャッシュ利用


### IDEでの設定
- 前提
    - PHP-CS-Fixer のインストール
    - Rule ファイル（.php_cs.dist）の定義

#### PhpStorm
- File Watcher Plugin インストールが必要
- [Quality Tools] にモジュールの設定
- [Inspections] にルールセットの設定
- [File Watchers] で保存時に自動修正するための設定
    - [Scopes] で対象・除外ファイルを設定

#### Visual_Studio_Code
- fterrag.vscode-php-cs-fixer 拡張機能を利用する
- [Tool Path] にモジュールの設定
- [Config] にルールセットの設定
- [Fix On Save] で保存時に自動修正するかの設定
- Use Cache, Allow Risky は適宜

### 利用における注意点
- Laravel の Providers は除外
- ブランチを切り替えるときは fixOnSave を Off に
- コンテナ外での実行のほうが期待動作


### PSR
- PHP Standards Recommendations
- PHP-CS-Fixer に関連あるのは以下
    - PSR-1 : Basic Coding Standard
    - PSR-2 : Coding Style Guide -> DEPRECATED
    - PSR-5 : PHPDoc Standard -> DRAFT
- 設定で PSR-0, PSR-4 の指定も可能
- 今後は、PSR-12 : Extended Coding Style Guide




# Note
[^1]: [PHPカンファレンス2019 公式サイト](https://phpcon.php.gr.jp/2019/), [fortee トーク紹介ページ](https://fortee.jp/phpcon-2019/proposal/b6eddbf6-c938-4da3-b6f9-d50ecb50c7a7)  
