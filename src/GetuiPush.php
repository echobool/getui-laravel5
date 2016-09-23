<?php
namespace Echobool\Getui;

use Echobool\Getui\Exception\RequestException;
use Echobool\Getui\Igetui\IGtAppMessage;
use Echobool\Getui\Igetui\IGtAPNPayload;
use Echobool\Getui\Igetui\IGtListMessage;
use Echobool\Getui\Igetui\Template\IGtBaseTemplate;
use Echobool\Getui\IGtBatch;
use Echobool\Getui\Igetui\Utils\AppConditions;
use Echobool\Getui\Igetui\SimpleAlertMsg;
use Echobool\Getui\Igetui\Template\IGtAPNTemplate;
use Echobool\Getui\Igetui\DictionaryAlertMsg;
use Echobool\Getui\Igetui\IGtSingleMessage;
use Echobool\Getui\Igetui\IGtTarget;
use Illuminate\Contracts\Config\Repository;
use Echobool\Getui\Igetui\Template\IGtLinkTemplate;
use Echobool\Getui\Igetui\Template\IGtNotificationTemplate;
use Echobool\Getui\Igetui\Template\IGtNotyPopLoadTemplate;
use Echobool\Getui\Igetui\Template\IGtTransmissionTemplate;

class GetuiPush
{

    private $HOST = 'https://api.getui.com/apiex.htm'; //'http://sdk.open.api.igexin.com/apiex.htm';
    private $APPKEY;
    private $APPID;
    private $APPSECRET;
    private $MASTERSECRET;

    public function __construct(Repository $config)
    {

        $conf = $config['getui'];
        $this->APPKEY = $conf['APPKEY'];
        $this->APPID = $conf['APPID'];
        $this->APPSECRET = $conf['APPSECRET'];
        $this->MASTERSECRET = $conf['MASTERSECRET'];
    }

    function getPersonaTagsDemo()
    {
        $igt = new IGeTuiPush($this->HOST, $this->APPKEY, $this->MASTERSECRET);
        $ret = $igt->getPersonaTags($this->APPID);
        var_dump($ret);
    }

    function getUserCountByTagsDemo()
    {
        $igt = new IGeTuiPush($this->HOST, $this->APPKEY, $this->MASTERSECRET);
        $tagList = array("金在中", "龙卷风");
        $ret = $igt->getUserCountByTags($this->APPID, $tagList);
        var_dump($ret);
    }

    function getPushMessageResultDemo()
    {

//    putenv("gexin_default_domainurl=http://183.129.161.174:8006/apiex.htm");

        $igt = new IGeTuiPush($this->HOST, $this->APPKEY, $this->MASTERSECRET);

        $ret = $igt->getPushResult("OSA-0522_QZ7nHpBlxF6vrxGaLb1FA3");
        var_dump($ret);

        $ret = $igt->queryAppUserDataByDate($this->APPID, "20140807");
        var_dump($ret);

        $ret = $igt->queryAppPushDataByDate($this->APPID, "20140807");
        var_dump($ret);
    }

    function pushAPN($DeviceToken)
    {

        //APN简单推送
        $igt = new IGeTuiPush(NULL, $this->APPKEY, $this->MASTERSECRET);
        $template = new IGtAPNTemplate();
        $apn = new IGtAPNPayload();
        $alertmsg = new SimpleAlertMsg();
        $alertmsg->alertMsg = "";
        $apn->alertMsg = $alertmsg;
//        $apn->badge=2;
        $apn->sound = "";
        $apn->add_customMsg("payload", "payload");
        $apn->contentAvailable = 1;
        $apn->category = "ACTIONABLE";
        $template->set_apnInfo($apn);
        $message = new IGtSingleMessage();

        //APN高级推送
        //        $igt = new IGeTuiPush($this->HOST,$this->APPKEY,$this->MASTERSECRET);
        //        $template = new IGtAPNTemplate();
        //        $apn = new IGtAPNPayload();
        //        $alertmsg=new DictionaryAlertMsg();
        //        $alertmsg->body="body";
        //        $alertmsg->actionLocKey="ActionLockey";
        //        $alertmsg->locKey="LocKey";
        //        $alertmsg->locArgs=array("locargs");
        //        $alertmsg->launchImage="launchimage";
        ////        IOS8.2 支持
        //        $alertmsg->title="Title";
        //        $alertmsg->titleLocKey="TitleLocKey";
        //        $alertmsg->titleLocArgs=array("TitleLocArg");
        //
        //        $apn->alertMsg=$alertmsg;
        //        $apn->badge=7;
        //        $apn->sound="test1.wav";
        //        $apn->add_customMsg("payload","payload");
        //        $apn->contentAvailable=1;
        //        $apn->category="ACTIONABLE";
        //        $template->set_apnInfo($apn);
        //        $message = new IGtSingleMessage();

        //PushApn老方式传参
        //    $igt = new IGeTuiPush($this->HOST,$this->APPKEY,$this->MASTERSECRET);
        //    $template = new IGtAPNTemplate();
        //    $template->set_pushInfo("actionLocKey", 6, "body", "", "payload", "locKey", "locArgs", "launchImage",1);
        //    $message = new IGtSingleMessage();
        ////
        //    $message->set_data($template);
        $ret = $igt->pushAPNMessageToSingle($this->APPID, $DeviceToken, $message);
       // var_dump($ret);
        return $ret;
    }

