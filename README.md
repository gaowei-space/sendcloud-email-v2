#SendCloud-Library

##1.简介
简易SendCloud API调用库.

###这是什么与不是什么?
这是很简单的库,它只帮你省去了自己写代码连接SendCloud API接口的工夫; 帮你将接口的返回值统一的转换为关联数组,供你的业务逻辑处理; 给你提供一个请求模板机制,让你可以预先制定一套针对接口的请求参数,这样在你的业务逻辑中就不需要提交任何参数,只要简单的调用一两个方法便能实现接口提供的功能(发邮件,管理列表,管理用户...)

但是,这不是个傻瓜式的库,很多时候你还是得查阅[官方文档](http://sendcloud.sohu.com/doc/),至少你得知道,API提供了那些接口供你调用,每个接口有哪些必填参数.企图通过$obj->sendMail('from@xxx.xxx', 'to@xxx.xxx', 'subject', 'content')就把邮件给发送了.这个库还是too young to naive了.


##2.要求
####PHP版本: >= 5.3

####PHP安装curl扩展

##3.安装
有两种方法将它集成到你自己的项目:

####1. composer
在composer.json中写入以下:

{ "require": { "hsldymq/sendcloud-library": "dev-master" } }

linux:
	
	php composer.phar install

windows:

	composer install

composer的用法不多讲,请狂点[这里](http://docs.phpcomposer.com/00-intro.md).

####2. git
git clone https://github.com/hsldymq/SendCloud-Library.git

或者

git clone https://git.coding.net/hsldymq/SendCloud-Library.git

####3. 没有了...


##4.使用
###载入

库的载入遵循PSR-4,因此不用一个一个将文件include进来,对于composer安装的朋友,依然使用

```php
require 'vendor/autoload.php';
```

使用git安装的朋友,可以使用库根目录下的autoload.php:

```php
require 'SendCloud-Library/autoload.php';
```

###开始使用
要调用SendCloud API很简单,假设你(xxx@gmail.com)要向yyy@gmail.com发送一份邮件

在你的代码中加入以下代码:

#####例一
```php
$sc = new \SendCloud\SendCloud();
$req = $sc->prepare('mail', 'send', array(
	'api_user' => 'xxxx',
	'api_key' => 'xxxx',
	'from' => 'xxx@gmail.com',
	'to' => 'yyy@gmial.com',
	'subject' => 'xxx',
	'html' => 'xxxxxxxxxxxxxxxx'
));		// 参数1为module名称, 参数2为action名称, 参数3为请求参数,它们将作为POST数据提交给接口
$data = $req->send();		// 提交API调用请求,返回数据
$data = $req->send();	// 你可以反复调用接口
```

module名称与action名称是大小写敏感的,错误的书写将无法调用API.

比如在官方文档中有一个module名为invalidStat,那么你的调用里中不能写为'invalidstat'或'InvalidStat',这些都是错误的

每一个API接口对请求参数的要求各有不同,有些是必填参数,有些是选填参数,因此在你调用之前还是需要参考[官方API文档](http://sendcloud.sohu.com/doc/email/)

返回的数据($data)是一个关联数组,每一个接口都返回一个特定的数据集.具体参考[这里](http://sendcloud.sohu.com/doc/email/). 我不打算针对每个接口的返回数据做一些过滤处理,只是将原始数据交给你的业务逻辑,供你们自己处理.

#####如果你觉得这点功能已经够用了,你可以停止阅读下面的内容.

###配置文件

对每个API接口来说,有两个请求参数始终是必填的: api\_key,api\_user.

对于每一个SendCloud,api\_key是唯一,尽管api\_user可以创建多个,但你也可以只用一个user来发送触发邮件或群发邮件.  这个情况下你可以找到_**/config/config.php**_文件,设置其API_KEY与API_USER配置:

#####例二
```php
return array(
    "API_KEY" => "xxxx",
    "API_USER" => "xxxx"
    // ... other configurations
);
```

之后的调用只要请求参数没有填入api\_user和api\_key,发送请求前会自动帮你填充.

###调整请求参数

在例一中$req是一个**Request**类的实例对象,你可以在你发送API调用请求前调整你的请求参数,也可以选择使用请求模板(下面会介绍),可以使用它来改变即将调用API接口的module和action.

按照例一的代码,假设我们需要在发送前将api\_user的值修改为yyyy,我们可以:

```php
$req->setParam('api_user', 'yyyy');
```

我们还可以重新设置参数集:

```php
$req->prepareRequest(array(
	'api_user' => 'xxxx',
	'api_key' => 'xxxx',
	'from' => 'xxx@gmail.com',
	'to' => 'yyy@gmial.com',
	'subject' => 'xxx',
	'html' => 'xxxxxxxxxxxxxxxx'
));
```

改变调用的module:

```php
$req->setModule('userinfo');
```

改变action:

```php
$req->setAction('send_template');
```

以上这些方法允许链式调用,因此你可以:

```php
$data = $req->setModule('template')->setAction('get')->setParam('api_user', 'zzz')->send();
$data2 = $req->prepareRequest(array(
	'api_user' => 'vvv',
	'api_key' => 'xxxx',
	'from' => 'aaa@gmail.com',
	'to' => 'bbb@gmial.com',
	'subject' => 'yyyy',
	'html' => 'yyyyyyyyyyyy'
))->send();
```

###请求参数模板

如果你觉得每次调用API接口都要设置长长的一段请求参数集很麻烦,也许你的业务通常只需要发送固定一些邮件,处理一些固定的邮件事物,所有参数模板可以帮你减少工作量.

#####设置模版
找到/template目录,里面有许多子目录,每一个子目录代表一个同名module,其中有若干个php文件,每一个文件代表一个同名action.  

所以你需要设置module为"mail",action为"send"的模板你可以编辑:

	/template/mail/send.php

在模板文件中维护了一个关联数组,它们是若干个参数模板,键名代表模板名,其值就是一个参数集:

```php
return array(
	'default' => array(
		'api_user' => 'Three Zhang',
		'api_key' => 'xxx',		// 这里的api_key将覆盖config.php中的api_key
		'from' => 'aaa@gmail.com',
		'to' => 'bbb@gmial.com',
		'subject' => 'yyyy',
		'html' => 'yyyyyyyyyyyy'
	),
	'fl' => array(
		'api_user' => 'Four Li',
		'api_key' => 'xxx',
		'from' => 'ccc@gmail.com',
		'to' => 'ddd@gmial.com',
		'subject' => 'zzzz',
		'html' => 'zzzzzzzzzzzzzz'
	)
);
```

在上面的例子中维护了两套模板,它们分别名为default和fl,default是默认模板,当用户想使用模板却没有指定模板名时,默认使用它.

#####使用模板

有几种方式可以使用模板:

**1:**

```php
$sc = new \SendCloud\Sendcloud();
$req = $sc->prepare('module_name', 'action_name', 'template_name'); // 使用template_name模板
$data = $req->send();
```

```php
$sc = new \SendCloud\Sendcloud();
$sc->prepare('module_name', 'action_name'); // 使用默认(default)模板
$data = $req->send();
```

```php
// 省略实例化SendCloud类代码...
$req->prepareRequest('template_name');	// 使用template_name模板
$data = $req->send();
```

```php
// 省略实例化SendCloud类代码...
$req->prepareRequest();	// 使用默认(default)模板
$data = $req->send();
```

从上面的例子可以看出,SendCloud类的prepare方法和Request类的prepareRequest方法除了接受关联数组做为参数集,也接受字符串来使用指定模板.

使用模板可以尽可能的减少你的代码量.

**目前模板还未支持变量替换,在使用调用一些API(比如发送模板邮件)的时候,会需要替换模板变量,这时还是需要自己动手来调整参数来实现目标.  将来会增加这方面的支持**