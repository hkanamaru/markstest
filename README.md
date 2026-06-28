# WordPress ローカル開発環境（Docker）

## 構成

| サービス | 説明 | ポート |
|---|---|---|
| WordPress | 本体 | http://localhost:8080 |
| phpMyAdmin | DB管理画面 | http://localhost:8081 |
| MySQL 8.0 | データベース | 内部のみ |

## 起動方法

```bash
# 1. 以下を実行

docker compose up -d
```

起動後、ブラウザで http://localhost:8080 にアクセスしてWordPressの初期設定を行う。（初回のみ）

### データのインポート

1. ツール　＞　インポートをクリック
2. WordPress をクリック
3．インポータ―を実行をクリック
4. marks.WordPress.2026-06-28.xmlを選択してインポート

### 固定ページの作成（contactが表示されない場合）

1. 固定ページ　＞　新規作成をクリック
2. 編集画面の一番上のページタイトル部分にcontactと入力して公開


## 停止

```bash
docker compose down
```

## データも含めて完全削除

```bash
docker compose down -v
```

## ディレクトリ構成

```
marks-wp/
├── docker-compose.yml
├── marks.WordPress.2026-06-28.xml    # WordPressエクスポートデータ
├── README.md
├── plugins/
│   ├── contact-form-7/               # 問い合わせフォーム用 
│   ├── wordpress-importer/           # エクスポートデータのインポート用
└── themes/
    ├── index.php
    └── marks-house-theme/
        ├── style.css
        ├── theme.json
        ├── functions.php
        ├── common.css                # 本社サイトのCSSをコピーしたもの
        ├── nav-studio.css            #　本社サイトのCSSをコピーしたもの
        ├── readme.txt
        ├── images/                   # テーマ用画像
        ├── parts/                    # 本社サイトのヘッダーフッターをコピーしたもの
        │   ├── header.html
        │   └── footer.html
        ├── patterns/
        │   ├── case-study.php
        │   ├── cta-row-standalone.php
        │   ├── faq.php
        │   ├── intro-section.php
        │   ├── merits.php
        │   ├── simulation.php
        │   ├── testimonials.php
        │   └── use-cases.php
        ├── templates/
        │   ├── front-page.html       # LP用
        │   └── page-contact.html     # コンタクトページ用
        └── styles/
```

## DB接続情報

| 項目 | 値 |
|---|---|
| Host | db |
| Database | wordpress |
| User | wordpress |
| Password | wordpress_password |
| Root Password | root_password |


# 制作方針

## ターゲットに合わせたタイポグラフィ

主なターゲットである40〜50代の男女ユーザーを想定し、読みやすさを最優先にベースフォントサイズを16pxに設定しました。小さすぎず大きすぎないこのサイズは、幅広い年代に無理なく読める標準的な基準として広く用いられており、ターゲット層の可読性確保に適していると判断しました。

## PCファーストの設計

40〜50代はスマートフォンと併用しつつもPC保有率・利用率が高い世代です。そのため、デスクトップでの閲覧体験をメインに設計し、レイアウトやコンテンツの見せ方をPC画面での視認性を基準に構築しました。もちろんレスポンシブ対応も行い、スマートフォンやタブレットでも適切に表示されるよう実装しています。

## アクセシビリティへの配慮

テキストと背景色のコントラスト比をWCAG（Webコンテンツアクセシビリティガイドライン）の基準を意識しながら調整し、視認性の高いデザインを実現しました。特に高齢になるほど視力の低下が起きやすいことを踏まえ、全セクションにわたって一定以上のコントラストを維持するよう配慮しています。

## 非エンジニアでも編集できる運用性

エンジニアリソースが限られる組織環境を考慮し、マーケターや営業担当者がコードを書かずにコンテンツを更新できるよう、WordPressブロックエディタ（FSE）に対応したテーマとして実装しました。一部難しいところもありますが、テキストの変更や画像の差し替えをブロックエディタ上で直感的に行える想定です。また、問い合わせフォームについても問い合わせプラグインを使用しているためだれでも内容を変更できるようにしています。最初に非エンジニアへの変更方法の説明等は必要ですが、日常的な運用コストを最小限に抑えられる設計となっています。

## その他申し送り

* header等は　https://marks-house.jp/　と同じソースコードを取り込んで使用する想定で作成しています。
本体サイトがWordpressで作成されている前提にはなりますが、本体サイトのあるWordpress状に固定ページとして設置し、共通部分を共有して使うことでサイトデザインの変更等があった際のメンテナンスを最小限にしたいと考えています。今回は制作の都合上partsディレクトリ、common.css、nav-studio.cssとして格納しています。
* 画像は元のfigjamのものに寄せつつフリー素材やAI生成で置き換えていますが、シミュレーションの箇所だけ調整が難しい・御社資料かとおもうのでそのまま使用させていただいています。
* FigJamに記載なかったテキストについてはダミーで入れております。