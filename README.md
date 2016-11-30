# getui
个推laravel5扩展包, 根据官方最新SDK包整理

#安装方法
    1 在项目目录下 composer require echobool/getui-laravel5
    或在 composer.json 中添加 "echobool/getui-laravel5": "^1.0" 然后 composer update
    如果无法安装 请执行一下 composer update nothing 然后 composer update

    2 在config/app.php
        'providers' 中添加  Echobool\Getui\GetuiServiceProvider::class,
        'aliases'   中添加 'Getui' => Echobool\Getui\Facades\Getui::class,

    3 执行 php artisan config:cache 清空配置缓存
      执行 php artisan vendor:publish --provider="Echobool\Getui\GetuiServiceProvider" 将配置文件发布到config文件夹中

    4 配置 config/getui.php

#使用方法

    在控制器中 use Getui;
    在方法中
     public function index()
     {
        $cid = ; //你数据库中存储的cid ;
        $data = ['name'=>'echobool'];
        $template_id = 1; //是发送模板
        Getui::pushMessageToSingle($cid,$data,$template_id);

        //下面这个是只针对 IOS的推送 自己选择使用
        $data = ['content'=>'content','body'=>'这是内容','title'=>'这是一个标题','text'=>'texts'];
        Getui::pushAPNL($DeviceToken,$data);
     }

    模板对应参数$data如下

    template_id==1时 //安卓通知栏推送  //通知透传 //IPHONE 会在应用内弹出提示
    $data = ['content'=>'content','title'=>'这是一个标题','text'=>'texts'];

    template_id==2时 //这是下载模板  ios不支持
    $data=['notyTitle'=>'notyTitle',
            'notyContent'=>'notyContent',
            'popTitle'=>'popTitle',
            'popContent'=>'popContent',
            'loadTitle'=>'loadTitle',
            'loadUrl'=>'http://www.echobool.com',
            ];

    template_id==3时 //通知连接模板   安卓在通知栏打开连接   ios要在应用内弹出对话框 点击打开safari
    $data=['title'=>'title','text'=>'text','url'=>'http://baidu.com'];

    template_id==4时 //IPHONE 通知栏提示 //安卓会启动应用 可在应用内拿到透传的内容
    $data = ['content'=>'透传内容','body'=>'这是内容','title'=>'这是一个标题','payload'=>'自定义数据'];


    其它用法直接参考GetuiPush 类中的写法 后面会整理规范一些.

