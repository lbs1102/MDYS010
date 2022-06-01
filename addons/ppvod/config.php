<?php

return array (
  0 => 
  array (
    'name' => 'api',
    'title' => '云转码api',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => 'http://162.251.93.83',
    'class' => '',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':填写原始播放域名，不能是经过cdn的',
    'ok' => '',
    'extend' => 'style="width:500px;height:38px;line-height: 34px;"',
  ),
  1 => 
  array (
    'name' => 'site',
    'title' => '播放域名',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => 'https://video.cckgame.com',
    'class' => '',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':可以是经过cdn的播放域名，只用播放',
    'ok' => '',
    'extend' => 'style="width:500px;height:38px;line-height: 34px;"',
  ),
  2 => 
  array (
    'name' => 'uploadkey',
    'title' => '上传密钥',
    'type' => 'string',
    'content' => 
    array (
    ),
    'class' => '',
    'value' => 'KDAJDIJIPP8OWEJ',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':上传你密钥必填，防止恶意上传',
    'ok' => '',
    'extend' => 'style="width:500px;height:38px;line-height: 34px;"',
  ),
  3 => 
  array (
    'name' => 'apikey',
    'title' => '读写密钥',
    'type' => 'string',
    'content' => 
    array (
    ),
    'class' => '',
    'value' => 'b43CV02C',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':云视频管理系统对应的后台API密钥',
    'ok' => '',
    'extend' => 'style="width:500px;height:38px;line-height: 34px;"',
  ),
  4 => 
  array (
    'name' => 'palykey',
    'title' => '防盗密钥',
    'type' => 'string',
    'content' => 
    array (
    ),
    'class' => '',
    'value' => 'igxToxCcp',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':云视频管理系统对应的后台API密钥',
    'ok' => '',
    'extend' => 'style="width:500px;height:38px;line-height: 34px;"',
  ),
  5 => 
  array (
    'name' => 'async',
    'title' => '同步api密码',
    'type' => 'string',
    'content' => 
    array (
    ),
    'class' => '',
    'value' => '588THTUoI',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':访问本站同步api验证密码，防止恶意访问',
    'ok' => '',
    'extend' => 'style="width:500px;height:38px;line-height: 34px;"',
  ),
  6 => 
  array (
    'name' => 'weburl',
    'title' => '附件地址',
    'type' => 'string',
    'content' => 
    array (
    ),
    'class' => '',
    'value' => 'https://video.cckgame.com',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':图片附件访问地址，没有设置留空',
    'ok' => '',
    'extend' => 'style="width:500px;height:38px;line-height: 34px;"',
  ),
  7 => 
  array (
    'name' => 'palyurl',
    'title' => '返回地址',
    'type' => 'radio',
    'content' => 
    array (
      'share' => '分享云播',
      'm3u8' => 'm3u8',
    ),
    'value' => 'm3u8',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':上传成功后返回的地址类型',
    'ok' => '',
    'extend' => 'style="width:500px;height:38px;line-height: 34px;"',
  ),
  8 => 
  array (
    'name' => 'illegal',
    'title' => '非法词过滤',
    'type' => 'radio',
    'content' => 
    array (
      'yes' => '开',
      'no' => '关',
    ),
    'value' => 'no',
    'rule' => 'required',
    'msg' => '',
    'tip' => ':拦截推送有非法词的数据',
    'ok' => '',
    'extend' => 'style="width:100px;height:38px;line-height: 34px;"',
  ),
);