    function pushAPNL($DeviceToken,$data)
    {

        //APN简单推送
        //        $igt = new IGeTuiPush($this->HOST,$this->APPKEY,$this->MASTERSECRET);
        //        $template = new IGtAPNTemplate();
        //        $apn = new IGtAPNPayload();
        //        $alertmsg=new SimpleAlertMsg();
        //        $alertmsg->alertMsg="";
        //        $apn->alertMsg=$alertmsg;
        ////        $apn->badge=2;
        ////        $apn->sound="";
        //        $apn->add_customMsg("payload","payload");
        //        $apn->contentAvailable=1;
        //        $apn->category="ACTIONABLE";
        //        $template->set_apnInfo($apn);
        //        $message = new IGtSingleMessage();

        //APN高级推送
        $igt = new IGeTuiPush(NULL, $this->APPKEY, $this->MASTERSECRET);
        $template = new IGtAPNTemplate();
        $apn = new IGtAPNPayload();
        $alertmsg = new DictionaryAlertMsg();
        $alertmsg->body = "body";
        $alertmsg->actionLocKey = "查看";
        $alertmsg->locKey = $data['text'];
        $alertmsg->locArgs = array("locargs");
        $alertmsg->launchImage = "launchimage";
        //        IOS8.2 支持
        $alertmsg->title = $data['title'];
        $alertmsg->titleLocKey = $data['title'];
        $alertmsg->titleLocArgs = array("TitleLocArg");
        $apn->alertMsg = $alertmsg;

        //       $apn->badge=1;
//		$apn->sound="com.gexin.ios.silence";
        $apn->add_customMsg("payload", $data['content']);
//        $apn->contentAvailable=1;
        //        $apn->category="ACTIONABLE";
        $template->set_apnInfo($apn);
        $message = new IGtSingleMessage();

        //PushApn老方式传参
        //    $igt = new IGeTuiPush($this->HOST,$this->APPKEY,$this->MASTERSECRET);
        //    $template = new IGtAPNTemplate();
        //    $template->set_pushInfo("", 4, "", "", "", "", "", "");
        //    $message = new IGtSingleMessage();

        //多个用户推送接口
        putenv("needDetails=true");
        $listmessage = new IGtListMessage();
        $listmessage->set_data($template);
        $contentId = $igt->getAPNContentId($this->APPID, $listmessage);
        //$deviceTokenList = array("3337de7aa297065657c087a041d28b3c90c9ed51bdc37c58e8d13ced523f5f5f");
        $deviceTokenList = array($DeviceToken);
        $ret = $igt->pushAPNMessageToList($this->APPID, $contentId, $deviceTokenList);
        return $ret;
        //var_dump($ret);
    }

//用户状态查询
    function getUserStatus($cid)
    {
        $igt = new IGeTuiPush($this->HOST, $this->APPKEY, $this->MASTERSECRET);
        $rep = $igt->getClientIdStatus($this->APPID, $cid);
        //var_dump($rep);
        //echo("<br><br>");
        return $rep;
    }

//推送任务停止
    function stoptask()
    {

        $igt = new IGeTuiPush($this->HOST, $this->APPKEY, $this->MASTERSECRET);
        $igt->stop("OSA-1127_QYZyBzTPWz5ioFAixENzs3");
    }

//通过服务端设置ClientId的标签
    function setTag($cid)
    {
        $igt = new IGeTuiPush($this->HOST, $this->APPKEY, $this->MASTERSECRET);
        $tagList = array('', '中文', 'English');
        $rep = $igt->setClientTag($this->APPID, $cid, $tagList);
        //var_dump($rep);
        //echo("<br><br>");
        return $rep;
    }

