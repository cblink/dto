<h1 align="center"> laravel-dto </h1>

<p align="center"> .</p>


## Installing

```shell
# 1.x与2.x完全不兼容，2.x版本还在测试中，请勿使用
$ composer require cblink/laravel-dto ^1.0 -vvv
```

## 生成DTO

```shell script

// 默认将创建到项目 /app/DTO 目录
php artisan make:dto BaseDTO

// 创建到指定目录 /Domain/DTO 目录
php artisan make:dto TestDTO --path Domain/DTO

```


## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cblink/laravel-dto/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cblink/laravel-dto/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT