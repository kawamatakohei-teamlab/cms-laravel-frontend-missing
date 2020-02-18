# CMS-laravel-frontend
## 開発環境setup方法
cloneし、

$docker-commpose up

をする。

$docker-compose exec web bash

で中に入り、

$composer install

する。

.envファイルは

- .env.dev
- .env.local
- .env.prod

の三種類ある。

DockerfileのAPP＿ENVを書き換えることでenvの変更は可能。

configのキャッシュに注意する。