    function getUserTags($cid)
    {
        $igt = new IGeTuiPush($this->HOST, $this->APPKEY, $this->MASTERSECRET);
        $rep = $igt->getUserTags($this->APPID, $cid);
        //$rep.connect();
        //var_dump($rep);
        //echo("<br><br>");
        return $rep;
    }

    //服务端推送接口，支持三个接口推送
    //1.PushMessageToSingle接口：支持对单个用户进行推送
    //2.PushMessageToList接口：支持对多个用户进行推送，建议为50个用户
    //3.pushMessageToApp接口：对单个应用下的所有用户进行推送，可根据省份，标签，机型过滤推送

    //单推接口案例
    function pushMessageToSingle($cid, $data, $template_id = 1)
    {
        //$igt = new IGeTuiPush($this->HOST,$this->APPKEY,$this->MASTERSECRET);
        $igt = new IGeTuiPush(NULL, $this->APPKEY, $this->MASTERSECRET, false);

        $template = $this->getTemplate($data, $template_id);

        //个推信息体
        $message = new IGtSingleMessage();
        $message->set_isOffline(true); //是否离线
        $message->set_offlineExpireTime(3600 * 12 * 1000); //离线时间
        $message->set_data($template); //设置推送消息类型

        //接收方
        $target = new IGtTarget();
        $target->set_appId($this->APPID);
        $target->set_clientId($cid);
        //$target->set_alias($this->alias);

        try {
            $rep = $igt->pushMessageToSingle($message, $target);
        } catch (RequestException $e) {
            $requstId = e . getRequestId();
            $rep = $igt->pushMessageToSingle($message, $target, $requstId);
        }
        return $rep;
    }

    function pushMessageToSingleBatch($cid,$data, $template_id=1)
    {
        putenv("gexin_pushSingleBatch_needAsync=false");

        $igt = new IGeTuiPush(NULL, $this->APPKEY, $this->MASTERSECRET);
        $batch = new IGtBatch($this->APPKEY, $igt);
        $batch->setApiUrl($this->HOST);
        //$igt->connect();
        //消息模版：
        // 1.TransmissionTemplate:透传功能模板
        // 2.LinkTemplate:通知打开链接功能模板
        // 3.NotificationTemplate：通知透传功能模板
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板

        //$template = IGtNotyPopLoadTemplateDemo();
        //$template = IGtLinkTemplateDemo();
        $template = $this->getTemplate($data, $template_id);
        //$template = IGtTransmissionTemplateDemo();

        //个推信息体
        $message = new IGtSingleMessage();
        $message->set_isOffline(true); //是否离线
        $message->set_offlineExpireTime(12 * 1000 * 3600); //离线时间
        $message->set_data($template); //设置推送消息类型
        //    $message->set_PushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送

        $target = new IGtTarget();
        $target->set_appId($this->APPID);
        $target->set_clientId($cid);
        $batch->add($message, $target);
        try {
            $rep = $batch->submit();
            var_dump($rep);
            echo("<br><br>");
        } catch (\Exception $e) {
            $rep = $batch->retry();
            var_dump($rep);
            echo("<br><br>");
        }
        return $rep;
    }

//多推接口案例
    function pushMessageToList($cid ,$data, $template_id=1)
    {
        putenv("gexin_pushList_needDetails=true");
        putenv("gexin_pushList_needAsync=true");

        $igt = new IGeTuiPush(NULL, $this->APPKEY, $this->MASTERSECRET);
        //消息模版：
        // 1.TransmissionTemplate:透传功能模板
        // 2.LinkTemplate:通知打开链接功能模板
        // 3.NotificationTemplate：通知透传功能模板
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板

        //$template = IGtNotyPopLoadTemplateDemo();
        //$template = IGtLinkTemplateDemo();
        //$template = IGtNotificationTemplateDemo();
        $template = $this->getTemplate($data, $template_id);
        //个推信息体
        $message = new IGtListMessage();
        $message->set_isOffline(true); //是否离线
        $message->set_offlineExpireTime(3600 * 12 * 1000); //离线时间
        $message->set_data($template); //设置推送消息类型
        //    $message->set_PushNetWorkType(1);	//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
        //    $contentId = $igt->getContentId($message);
        $contentId = $igt->getContentId($message, $data['task_alia_name']); //"toList任务别名功能"根据TaskId设置组名，支持下划线，中文，英文，数字

        //接收方1
        $target1 = new IGtTarget();
        $target1->set_appId($this->APPID);
        $target1->set_clientId($cid);
//    $target1->set_alias($this->alias);

        $targetList[] = $target1;

        $rep = $igt->pushMessageToList($contentId, $targetList);

        //var_dump($rep);
        //echo("<br><br>");
        return $rep;
    }

//群推接口案例
    function pushMessageToApp($data, $template_id=1)
    {
        $igt = new IGeTuiPush(NULL, $this->APPKEY, $this->MASTERSECRET);
        $template = $this->getTemplate($data, $template_id);
        //$template = IGtLinkTemplateDemo();
        //个推信息体
        //基于应用消息体
        $message = new IGtAppMessage();
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(10 * 60 * 1000); //离线时间单位为毫秒，例，两个小时离线为3600*1000*2
        $message->set_data($template);

        $appIdList = array($this->APPID);
        $phoneTypeList = $data['phone_type_list'];//array('ANDROID');
        $provinceList = $data['$province_list'];//array('浙江');
        $tagList = $data['tag_list'];//array('haha');
        //用户属性
        //$age = array("0000", "0010");

        //$cdt = new AppConditions();
        // $cdt->addCondition(AppConditions::PHONE_TYPE, $phoneTypeList);
        // $cdt->addCondition(AppConditions::REGION, $provinceList);
        //$cdt->addCondition(AppConditions::TAG, $tagList);
        //$cdt->addCondition("age", $age);

        $message->set_appIdList($appIdList);
        //$message->set_conditions($cdt->getCondition());

        $rep = $igt->pushMessageToApp($message, $data['task_name']);//"任务组名"

        //var_dump($rep);
        //echo("<br><br>");
        return $rep;
    }


