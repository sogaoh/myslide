[Presentation Slide](https://gitpitch.com/sogaoh/myslide?p=20181211-Mackerel-Drink-Up-8#/)

## Server Replace

2018/12/11  
LT @ [Mackerel Drink Up #8 Tokyo - テーマは「SRE」](https://mackerelio.connpass.com/event/106805/)   
Twitter HashTag: [#mackerelio](https://twitter.com/search?f=tweets&vertical=default&q=%23mackerelio) 

```
「SRE」であれば、一度は経験する/したであろう、Server Replace の例を眺め、    
こういうところでは・・・こういうモニタリングを（Mackerel で）するのがよいであろう・・・  
といった知見・方法論など得られれば幸いです。
```

- ToC
    - [小規模編](#small-scale-case)
    - [中規模編](#medium-scale-case)
    - [大規模編](#large-scale-case)
    - [まとめ](#conclusion)
    - [免責](#disclaimer)

### Small Scale Case
- Server Replace 小規模編
    - Web-DB 一体型サーバー
    - Web は Apache + PHP
    - DB は PostgreSQL
    - 新サーバーには Web の構築がなされており
    - DBは pg_dump を採取して
    - 間に dump を置いておくストレージサーバーがあって
    - メンテナンス中に転送し
    - DNSを切り替える、的なことでReplaceを完了させる
    - この例は、仮想環境基盤を CloudStack から VMware に移行する、という感じ

### Medium Scale Case
- Server Replace 中規模編
    - 共有ストレージのミドルウェアを、GlusterFS から DRBD に変えた、という例
    - GlusterFS は、分散ストレージとしては有名な部類ですが、如何せんパフォーマンスが酷い
        - OS との相性があるらしい
        - Debian 系だったらねー、という指摘は・・・変えたあとに聞いた
    - リプレースにはサービス停止のメンテナンスを伴った（未明 1:00 - 8:00）
    - 約500Gのデータが複数台の仮想サーバーにあった
    - 各brickのデータを、順次rsyncデーモンを駆使して DRBD 側に転送
    - 転送が完了したら、DRBD 側のローカルで１つに集約
        - これを全並列のrsyncでやったら、いくらか I/O wait が出てしまった
    - Webサーバ群での再マウントには得意技の pssh を駆使して 約90台 をコマンド数発で完了
    - というお話が、 [GlusterFS(3.3)からの脱却に成功した2018.2.7](https://qiita.com/sogaoh/items/de5aed62b5093c47b517)

### Large Scale Case 
- Server Replace 大規模編
    - オンプレのDBサーバーを、パブリッククラウドに移していこうと計画中
    - パブリッククラウド側（GCP）に関しては、以下の利用が必要
        - Cloud Router
        - Partner Interconnect
            - Dedicated Interconnect もあるようだが、10Gbps からのようで、今回は明らかにオーバースペック
    - オンプレ側の機器設置に向けて奔走中
    - 話のつづきは、[SRE Advent Calendar 2018](https://qiita.com/advent-calendar/2018/sre) # Day 22 にて

### Conclusion
- まとめ
    - 成功の秘訣
        - 把握・検証・準備
        - パフォーマンス測定
            - ネットワーク
            - ディスク I/O 

    - 「終わらせる」という断固たる決意
        - 未来の夢を描いておく
        - 次はあれやるんだ・・・

### Disclaimer
- 免責
    - 正確性
        - 本資料は一例に過ぎないことをご了承ください。
        - 諸所の画像はイメージです。かるーく検索して見つかったものを利用させてもらっています。
    - 本資料に関するお問い合わせ
        - 2018/12/31まで、 Twitter [@sogaoh](http://twitter.com/sogaoh) にて受け付けます。DMでもストリーム（普通にメンション）でもWelcome。


