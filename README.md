#SendCloud-Library

##1.简介
SOHU SendCloud Email API V2 的调用库
By:https://github.com/hsldymq/SendCloud-Library

###这是什么与不是什么?
这是很简单的库,它只帮你省去了自己写代码连接SendCloud API V2接口的工夫; 帮你将接口的返回值统一的转换为关联数组,供你的业务逻辑处理; 给你提供一个请求模板机制,让你可以预先制定一套针对接口的请求参数,这样在你的业务逻辑中就不需要提交任何参数,只要简单的调用一两个方法便能实现接口提供的功能(发邮件,管理列表,管理用户...)

但是,这不是个傻瓜式的库,很多时候你还是得查阅[官方文档](http://sendcloud.sohu.com/doc/),至少你得知道,API提供了那些接口供你调用,每个接口有哪些必填参数.企图通过$obj->sendMail('from@xxx.xxx', 'to@xxx.xxx', 'subject', 'content')就把邮件给发送了.这个库还是too young to naive了.

##2.要求
####PHP版本: >= 5.3

####PHP安装curl扩展

##3.安装
有两种方法将它集成到你自己的项目:

####1. composer
在composer.json中写入以下:

{ "require": { "china-shevy/sendcloud-email-v2": "dev-master" } }

linux:
	
	php composer.phar install

windows:

	composer install

composer的用法不多讲,请狂点[这里](http://docs.phpcomposer.com/00-intro.md).

####2. git
git clone https://github.com/china-shevy/sendcloud-email-v2.git

或者

git clone https://git.coding.net/china-shevy/sendcloud-email-v2.git

####3. 没有了...


##4.使用
###载入

库的载入遵循PSR-4,因此不用一个一个将文件include进来,对于composer安装的朋友,依然使用

```php
require 'vendor/autoload.php';
```

使用git安装的朋友,可以使用库根目录下的autoload.php:

```php
require 'sendcloud-email-v2/autoload.php';
```