    /**
     * 整合消息模板
     * @param $data
     * @param int $type 1透传功能模板,2通知弹框下载模板,3通知链接模板,4通知透传模板
     */
    public function getTemplate($data, $template_id = 1)
    {
        switch ($template_id) {
            case 1:
                //安卓通知栏提示 ios 会在应用内提示 透传功能模板
                $template = $this->IGtNotificationTemplate($data);
                break;
            case 2:
                //通知弹框下载模板
                $template = $this->IGtNotyPopLoadTemplate($data);
                break;
            case 3:
                //连接
                $template = $this->IGtLinkTemplate($data);
                break;
            case 4:
                //通知透传模板
                $template = $this->IGtTransmissionTemplate($data);
                break;
        }

        return $template;
    }


    //所有推送接口均支持四个消息模板，依次为通知弹框下载模板，通知链接模板，通知透传模板，透传模板
    //注：IOS离线推送需通过APN进行转发，需填写pushInfo字段，目前仅不支持通知弹框下载功能
    //这是下载模板  ios不支持
    function IGtNotyPopLoadTemplate($data)
    {
        $template = new IGtNotyPopLoadTemplate();

        $template->set_appId($this->APPID);//应用appid
        $template->set_appkey($this->APPKEY);//应用appkey
        //通知栏
        $template->set_notyTitle($data['notyTitle']);//通知栏标题
        $template->set_notyContent($data['notyContent']);//通知栏内容
        $template->set_notyIcon("");//通知栏logo
        $template->set_isBelled(true);//是否响铃
        $template->set_isVibrationed(true);//是否震动
        $template->set_isCleared(true);//通知栏是否可清除
        //弹框
        $template->set_popTitle($data['popTitle']);//弹框标题
        $template->set_popContent($data['popContent']);//弹框内容
        $template->set_popImage("");//弹框图片
        $template->set_popButton1("下载");//左键
        $template->set_popButton2("取消");//右键
        //下载
        $template->set_loadIcon("");//弹框图片
        $template->set_loadTitle($data['loadTitle']);
        $template->set_loadUrl($data['loadUrl']);
        $template->set_isAutoInstall(false);
        $template->set_isActived(true);
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息

        return $template;
    }

