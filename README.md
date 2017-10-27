# Qla\AdminPanel
Qla crud里的后台管理模块，需要 laravel 5.x。

## 安装

```
composer require qla/adminpanel
php artisan vendor:publish
select the Provider and tag with qla
```

## 使用

1. 首先`php artisan migrate`
2. 在config/qla/base.php中可以配置后台路由前缀
3. 可以在网站里直接调用`route('Crud.Manager.home')`

