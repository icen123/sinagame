<?php

/**
 * 
 * 微游戏API演示
 * 
 * 
 * @author ixqbar@gmail.com 
 * http://xingqiba.sinaapp.com
 * 
 * 需要注意api.class.php 139行 修改使其在32bit机器可以运行
 * 
 * 
 */

/**
 * 配置
 */
$config = array(
    'app_key'    => '1097955374',
    'app_secret' => '065715409686b24da87e85ba68bfc352',
    'app_url'    => 'http://game.weibo.com/zancol_hitom',
    'app_name'   => 'zancol_hitom',
    'game_url'   => 'http://sinagame.zancol.com/',
    'version'    => uniqid()
);

/**
 * 
 */

include_once './sdk/api.class.php';

class Weiyouxi_Api extends WeiyouxiClient {

    public function setSessionKey($sessionKey) {
        $this->sessionKey = $sessionKey;
    }

    public function setSignature($signature) {
        $this->signature = $signature;
    }

}

/**
 * 
 * 获取用户token信息并保存，以方便逻辑中请求API时使用
 * 
 */
$player_token = array(
    'session_key' => isset($_GET['wyx_session_key']) ? $_GET['wyx_session_key'] : '',
    'signature'   => isset($_GET['wyx_signature']) ? $_GET['wyx_signature'] : ''
);

$weiyouxi_handle = new Weiyouxi_Api($config['app_key'], $config['app_secret']);
$player_uid  = $weiyouxi_handle->getUserId();
$player_info = $weiyouxi_handle->get('user/show');
if (empty($player_info) || isset($player_info['error'])) {
    die("登录失败");
}

/**
 * 存储用户信息
 * @TODO
 */


/**
 * 打印用户应用好友
 * 获取安装本应用的互粉好友ID，注意API返回的某些玩家并不在游戏内(游戏自身维护期间，好友点击游戏平台已经认为他安装了游戏，但维护是这个用户并没有进入游戏DB)，
 * 所以使用该API自动添加为自己游戏邻居的需要判断该好友是否已经在游戏内
 */
$player_app_friend_ids = $weiyouxi_handle->get('user/app_friend_ids');
//var_dump($player_app_friend_ids);


/**
 * 
 * 发送成就
$params = array(
    'achv_id' => 1,
);
$weiyouxi_handle = new Weiyouxi_Api($config['app_key'], $sns_config['app_secret']);
$weiyouxi_handle->setSessionKey($player_token['session_key']);
$weiyouxi_handle->setSignature($player_token['signature']);
$post_response = $weiyouxi_handle->post('achievements/set', $params);
*/

/**
 * 发送排行
 * 注意目前平台只接受大于上次提交的排行分数
$params = array(
    'rank_id' => 1,
    'value'   => 100,
);

$weiyouxi_handle = new Weiyouxi_Api($config['app_key'], $config['app_secret']);
$weiyouxi_handle->setSessionKey($token['session_key']);
$weiyouxi_handle->setSignature($token['signature']);
$post_response = $weiyouxi_handle->post('leaderboards/set', $params);
*/


/**
 * 提示:
 * JS发布后最好压缩到一个JS文件
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>微博游戏API演示</title>
    </head>
    <body>
        <div><a href="javascript:Test.inviteFriend();">邀请好友</a></div>
        <div><a href="javascript:Test.sendGiftForOne({});">给某人发送礼物</a></div>
        <div><a href="javascript:Test.createFriend('2271093597');">关注好友</a></div>
        <div><a href="javascript:Test.postWall({});">发送新鲜事(又名贴墙)</a></div>
        <!--浮动层标记-->
        <div id="test-win" style="display:none;z-index:100;height:100%;width:100%;position:fixed;top:0px;left:0px;color:#fff;"></div>
    </body>
</html>
<script src=" http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=<?php echo $config['app_key'];?>" type="text/javascript"></script>
<script type="text/javascript" src="http://game.weibo.com/static/js/v0.3/wyx.connect.js.php"></script>
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://lib.sinaapp.com/js/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="<?php echo $config['game_url']; ?>js/test.util.js?v=<?php echo $config['version']; ?>"></script>
<script type="text/javascript" src="<?php echo $config['game_url']; ?>js/test.common.js?v=<?php echo $config['version']; ?>"></script>
<script type="text/javascript" src="<?php echo $config['game_url']; ?>js/test.data.js?v=<?php echo $config['version']; ?>"></script>
<script type="text/javascript" src="<?php echo $config['game_url']; ?>js/test.language.js?v=<?php echo $config['version']; ?>"></script>
<script type="text/javascript" src="<?php echo $config['game_url']; ?>js/test.template.js?v=<?php echo $config['version']; ?>"></script>
<script type="text/javascript">
    $(function(){
        Test.init({
            uid     : '<?php echo $player_uid;?>',
            appKey  : '<?php echo $config['app_key'];?>',
            appURL  : '<?php echo $config['app_url'];?>',
            gameURL : '<?php echo $config['game_url'];?>'
        });
    });
</script>