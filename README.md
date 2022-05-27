# SendCloud-Library

该项目已不推荐使用，如有需要，请使用下载官方SDK：https://www.sendcloud.net/doc/sdk/php/

## 1.简介
SOHU SendCloud Email API V2 的调用库
Forked:https://github.com/hsldymq/SendCloud-Library

### 这是什么与不是什么?
这是很简单的库,它只帮你省去了自己写代码连接SendCloud API V2接口的工夫; 帮你将接口的返回值统一的转换为关联数组,供你的业务逻辑处理; 给你提供一个请求模板机制,让你可以预先制定一套针对接口的请求参数,这样在你的业务逻辑中就不需要提交任何参数,只要简单的调用一两个方法便能实现接口提供的功能(发邮件,管理列表,管理用户...)

但是,这不是个傻瓜式的库,很多时候你还是得查阅[官方文档](https://www.sendcloud.net/doc/product_email/quickin),至少你得知道,API提供了那些接口供你调用,每个接口有哪些必填参数.企图通过$obj->sendMail('from@xxx.xxx', 'to@xxx.xxx', 'subject', 'content')就把邮件给发送了.这个库还是too young to naive了.

## 2.要求
#### PHP版本: >= 5.3
#### PHP安装curl扩展

## 3.安装
```
composer require china-shevy/sendcloud-email-v2
```
