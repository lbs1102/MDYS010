# [苹果cmsV10整合云转码（PPVOD）插件](https://gitee.com/datll_admin/ppvod)

[![img](https://gitee.com/datll_admin/ppvod/badge/star.svg?theme=dar)](https://www.php.net/) 

[苹果cms下载](https://cdn.jsdelivr.net/gh/magicblack/maccms_down/) | [PPVOD（云转码）下载](http://www.ppvod.com/) | [插件官方](http://www.datll.com/) 

 
::: tip 特色
该插件不会替换系统任何文件，可关闭、可卸载不残留文件、不影响cms版本升级。使用方法简单。内置防盗链、多码率播放器，
支持离线下载到PPVOD，一键复制分享地址、m3u8地址、远程删除PPVOD数据、一键入库功能、支持从cms后台上传影片到ppvod并返回m3u8地址。
:::


## 链接：
- 发布地址：http://www.datll.com/cms/a/25.html 
- 大图官方：http://www.datll.com
- PPVOD（云转码）下载：http://www.ppvod.com/
- 作者QQ：834023388

1. 将插件文件夹里的 ppvod 文件夹上传到  苹果cms 网站 的addons 目录，然后到后台 > 应用 > 应用市场  > ppvod转码插件 > 启用插件就可

2. 插件配置 填写正确的 ppvod 对接地址 、api密钥 保存  配置并刷新后台！

3. 在"应用"菜单下就会多出来一个 PPVOD 选项

## 播放器配置：
 
1.在插件启用后会在 苹果cmsV10后台  “视频” => “播放器” 列表末端新增一个  “PPVOD” 的播放器，
2.该播放器支持 防盗链和苹果cmsV10自带试看权限配置，可直接使用该播放器无需其他配置


## 自动推送：

1.正常配置插件 并 启用后，在苹果cms 后台 》 应用 》 ppvod  菜单下， 点击 “推送地址”  自动复制拼接好的 推送地址 到剪切板；
 
2.然后到 PPVOD管理后台 》 系统设置 》基础设置 》 推送地址  进行粘贴剪切板的地址
 
## 常见问题
### 什么是云转码接口
答案：就是你PPVOD的后台地址，如：`http://123.144.12.215:2000`
### 什么是播放域名？ 
答案：您单独配置的播放域名，如果没有，默认为 云转码地址+2100端口，如：`http://123.144.12.215:2000`
### 什么是上传密钥？
答案：当前版本不要填写
### 什么是读写密钥？ 
答案：用于苹果cms和ppvod的通讯以及读写权限。
### 什么是防盗密钥？ 
答案：用于配置防盗播功能，可现在 `ppvod 系统设置` -> `防盗系统` 里先配置好密钥，然后在吧密钥复制到这里填写。
### 什么是推送密码？ 
答案：无需从其他地方获取，这里就是定义密码的地方,随意填写即可！
推送的完整URL可以在你`启用`ppvod插件并且设置完密码后到 `苹果cms` 后台-> `应用` -> `PPVOD` -> `推送地址`【点击一下自动拷贝到剪贴板】，然后在到`ppvod基础设置`里的推送地址粘贴即可。
#### 我怎么推送？
![推送.png](//www.ppvod.com/d/file/2019-12-12/350e3fcbf0068b0d029e56395caba98d.png)
- 勾选所需内容，点击推送按钮即可，自动把勾选的内容推送到网站，如果你在软件后台的分类名字和网站的分类名字相同，还能自动根据网站分类对应入库。是不是很方便？
- 使用此功能，首先需要在`PPVOD`后台-基础设置-推送地址，填上你网站的推送插件地址。需要注意的是推送地址的域名不能使用`cdn域名`，如果网站必须使用`cdn`，必须另外绑定一个域名（网站服务器的ip也可以）到网站，推送地址就用这个没有经过`cdn`的域名。
- ![推送地址.png](//www.ppvod.com/d/file/2019-12-12/9b2003aacb4109b8f5190ee13b4bddb6.png) 
- 为了防止恶意入库，一般都要携带入库密码，这个入库密码就是你的推送密码？


### 什么是附件地址？
答案：就是你ppovd视频封面的地址，有的站长单独配置了域名，如果没有另外设置图片域名这里就填写 ppvod 的地址就可以了。

### 请求解析服务器失败？
答案：如果配置无误，有可能SSL问题，就是你苹果cms后台使用https协议，但是PPVOD接口是为http导致的通讯失败，只要保持两个地方协议一致即可解决。

::: tip 大图模板（http://www.datll.com） 现有：优质原创成品模板源码、插件源码、app源码出售。
另有：承接网站模板设计、模板仿站、高端UI定制、cms二次开发、插件开发、cms对接uni-app项目。承接网站日常维护，数据库挂马清理、模板后门、恶意代码清理，播放器整合。联系QQ：834023388
:::

::: warning 升级须知
无论是cms升级还是插件升级都必须先禁用插件，然后在覆盖文件，覆盖完成后在点击启用插件，不然禁用或启用插件时会提示文件冲突。
:::
## 更新记录
======================================
### 1.0.8
* 合并上传域名和api域名，走cdn播放域名单独设置
* 修复使用防盗播播放失败问题

### 1.0.7
* 修复后台添加影片面板截图字段,多段视频自动插入截图 （需要cms更新到2020.1000.1099以上）
* 优化多地址换行插入地址栏
* 修正插件配置M3U8和分享地址无效问题
* 修复使用云分享地址是默认ppvod播放器无法播放问题
* 其他细节

### 1.0.6
* 修复离线下载提交报错问题
### 1.0.5
* 修复添加影片无播放器选择问题
* 修复post请求ppvod数据返回为空时错误
### 1.0.4
* 修复采集、添加到cms、复制等功能的播放路径缺少“/”问题
* 废除以多条单码率入库，默认使用单条多码率
### 1.0.3
* 增强后台列表添加按钮的json字符转义
* 新增支持PPVOD 试看功能（需要cms更新到2020.1000.1033以上）
* 新增启动插件是自动添加PPVOD官方播放器

::: danger 免责声明
插件由 大图模板（http://www.datll.com）开发整合，并免费提供给PPVOD和苹果cms站长使用，
软件仅供学习交流用途，不得使用于非法站点，违者自行承担一切后果，与软件开发者无关！！！
:::
