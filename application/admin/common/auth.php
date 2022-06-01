<?php
return array (
  1 =>
  array (
    'name' => '首頁',
    'icon' => 'xe625',
    'sub' =>
    array (
      11 =>
      array (
        'show' => 1,
        'name' => '歡迎頁面',
        'controller' => 'index',
        'action' => 'welcome',
      ),
      12 =>
      array (
        'show' => 1,
        'name' => '自定義菜單配置',
        'controller' => 'index',
        'action' => 'quickmenu',
      ),
      1001 =>
      array (
        'show' => 0,
        'name' => '--切换布局',
        'controller' => 'index',
        'action' => 'iframe',
      ),
      1002 =>
      array (
        'show' => 0,
        'name' => '--清理缓存',
        'controller' => 'index',
        'action' => 'clear',
      ),
      1003 =>
      array (
        'show' => 0,
        'name' => '--锁屏解锁',
        'controller' => 'index',
        'action' => 'unlocked',
      ),
      1004 =>
      array (
        'show' => 0,
        'name' => '--公共下拉选择框',
        'controller' => 'index',
        'action' => 'select',
      ),
      1005 =>
      array (
        'show' => 0,
        'name' => '--文件上传',
        'controller' => 'upload',
        'action' => 'upload',
      ),
    ),
  ),
  2 =>
  array (
    'name' => '系統',
    'icon' => 'xe62e',
    'sub' =>
    array (
      21 =>
      array (
        'show' => 1,
        'name' => '網站參數配置',
        'controller' => 'system',
        'action' => 'config',
      ),
      210 =>
      array (
        'show' => 1,
        'name' => 'SEO參數配置',
        'controller' => 'system',
        'action' => 'configseo',
      ),
      211 =>
      array (
        'show' => 1,
        'name' => '會員參數配置',
        'controller' => 'system',
        'action' => 'configuser',
      ),
      212 =>
      array (
        'show' => 1,
        'name' => '評論留言配置',
        'controller' => 'system',
        'action' => 'configcomment',
      ),
      213 =>
      array (
        'show' => 1,
        'name' => '附件參數配置',
        'controller' => 'system',
        'action' => 'configupload',
      ),
      22 =>
      array (
        'show' => 1,
        'name' => 'URL地址配置',
        'controller' => 'system',
        'action' => 'configurl',
      ),
      23 =>
      array (
        'show' => 1,
        'name' => '播放器參數配置',
        'controller' => 'system',
        'action' => 'configplay',
      ),
      24 =>
      array (
        'show' => 1,
        'name' => '采集參數配置',
        'controller' => 'system',
        'action' => 'configcollect',
      ),
      25 =>
      array (
        'show' => 1,
        'name' => '站外入庫配置',
        'controller' => 'system',
        'action' => 'configinterface',
      ),
      26 =>
      array (
        'show' => 1,
        'name' => '開放API配置',
        'controller' => 'system',
        'action' => 'configapi',
      ),
      27 =>
      array (
        'show' => 1,
        'name' => '整合登錄配置',
        'controller' => 'system',
        'action' => 'configconnect',
      ),
      28 =>
      array (
        'show' => 1,
        'name' => '在線支付配置',
        'controller' => 'system',
        'action' => 'configpay',
      ),
      29 =>
      array (
        'show' => 1,
        'name' => '微信對接配置',
        'controller' => 'system',
        'action' => 'configweixin',
      ),
      291 =>
      array (
        'show' => 1,
        'name' => '郵件發送配置',
        'controller' => 'system',
        'action' => 'configemail',
      ),
      292 =>
      array (
        'show' => 1,
        'name' => '短信發送配置',
        'controller' => 'system',
        'action' => 'configsms',
      ),
      2910 =>
      array (
        'show' => 1,
        'name' => '定時任務配置',
        'controller' => 'timming',
        'action' => 'index',
      ),
      2911 =>
      array (
        'show' => 0,
        'name' => '--定时任务信息维护',
        'controller' => 'timming',
        'action' => 'info',
      ),
      2912 =>
      array (
        'show' => 0,
        'name' => '--定时任务删除',
        'controller' => 'timming',
        'action' => 'del',
      ),
      2913 =>
      array (
        'show' => 0,
        'name' => '--定时任务状态',
        'controller' => 'timming',
        'action' => 'field',
      ),
      2920 =>
      array (
        'show' => 1,
        'name' => '站群管理配置',
        'controller' => 'domain',
        'action' => 'index',
      ),
      2922 =>
      array (
        'show' => 0,
        'name' => '--站群删除',
        'controller' => 'domain',
        'action' => 'del',
      ),
      2923 =>
      array (
        'show' => 0,
        'name' => '--站群导出',
        'controller' => 'domain',
        'action' => 'export',
      ),
      2924 =>
      array (
        'show' => 0,
        'name' => '--站群导入',
        'controller' => 'domain',
        'action' => 'import',
      ),
    ),
  ),
  3 =>
  array (
    'name' => '基礎',
    'icon' => 'xe64b',
    'sub' =>
    array (
      31 =>
      array (
        'show' => 1,
        'name' => '分類管理',
        'controller' => 'type',
        'action' => 'index',
      ),
      3101 =>
      array (
        'show' => 0,
        'name' => '--分类信息维护',
        'controller' => 'type',
        'action' => 'info',
      ),
      3102 =>
      array (
        'show' => 0,
        'name' => '--分类批量修改',
        'controller' => 'type',
        'action' => 'batch',
      ),
      3103 =>
      array (
        'show' => 0,
        'name' => '--分类删除',
        'controller' => 'type',
        'action' => 'del',
      ),
      3104 =>
      array (
        'show' => 0,
        'name' => '--分类状态',
        'controller' => 'type',
        'action' => 'field',
      ),
      3105 =>
      array (
        'show' => 0,
        'name' => '--分类扩展配置信息',
        'controller' => 'type',
        'action' => 'extend',
      ),
      32 =>
      array (
        'show' => 1,
        'name' => '專題管理',
        'controller' => 'topic',
        'action' => 'data',
      ),
      3201 =>
      array (
        'show' => 0,
        'name' => '--专题信息维护',
        'controller' => 'topic',
        'action' => 'info',
      ),
      3202 =>
      array (
        'show' => 0,
        'name' => '--专题批量修改',
        'controller' => 'topic',
        'action' => 'batch',
      ),
      3203 =>
      array (
        'show' => 0,
        'name' => '--专题删除',
        'controller' => 'topic',
        'action' => 'del',
      ),
      3204 =>
      array (
        'show' => 0,
        'name' => '--专题状态',
        'controller' => 'topic',
        'action' => 'field',
      ),
      33 =>
      array (
        'show' => 1,
        'name' => '友鏈管理',
        'controller' => 'link',
        'action' => 'index',
      ),
      3301 =>
      array (
        'show' => 0,
        'name' => '--友链信息维护',
        'controller' => 'link',
        'action' => 'info',
      ),
      3302 =>
      array (
        'show' => 0,
        'name' => '--友链批量修改',
        'controller' => 'link',
        'action' => 'batch',
      ),
      3303 =>
      array (
        'show' => 0,
        'name' => '--友链删除',
        'controller' => 'link',
        'action' => 'del',
      ),
      3304 =>
      array (
        'show' => 0,
        'name' => '--友链状态',
        'controller' => 'link',
        'action' => 'field',
      ),
      34 =>
      array (
        'show' => 1,
        'name' => '留言管理',
        'controller' => 'gbook',
        'action' => 'data',
      ),
      3401 =>
      array (
        'show' => 0,
        'name' => '--留言信息维护',
        'controller' => 'gbook',
        'action' => 'info',
      ),
      3402 =>
      array (
        'show' => 0,
        'name' => '--留言删除',
        'controller' => 'gbook',
        'action' => 'del',
      ),
      3404 =>
      array (
        'show' => 0,
        'name' => '--留言状态',
        'controller' => 'gbook',
        'action' => 'field',
      ),
      35 =>
      array (
        'show' => 1,
        'name' => '評論管理',
        'controller' => 'comment',
        'action' => 'data',
      ),
      3501 =>
      array (
        'show' => 0,
        'name' => '--评论信息维护',
        'controller' => 'comment',
        'action' => 'info',
      ),
      3502 =>
      array (
        'show' => 0,
        'name' => '--评论删除',
        'controller' => 'comment',
        'action' => 'del',
      ),
      3504 =>
      array (
        'show' => 0,
        'name' => '--评论状态',
        'controller' => 'comment',
        'action' => 'field',
      ),
      36 =>
      array (
        'show' => 1,
        'name' => '附件管理',
        'controller' => 'annex',
        'action' => 'data',
      ),
      3604 =>
      array (
        'show' => 0,
        'name' => '--附件文件夹',
        'controller' => 'annex',
        'action' => 'file',
      ),
      3605 =>
      array (
        'show' => 0,
        'name' => '--附件检测',
        'controller' => 'annex',
        'action' => 'check',
      ),
      3606 =>
      array (
        'show' => 0,
        'name' => '--附件数据初始化',
        'controller' => 'annex',
        'action' => 'init',
      ),
      3601 =>
      array (
        'show' => 0,
        'name' => '--附件删除',
        'controller' => 'annex',
        'action' => 'del',
      ),
      3602 =>
      array (
        'show' => 0,
        'name' => '--同步图片选项',
        'controller' => 'images',
        'action' => 'opt',
      ),
      3603 =>
      array (
        'show' => 0,
        'name' => '--同步图片方法',
        'controller' => 'images',
        'action' => 'sync',
      ),
    ),
  ),
  4 =>
  array (
    'name' => '視頻',
    'icon' => 'xe639',
    'sub' =>
    array (
      41 =>
      array (
        'show' => 1,
        'name' => '服務器組',
        'controller' => 'vodserver',
        'action' => 'index',
      ),
      4101 =>
      array (
        'show' => 0,
        'name' => '--服务器组信息维护',
        'controller' => 'vodserver',
        'action' => 'info',
      ),
      4102 =>
      array (
        'show' => 0,
        'name' => '--服务器组删除',
        'controller' => 'vodserver',
        'action' => 'del',
      ),
      4103 =>
      array (
        'show' => 0,
        'name' => '--服务器组状态',
        'controller' => 'vodserver',
        'action' => 'field',
      ),
      42 =>
      array (
        'show' => 1,
        'name' => '播放器',
        'controller' => 'vodplayer',
        'action' => 'index',
      ),
      4201 =>
      array (
        'show' => 0,
        'name' => '--播放器信息维护',
        'controller' => 'vodplayer',
        'action' => 'info',
      ),
      4202 =>
      array (
        'show' => 0,
        'name' => '--播放器删除',
        'controller' => 'vodplayer',
        'action' => 'del',
      ),
      4203 =>
      array (
        'show' => 0,
        'name' => '--播放器组状态',
        'controller' => 'vodplayer',
        'action' => 'field',
      ),
      43 =>
      array (
        'show' => 1,
        'name' => '下載器',
        'controller' => 'voddowner',
        'action' => 'index',
      ),
      4301 =>
      array (
        'show' => 0,
        'name' => '--下载器信息维护',
        'controller' => 'voddowner',
        'action' => 'info',
      ),
      4302 =>
      array (
        'show' => 0,
        'name' => '--下载器删除',
        'controller' => 'voddowner',
        'action' => 'del',
      ),
      4303 =>
      array (
        'show' => 0,
        'name' => '--下载器组状态',
        'controller' => 'voddowner',
        'action' => 'field',
      ),
      44 =>
      array (
        'show' => 1,
        'name' => '視頻數據',
        'controller' => 'vod',
        'action' => 'data',
      ),
      4401 =>
      array (
        'show' => 0,
        'name' => '--视频信息维护',
        'controller' => 'vod',
        'action' => 'info',
      ),
      4402 =>
      array (
        'show' => 0,
        'name' => '--视频删除',
        'controller' => 'vod',
        'action' => 'del',
      ),
      4403 =>
      array (
        'show' => 0,
        'name' => '--视频状态',
        'controller' => 'vod',
        'action' => 'field',
      ),
      45 =>
      array (
        'show' => 1,
        'name' => '添加視頻',
        'controller' => 'vod',
        'action' => 'info',
      ),
      46 =>
      array (
        'show' => 1,
        'name' => '無地址視頻',
        'controller' => 'vod',
        'action' => 'data',
        'param' => 'url=1',
      ),
      47 =>
      array (
        'show' => 1,
        'name' => '已鎖定視頻',
        'controller' => 'vod',
        'action' => 'data',
        'param' => 'lock=1',
      ),
      48 =>
      array (
        'show' => 1,
        'name' => '未審核視頻',
        'controller' => 'vod',
        'action' => 'data',
        'param' => 'status=0',
      ),
      481 =>
      array (
        'show' => 1,
        'name' => '需積分視頻',
        'controller' => 'vod',
        'action' => 'data',
        'param' => 'points=1',
      ),
      482 =>
      array (
        'show' => 1,
        'name' => '有分集劇情',
        'controller' => 'vod',
        'action' => 'data',
        'param' => 'plot=1',
      ),
      49 =>
      array (
        'show' => 1,
        'name' => '批量操作視頻',
        'controller' => 'vod',
        'action' => 'batch',
      ),
      491 =>
      array (
        'show' => 1,
        'name' => '重名視頻數據',
        'controller' => 'vod',
        'action' => 'data',
        'param' => 'repeat=1',
      ),
      495 =>
      array (
        'show' => 1,
        'name' => '演員庫',
        'controller' => 'actor',
        'action' => 'data',
        'param' => '',
      ),
      4951 =>
      array (
        'show' => 0,
        'name' => '--演员信息维护',
        'controller' => 'actor',
        'action' => 'info',
      ),
      4952 =>
      array (
        'show' => 0,
        'name' => '--演员删除',
        'controller' => 'actor',
        'action' => 'del',
      ),
      4953 =>
      array (
        'show' => 0,
        'name' => '--演员状态',
        'controller' => 'actor',
        'action' => 'field',
      ),
      4954 =>
      array (
        'show' => 0,
        'name' => '--添加演员',
        'controller' => 'actor',
        'action' => 'info',
      ),
      496 =>
      array (
        'show' => 1,
        'name' => '角色庫',
        'controller' => 'role',
        'action' => 'data',
        'param' => '',
      ),
      4961 =>
      array (
        'show' => 0,
        'name' => '--角色信息维护',
        'controller' => 'role',
        'action' => 'info',
      ),
      4962 =>
      array (
        'show' => 0,
        'name' => '--角色删除',
        'controller' => 'role',
        'action' => 'del',
      ),
      4963 =>
      array (
        'show' => 0,
        'name' => '--角色状态',
        'controller' => 'role',
        'action' => 'field',
      ),
      4964 =>
      array (
        'show' => 0,
        'name' => '--添加角色',
        'controller' => 'role',
        'action' => 'info',
      ),
    ),
  ),
  5 =>
  array (
    'name' => '文章',
    'icon' => 'xe616',
    'sub' =>
    array (
      51 =>
      array (
        'show' => 0,
        'name' => '文章數據',
        'controller' => 'art',
        'action' => 'data',
      ),
      5101 =>
      array (
        'show' => 0,
        'name' => '--文章信息维护',
        'controller' => 'art',
        'action' => 'info',
      ),
      5102 =>
      array (
        'show' => 0,
        'name' => '--文章删除',
        'controller' => 'art',
        'action' => 'del',
      ),
      5103 =>
      array (
        'show' => 0,
        'name' => '--文章状态',
        'controller' => 'art',
        'action' => 'field',
      ),
      52 =>
      array (
        'show' => 0,
        'name' => '添加文章',
        'controller' => 'art',
        'action' => 'info',
      ),
      53 =>
      array (
        'show' => 0,
        'name' => '已鎖定文章',
        'controller' => 'art',
        'action' => 'data',
        'param' => 'lock=1',
      ),
      54 =>
      array (
        'show' => 0,
        'name' => '未審核文章',
        'controller' => 'art',
        'action' => 'data',
        'param' => 'status=0',
      ),
      59 =>
      array (
        'show' => 0,
        'name' => '批量操作文章',
        'controller' => 'art',
        'action' => 'batch',
      ),
      591 =>
      array (
        'show' => 0,
        'name' => '重名文章數據',
        'controller' => 'art',
        'action' => 'data',
        'param' => 'repeat=1',
      ),
    ),
  ),
  6 =>
  array (
    'name' => '用戶',
    'icon' => 'xe62c',
    'sub' =>
    array (
      61 =>
      array (
        'show' => 1,
        'name' => '管理員',
        'controller' => 'admin',
        'action' => 'index',
      ),
      6101 =>
      array (
        'show' => 0,
        'name' => '--管理员信息维护',
        'controller' => 'admin',
        'action' => 'info',
      ),
      6102 =>
      array (
        'show' => 0,
        'name' => '--管理员删除',
        'controller' => 'admin',
        'action' => 'del',
      ),
      6103 =>
      array (
        'show' => 0,
        'name' => '--管理员状态',
        'controller' => 'admin',
        'action' => 'field',
      ),
      62 =>
      array (
        'show' => 1,
        'name' => '會員組',
        'controller' => 'group',
        'action' => 'index',
      ),
      6201 =>
      array (
        'show' => 0,
        'name' => '--会员组信息维护',
        'controller' => 'group',
        'action' => 'info',
      ),
      6202 =>
      array (
        'show' => 0,
        'name' => '--会员组删除',
        'controller' => 'group',
        'action' => 'del',
      ),
      6203 =>
      array (
        'show' => 0,
        'name' => '--会员组状态',
        'controller' => 'group',
        'action' => 'field',
      ),
      63 =>
      array (
        'show' => 1,
        'name' => '會員',
        'controller' => 'user',
        'action' => 'data',
      ),
      6301 =>
      array (
        'show' => 0,
        'name' => '--会员信息维护',
        'controller' => 'user',
        'action' => 'info',
      ),
      6302 =>
      array (
        'show' => 0,
        'name' => '--会员删除',
        'controller' => 'user',
        'action' => 'del',
      ),
      6303 =>
      array (
        'show' => 0,
        'name' => '--会员状态',
        'controller' => 'user',
        'action' => 'field',
      ),
      64 =>
      array (
        'show' => 1,
        'name' => '充值卡',
        'controller' => 'card',
        'action' => 'index',
      ),
      6401 =>
      array (
        'show' => 0,
        'name' => '--充值卡信息维护',
        'controller' => 'card',
        'action' => 'info',
      ),
      6402 =>
      array (
        'show' => 0,
        'name' => '--充值卡删除',
        'controller' => 'card',
        'action' => 'del',
      ),
      65 =>
      array (
        'show' => 1,
        'name' => '會員訂單',
        'controller' => 'order',
        'action' => 'index',
      ),
      6501 =>
      array (
        'show' => 0,
        'name' => '--订单删除',
        'controller' => 'order',
        'action' => 'del',
      ),
      66 =>
      array (
        'show' => 1,
        'name' => '訪問日誌',
        'controller' => 'ulog',
        'action' => 'index',
      ),
      6601 =>
      array (
        'show' => 0,
        'name' => '--访问日志删除',
        'controller' => 'ulog',
        'action' => 'del',
      ),
      67 =>
      array (
        'show' => 1,
        'name' => '積分日誌',
        'controller' => 'plog',
        'action' => 'index',
      ),
      6701 =>
      array (
        'show' => 0,
        'name' => '--积分日志删除',
        'controller' => 'plog',
        'action' => 'del',
      ),
      68 =>
      array (
        'show' => 1,
        'name' => '提現記錄',
        'controller' => 'cash',
        'action' => 'index',
      ),
      6801 =>
      array (
        'show' => 0,
        'name' => '--提现删除',
        'controller' => 'cash',
        'action' => 'del',
      ),
      6802 =>
      array (
        'show' => 0,
        'name' => '--提现审核',
        'controller' => 'cash',
        'action' => 'audit',
      ),
    ),
  ),
  7 =>
  array (
    'name' => '模版',
    'icon' => 'xe72d',
    'sub' =>
    array (
      71 =>
      array (
        'show' => 1,
        'name' => '模板管理',
        'controller' => 'template',
        'action' => 'index',
      ),
      7101 =>
      array (
        'show' => 0,
        'name' => '--模板信息维护',
        'controller' => 'template',
        'action' => 'info',
      ),
      7102 =>
      array (
        'show' => 0,
        'name' => '--模板删除',
        'controller' => 'template',
        'action' => 'del',
      ),
      72 =>
      array (
        'show' => 1,
        'name' => '廣告位管理',
        'controller' => 'template',
        'action' => 'ads',
        'param' => '',
      ),
      73 =>
      array (
        'show' => 1,
        'name' => '標簽向導',
        'controller' => 'template',
        'action' => 'wizard',
      ),
    ),
  ),
  8 =>
  array (
    'name' => '生成',
    'icon' => 'xe63e',
    'sub' =>
    array (
      81 =>
      array (
        'show' => 0,
        'name' => '生成選項',
        'controller' => 'make',
        'action' => 'opt',
      ),
      82 =>
      array (
        'show' => 0,
        'name' => '生成首頁',
        'controller' => 'make',
        'action' => 'index',
      ),
      821 =>
      array (
        'show' => 0,
        'name' => '生成WAP首頁',
        'controller' => 'make',
        'action' => 'index?ac2=wap',
      ),
      83 =>
      array (
        'show' => 0,
        'name' => '生成地圖',
        'controller' => 'make',
        'action' => 'map',
      ),
      8101 =>
      array (
        'show' => 0,
        'name' => '--生成入口',
        'controller' => 'make',
        'action' => 'make',
      ),
      8102 =>
      array (
        'show' => 0,
        'name' => '--生成RSS',
        'controller' => 'make',
        'action' => 'rss',
      ),
      8103 =>
      array (
        'show' => 0,
        'name' => '--生成分类',
        'controller' => 'make',
        'action' => 'type',
      ),
      8104 =>
      array (
        'show' => 0,
        'name' => '--生成专题首页',
        'controller' => 'make',
        'action' => 'topic_index',
      ),
      8105 =>
      array (
        'show' => 0,
        'name' => '--生成专题内容',
        'controller' => 'make',
        'action' => 'topic_info',
      ),
      8106 =>
      array (
        'show' => 0,
        'name' => '--生成内容页',
        'controller' => 'make',
        'action' => 'info',
      ),
      8107 =>
      array (
        'show' => 0,
        'name' => '--生成自定义页',
        'controller' => 'make',
        'action' => 'label',
      ),
    ),
  ),
  9 =>
  array (
    'name' => '采集',
    'icon' => 'xe727',
    'sub' =>
    array (
      91 =>
      array (
        'show' => 0,
        'name' => '推薦資源',
        'controller' => 'collect',
        'action' => 'union',
      ),
      9101 =>
      array (
        'show' => 0,
        'name' => '--采集入口',
        'controller' => 'collect',
        'action' => 'api',
      ),
      9102 =>
      array (
        'show' => 0,
        'name' => '--断点采集',
        'controller' => 'collect',
        'action' => 'load',
      ),
      9103 =>
      array (
        'show' => 0,
        'name' => '--绑定分类',
        'controller' => 'collect',
        'action' => 'bind',
      ),
      9104 =>
      array (
        'show' => 0,
        'name' => '--采集视频',
        'controller' => 'collect',
        'action' => 'vod',
      ),
      9105 =>
      array (
        'show' => 0,
        'name' => '--采集文章',
        'controller' => 'collect',
        'action' => 'art',
      ),
      92 =>
      array (
        'show' => 0,
        'name' => '定時掛機',
        'controller' => 'collect',
        'action' => 'timing',
      ),
      93 =>
      array (
        'show' => 1,
        'name' => '自定義接口',
        'controller' => 'collect',
        'action' => 'index',
      ),
      9301 =>
      array (
        'show' => 0,
        'name' => '--自定义资源信息维护',
        'controller' => 'collect',
        'action' => 'info',
      ),
      9302 =>
      array (
        'show' => 0,
        'name' => '--自定义资源删除',
        'controller' => 'collect',
        'action' => 'del',
      ),
      94 =>
      array (
        'show' => 1,
        'name' => '自定義規則',
        'controller' => 'cj',
        'action' => 'index',
      ),
      9401 =>
      array (
        'show' => 0,
        'name' => '--自定义规则信息维护',
        'controller' => 'cj',
        'action' => 'info',
      ),
      9402 =>
      array (
        'show' => 0,
        'name' => '--自定义规则删除',
        'controller' => 'cj',
        'action' => 'del',
      ),
      9403 =>
      array (
        'show' => 0,
        'name' => '--自定义规则发布方案',
        'controller' => 'cj',
        'action' => 'program',
      ),
      9404 =>
      array (
        'show' => 0,
        'name' => '--自定义规则采集网址',
        'controller' => 'cj',
        'action' => 'col_url',
      ),
      9405 =>
      array (
        'show' => 0,
        'name' => '--自定义规则采集内容',
        'controller' => 'cj',
        'action' => 'col_content',
      ),
      9406 =>
      array (
        'show' => 0,
        'name' => '--自定义规则发布内容',
        'controller' => 'cj',
        'action' => 'publish',
      ),
      9407 =>
      array (
        'show' => 0,
        'name' => '--自定义规则导出',
        'controller' => 'cj',
        'action' => 'export',
      ),
      9408 =>
      array (
        'show' => 0,
        'name' => '--自定义规则导入',
        'controller' => 'cj',
        'action' => 'import',
      ),
    ),
  ),
  10 =>
  array (
    'name' => '數據庫',
    'icon' => 'xe621',
    'sub' =>
    array (
      101 =>
      array (
        'show' => 1,
        'name' => '數據庫管理',
        'controller' => 'database',
        'action' => 'index',
      ),
      10001 =>
      array (
        'show' => 0,
        'name' => '--数据库备份',
        'controller' => 'database',
        'action' => 'export',
      ),
      10002 =>
      array (
        'show' => 0,
        'name' => '--数据库还原',
        'controller' => 'database',
        'action' => 'import',
      ),
      10003 =>
      array (
        'show' => 0,
        'name' => '--数据库优化',
        'controller' => 'database',
        'action' => 'optimize',
      ),
      10004 =>
      array (
        'show' => 0,
        'name' => '--数据库修复',
        'controller' => 'database',
        'action' => 'repair',
      ),
      10005 =>
      array (
        'show' => 0,
        'name' => '--数据库删除备份',
        'controller' => 'database',
        'action' => 'del',
      ),
      10006 =>
      array (
        'show' => 0,
        'name' => '--数据库表信息',
        'controller' => 'database',
        'action' => 'columns',
      ),
      102 =>
      array (
        'show' => 1,
        'name' => '執行SQL語句',
        'controller' => 'database',
        'action' => 'sql',
      ),
      103 =>
      array (
        'show' => 1,
        'name' => '數據批量替換',
        'controller' => 'database',
        'action' => 'rep',
      ),
    ),
  ),
  11 =>
  array (
    'name' => '應用',
    'icon' => 'xe621',
    'sub' =>
    array (
      111 =>
      array (
        'show' => 1,
        'name' => '應用市場',
        'controller' => 'addon',
        'action' => 'index',
        'param' => '',
      ),
      112 =>
      array (
        'show' => 1,
        'name' => 'URL推送',
        'controller' => 'urlsend',
        'action' => 'index',
        'param' => '',
      ),
      113 =>
      array (
        'show' => 1,
        'name' => '文件安全檢測',
        'controller' => 'safety',
        'action' => 'file',
        'param' => '',
      ),
      114 =>
      array (
        'show' => 1,
        'name' => '數據掛馬檢測',
        'controller' => 'safety',
        'action' => 'data',
        'param' => '',
      ),
      11200 =>
      array (
        'show' => 0,
        'name' => '--推送入口',
        'controller' => 'urlsend',
        'action' => 'push',
      ),
      11201 =>
      array (
        'show' => 0,
        'name' => '--百度主动推送',
        'controller' => 'urlsend',
        'action' => 'baidu_push',
      ),
      11202 =>
      array (
        'show' => 0,
        'name' => '--百度熊掌推送',
        'controller' => 'urlsend',
        'action' => 'baidu_bear',
      ),
      11100 =>
      array (
        'show' => 0,
        'name' => '--应用插件列表',
        'controller' => 'addon',
        'action' => 'downloaded',
      ),
      11101 =>
      array (
        'show' => 0,
        'name' => '--应用插件安装',
        'controller' => 'addon',
        'action' => 'install',
      ),
      11102 =>
      array (
        'show' => 0,
        'name' => '--应用插件卸载',
        'controller' => 'addon',
        'action' => 'uninstall',
      ),
      11103 =>
      array (
        'show' => 0,
        'name' => '--应用插件配置',
        'controller' => 'addon',
        'action' => 'config',
      ),
      11104 =>
      array (
        'show' => 0,
        'name' => '--应用插件状态',
        'controller' => 'addon',
        'action' => 'state',
      ),
      11105 =>
      array (
        'show' => 0,
        'name' => '--应用插件上传',
        'controller' => 'addon',
        'action' => 'local',
      ),
      11106 =>
      array (
        'show' => 0,
        'name' => '--应用插件升级',
        'controller' => 'addon',
        'action' => 'upgrade',
      ),
      11107 =>
      array (
        'show' => 0,
        'name' => '--应用插件添加',
        'controller' => 'addon',
        'action' => 'add',
      ),
      'ppvod' =>
      array (
        'show' => 1,
        'name' => 'PPVOD',
        'controller' => 'ppvod',
        'action' => 'index',
        'param' => '',
      ),
      11108 =>
      array (
        'show' => 0,
        'name' => '--PPVOD採集選中',
        'controller' => 'ppvod',
        'action' => 'add',
      ),
      11109 =>
      array (
        'show' => 0,
        'name' => '--PPVOD採集設置',
        'controller' => 'ppvod',
        'action' => 'config',
      ),
      11110 =>
      array (
        'show' => 0,
        'name' => '--PPVOD推送日誌',
        'controller' => 'ppvod',
        'action' => 'log',
      ),
      11111 =>
      array (
        'show' => 0,
        'name' => '--PPVOD遠程刪除',
        'controller' => 'ppvod',
        'action' => 'del',
      ),
      11112 =>
      array (
        'show' => 0,
        'name' => '--PPVOD離線下載',
        'controller' => 'ppvod',
        'action' => 'download',
      ),
      11113 =>
      array (
        'show' => 0,
        'name' => '--PPVOD發布上傳',
        'controller' => 'ppvod',
        'action' => 'info',
      ),
    ),
  ),
  12 =>
  array (
    'name' => '網址',
    'icon' => 'xe616',
    'sub' =>
    array (
      121 =>
      array (
        'show' => 1,
        'name' => '網址數據',
        'controller' => 'website',
        'action' => 'data',
      ),
      12101 =>
      array (
        'show' => 0,
        'name' => '--网址信息维护',
        'controller' => 'website',
        'action' => 'info',
      ),
      12102 =>
      array (
        'show' => 0,
        'name' => '--网址删除',
        'controller' => 'website',
        'action' => 'del',
      ),
      12103 =>
      array (
        'show' => 0,
        'name' => '--网址状态',
        'controller' => 'website',
        'action' => 'field',
      ),
      122 =>
      array (
        'show' => 1,
        'name' => '添加網址',
        'controller' => 'website',
        'action' => 'info',
      ),
      123 =>
      array (
        'show' => 1,
        'name' => '已鎖定網址',
        'controller' => 'website',
        'action' => 'data',
        'param' => 'lock=1',
      ),
      124 =>
      array (
        'show' => 1,
        'name' => '未審核網址',
        'controller' => 'website',
        'action' => 'data',
        'param' => 'status=0',
      ),
      129 =>
      array (
        'show' => 1,
        'name' => '批量操作網址',
        'controller' => 'website',
        'action' => 'batch',
      ),
      1291 =>
      array (
        'show' => 1,
        'name' => '重名網址數據',
        'controller' => 'website',
        'action' => 'data',
        'param' => 'repeat=1',
      ),
    ),
  ),
);