    //通知连接模板   安卓在通知栏打开连接   ios要在应用内弹出对话框 点击打开safari
    function IGtLinkTemplate($data)
    {
        $template = new IGtLinkTemplate();
        $template->set_appId($this->APPID); //应用appid
        $template->set_appkey($this->APPKEY); //应用$this->APPKEY
        $template->set_title($data['title']); //通知栏标题
        $template->set_text($data['text']); //通知栏内容
        $template->set_logo(""); //通知栏logo
        $template->set_isRing(true); //是否响铃
        $template->set_isVibrate(true); //是否震动
        $template->set_isClearable(true); //通知栏是否可清除
        $template->set_url($data['url']); //打开连接地址
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //iOS推送需要设置的pushInfo字段
        $apn = new IGtAPNPayload();
        $alertmsg = new DictionaryAlertMsg();
        $apn->alertMsg = $alertmsg;//"alertMsg";
        //$apn->badge = 11;
        $apn->actionLocKey = "启动";
        //        $apn->category = "ACTIONABLE";
        //        $apn->contentAvailable = 1;
        $apn->locKey = "通知栏内容";
        $apn->title = "通知栏标题";
        $apn->titleLocArgs = array("titleLocArgs");
        $apn->titleLocKey = "通知栏标题";
        $apn->body = "body";
        $apn->customMsg = array("payload" => "payload");
        $apn->launchImage = "launchImage";
        $apn->locArgs = array("locArgs");

        $apn->sound = ("test1.wav");;
        $template->set_apnInfo($apn);
        return $template;
    }

    //安卓通知栏推送  //通知透传 //IPHONE 会在应用内弹出提示
    function IGtNotificationTemplate($data)
    {
        $template = new IGtNotificationTemplate();
        $template->set_appId($this->APPID); //应用appid
        $template->set_appkey($this->APPKEY); //应用$this->APPKEY
        $template->set_transmissionType(1); //透传消息类型
        $template->set_transmissionContent($data['content']); //透传内容
        $template->set_title($data['title']); //通知栏标题
        $template->set_text($data['text']); //通知栏内容
        $template->set_logo(''); //通知栏logo
        $template->set_isRing(true); //是否响铃
        $template->set_isVibrate(true); //是否震动
        $template->set_isClearable(true); //通知栏是否可清除
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //iOS推送需要设置的pushInfo字段
        $apn = new IGtAPNPayload();
        $alertmsg = new DictionaryAlertMsg();
        $apn->alertMsg = $alertmsg;//"alertMsg";
        //$apn->badge = 11;
        $apn->actionLocKey = "启动";
        //        $apn->category = "ACTIONABLE";
        //        $apn->contentAvailable = 1;
        $apn->locKey = "通知栏内容";
        $apn->title = "通知栏标题";
        $apn->titleLocArgs = array("titleLocArgs");
        $apn->titleLocKey = "通知栏标题";
        $apn->body = "body";
        $apn->customMsg = array("payload" => "payload");
        $apn->launchImage = "launchImage";
        $apn->locArgs = array("locArgs");

        //$apn->sound=("test1.wav");;
        $template->set_apnInfo($apn);
        return $template;
    }

    //IPHONE 通知栏提示 //安卓会启动应用 可在应用内拿到透传的内容
    function IGtTransmissionTemplate($data)
    {
        $template = new IGtTransmissionTemplate();
        $template->set_appId($this->APPID); //应用appid
        $template->set_appkey($this->APPKEY); //应用$this->APPKEY
        $template->set_transmissionType(1); //透传消息类型
        $template->set_transmissionContent($data['content']); //透传内容
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //APN简单推送
        //        $template = new IGtAPNTemplate();
        //        $apn = new IGtAPNPayload();
        //        $alertmsg=new SimpleAlertMsg();
        //        $alertmsg->alertMsg="";
        //        $apn->alertMsg=$alertmsg;
        ////        $apn->badge=2;
        ////        $apn->sound="";
        //        $apn->add_customMsg("payload","payload");
        //        $apn->contentAvailable=1;
        //        $apn->category="ACTIONABLE";
        //        $template->set_apnInfo($apn);
        //        $message = new IGtSingleMessage();

        //APN高级推送
        $apn = new IGtAPNPayload();
        $alertmsg = new DictionaryAlertMsg();
        $alertmsg->body = $data['body'];
        $alertmsg->actionLocKey = "ActionLockey";
        $alertmsg->locKey = "LocKey";
        $alertmsg->locArgs = array("locargs");
        $alertmsg->launchImage = "launchimage";
//        IOS8.2 支持
        $alertmsg->title = $data['title'];
        $alertmsg->titleLocKey = "TitleLocKey";
        $alertmsg->titleLocArgs = array("TitleLocArg");

        $apn->alertMsg = $alertmsg;
        //$apn->badge = 7;
        $apn->sound = "";
        $apn->add_customMsg("payload", $data['payload']);
        $apn->contentAvailable = 1;
        $apn->category = "ACTIONABLE";
        $template->set_apnInfo($apn);

        return $template;
    }
}