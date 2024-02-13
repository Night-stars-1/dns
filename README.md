
### 项目地址：https://github.com/Night-stars-1/dns

# 小周二级域名分发系统 （xzdns v3.1.2）

## 此系统有哪些特点
* 1、增加AAAA解析ipv6网站
* 2、对接码支付
* 2、修复一些已知的问题
## 3.1.2 (20240211)
* 1. 美化页面
* 2. 提升Laravel版本为 9.2
* 2. php版本提升为>=8.2
## 3.1.1 (20230116)
* 目前支持的域名解析平台有
    *  dnspod
    *  cloudxns
    *  aliyun
    *  dnscom
    *  dnsla
    *  cloudxns
    *  DnsDun
* 多用户、多域名、多平台同时存在
* 界面简单、舒适，操作简单
## 3.1.0 (20190803)
* 1、增加解析网站内容关键词检测
* 2、增加对dnsdun.com解析平台的支持
* 2、修复已知的一些问题
## 3.0.1 (20190419)
* 1、程序框架由ThinkPHP 改为Laravel 5.8
* 2、增加对cloudxns平台的支持
* 3、增加用户组功能
* 4、更新一些平台的接口

## 安装说明
* 1、程序的框架是Laravel 9.2，因此需要环境满足以下要求：
    * PHP >= 8.2
    * PHP OpenSSL 扩展
    * PHP PDO 扩展
    * PHP Mbstring 扩展
    * PHP Tokenizer 扩展
    * PHP XML 扩展
    * PHP Ctype 扩展
    * PHP JSON 扩展
    * PHP BCMath 扩展
* 2、环境必须支持伪静态

* Apache 伪静态配置
    * 确保 Apache 启用了 mod_rewrite 模块以支持 .htaccess 解析。
* Apache 开启gzip优化配置
    * 确保 Apache 启用了 mod_filter、mod_deflate 模块以支持 gzip 。
* Nginx 伪静态配置

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

## 有问题反馈
1、如果你需要程序支持其他域名解析平台，且该平台有api接口，可以联系我，我尽量添加！
2、在使用中有任何问题，欢迎反馈给我，可以用以下联系方式跟我交流

### 原版源码归原作者所有，美化版源码归[Night-stars-1](https://github.com/Night-stars-1)所有

## 参考项目
1. 原项目 https://github.com/klsf/kldns
2. 重置版 https://github.com/zhoudedi/xzdns/
