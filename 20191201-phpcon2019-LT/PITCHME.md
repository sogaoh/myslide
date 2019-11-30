@snap[north-west]
## PHP-CS-Fixerを<br>IDEに取り込ませて<br>PSRを強制する<br>開発スタイル
@snapend

@snap[south]
2019/12/01  
@snap[text-06 text-gray]
@css[nobr](LT @ https://phpcon.php.gr.jp/2019/)
@snapend
@snapend


+++

@snap[north-west span-35 text-center]
### About Me 
<br>
Hisashi SOGA  
![sogahisashi-bio](/20191201-phpcon2019-LT/img/sogahisashi-bio.png)  
@color[#00aced](@fa[twitter-square]) [@sogaoh](http://twitter.com/sogaoh)  

@snapend


@snap[north-east span-60 text-08]
@box[bg-green](これまで # C++やJavaでライブラリなどの開発<br>2012年頃からWebの業界へ<br>サービス運用も5年くらい)
@snapend

@snap[east span-60 text-08]
@box[bg-blue](いまのところ # PHP on Laravel で新プロダクト開発<br>日々、連想配列とのたたかい<br>ユニットテストの番人も)
@snapend

@snap[south-east span-60 text-08]
@box[bg-purple](いずれは # 世を良くする取り組みに関わりたい<br>来年中に SSCP 認定を得たい<br>X年後には年収を２倍にしたい)
@snapend


---

@snap[north-west]
### はじめに
@snapend

@snap[north-west text-14]
<br>
<br>
秩序ある<br>
美しいコードを<br>
保つため<br>
@snapend

@snap[south-west text-17]
@color[yellow](なにか、してますか？)
<br>
@snapend

<!-- -->
@snap[west fragment]
<br><br>
![nagashima](/20191201-phpcon2019-LT/img/nagashima3-nanika.jpg)  
@snapend
<!-- -->


+++

@snap[north-west]
### 僕は、PHP-CS-Fixer
@snapend

@snap[north-west text-14]
<br>
<br>
- コーディング規約チェック<br>＋@color[red](自動修正)ツール
<br>
<br>
- [PHP Coding Standards Fixer](https://cs.symfony.com/) v2.16.1 
    - 2019/11/26 released
    - PHP 5.6.0 以上
@snapend

+++
@snap[north-west]
### PHP-CS-Fixerの特長
@snapend

@snap[north-west text-12]
<br>
<br>
- .php_cs.dist に設定を記述
    - @emoji[bangbang] @color[gold](使用するルール) 
      - [PHP-CS-Fixer configuration](https://mlocati.github.io/php-cs-fixer-configurator/) が超便利
    - @emoji[heavy_exclamation_mark] @color[silver](除外対象)  
    - @size[0.6em](キャッシュを利用するか)
<br>
<br>
- fix @color[red](コマンド一発)で自動修正する
@snapend


---

@snap[north-west]
### IDEでの設定 : 前提
@snapend

@snap[north-west text-12]
<br>
<br>

@table[table-header](/20191201-phpcon2019-LT/csv/requirements.csv)
@snapend

@snap[south-west text-06]
※ Visual Studio Code をスペースの都合により省略して表記
<br>
@snapend


+++?image=/20191201-phpcon2019-LT/img/ide-phpstorm.png&position=95% 2%&size=187px 186px

@snap[north-west]
### PhpStorm (1)
@snapend

@snap[north-west text-10]
<br>
<br>

#### エディタ上で問題箇所にマーキングする設定 ※

@table[table-header](/20191201-phpcon2019-LT/csv/setting-phpstorm1.csv)
@snapend

@snap[south-west text-06]
※ 詳細は [Qiita...#エディタ上で問題箇所にマーキングする設定](https://qiita.com/sogahisashi/items/9c622743b0b3c1ca0f55#%E3%82%A8%E3%83%87%E3%82%A3%E3%82%BF%E4%B8%8A%E3%81%A7%E5%95%8F%E9%A1%8C%E7%AE%87%E6%89%80%E3%81%AB%E3%83%9E%E3%83%BC%E3%82%AD%E3%83%B3%E3%82%B0%E3%81%99%E3%82%8B%E8%A8%AD%E5%AE%9A) に記載
<br>
@snapend


+++?image=/20191201-phpcon2019-LT/img/ide-phpstorm.png&position=95% 2%&size=187px 186px

@snap[north-west]
### PhpStorm (2)
@snapend

@snap[north-west text-10]
<br>
<br>

#### @color[red](自動修正する設定 : 状況に応じてON/OFF) ※
@snapend
<br>
<table style="font-size:28px;">
  <tr>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <tr>
    <td colspan="3">[Preferences] > [Tools] > [File Watchers] で 新規作成 (+) </td>
  </tr>
  <tr>
    <td>Name</td>
    <td colspan="2">@color[pink](PHP-CS-Fixer)など</td>
  </tr>
  <tr>
    <td>Files to Watch</td>
    <td>File type: PHP, Scope: (後述)</td>
  </tr>
  <tr>
    <td>Tool to Run on Changes</td>
    <td>Program: (php-cs-fixer), <br>Arguments: (fix command...), <br>Output paths to refresh: @color[yellow]($FilePath$), <br>Working Directory: @color[yellow]($ProjectFileDir$)</td>
  </tr>
  <tr>
    <td>(Scope:)</td>
    <td>Name: @color[pink](fixer_scope)など, <br>Pattern: (対象に含む含まないとGUIで設定)</td>
  </tr>
</table>

@snap[south-west text-06]
※ 詳細は [Qiita...#ファイル保存時の自動修正設定](https://qiita.com/sogahisashi/items/9c622743b0b3c1ca0f55#%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E4%BF%9D%E5%AD%98%E6%99%82%E3%81%AE%E8%87%AA%E5%8B%95%E4%BF%AE%E6%AD%A3%E8%A8%AD%E5%AE%9A) に記載
<br>
@snapend


+++?image=/20191201-phpcon2019-LT/img/ide-vscode.png&position=95% 2%&size=187px 183px

@snap[north-west]
### Visual Studio Code
@snapend

@snap[north-west text-10]
<br>
<br>

#### Code > 基本設定 > 設定 から ※
@snapend

@snap[north-west text-08]
<br>
<br>
<br>
<br>
php-cs-fixer で絞り込むと容易に候補が提示される

@table[](/20191201-phpcon2019-LT/csv/setting-vscode.csv)
@snapend

@snap[south-west text-06]
※ 詳細は [Qiita...#visual-studio-code](https://qiita.com/sogahisashi/items/9c622743b0b3c1ca0f55#visual-studio-code) に記載
<br>
@snapend


---

@snap[north-west]
### @emoji[warning] 利用における注意点 @emoji[warning]
@snapend

@snap[north-west text-12]
<br>
<br>
- Laravel の app/Providers は修正対象から除外したほうがいい<br><br>
- ブランチを切り替えるときは fixOnSave を Off にしたほうがよさそう<br><br>
@snapend


+++

@snap[north-west]
### Laravelのapp/Providers除外
<br>
- @color[yellow](fixが効くと突然動かなくなることがある)<br><br>
- 他、ライブラリが自動生成する場合は要注意
    - [laravel-enum](https://github.com/BenSampo/laravel-enum), [lighthouse-php](https://lighthouse-php.com/master/api-reference/commands.html#scalar) など<br><br>
- 除外設定は切り出せるので分離するのが良さそう
    - refs [[php-cs-fixer] 除外(exclude)Finderの設定例](https://qiita.com/sogahisashi/items/551515a6dc3d83e57a01#%E8%A8%AD%E5%AE%9A%E4%BE%8B-php_csdist)
@snapend

+++

@snap[north-west]
### ブランチ切り替え時のfixOnSave
<br>
- @color[yellow](意図しない変更が急に多数発生して驚く)<br><br>
- メンバー全員が同一設定・同一運用なら変更は起きないはずだが、現実は孤高路線となることが多そう<br><br>
- PHP-CS-Fixerによる変更でTestの結果が変わることもまれにあるので、Testが整った状況下でないと運用に乗せられない
@snapend


---

@snap[north-west]
### おわりに
@snapend

<!-- @snap[north-west fragment] -->
@snap[north-west]
<br>
<br>
規模が大きいほど、秩序ある美しいコードを<br>
保つのは難しい。<br>
だからこそ、初めから習慣的に自動修正を<br>
採用することが、整った状態を維持する布石に<br>
なり得るのではないでしょうか。
<br>
@snapend

<!-- @snap[south-west text-14 <!--fragment] -->
@snap[south-west text-14]
@color[yellow](よき、「はじめのいっぽ」を)
<br>
@snapend

@snap[north-west text-18 fragment]
<br>
![ippo](/20191201-phpcon2019-LT/img/hajime-no-ippo.jpg)
@snapend


+++

@snap[north-west]
### Appendix
@snapend

@snap[west text-12]
- see @emoji[point_down]   
    - [Appendix of <br>phpcon2019-LT by sogaoh](https://esa-pages.io/p/sharing/6641/posts/543/79dadd6a5d3fea50adcc.html)

@snapend


+++

@snap[north-west]
### Disclaimer
(免責事項)<br><br>  
@snapend

@snap[west text-08]
- この資料は私見に基づいて作成しているため、なるべく<br>正確な情報を記載することを心がけてはいますが、<br>間違っている可能性があります。<br><br>
- ご質問・ご指摘等あれば @color[#00aced](@fa[twitter-square]) [@sogaoh](http://twitter.com/sogaoh) までご連絡ください。
@snapend

---

@snap[midpoint]  
(End)  
@snapend
