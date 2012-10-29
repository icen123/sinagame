/**
 * 
 * 
 * @author ixqbar@gmail.com 
 * http://xingqiba.sinaapp.com
 * 
 * 
 * 
 */

var Test = {
    log : function(message) {
        if (typeof console != 'undefined') {
            if (typeof message != 'object') {
                console.log('Debug:' + message);
            } else {
                console.dir(message);
            }
        }
    },
    /**
     * ajax封装
     */
    post : function(url,data,callback) {
        $.post(url,$.extend({}, data),function(data){
            if (typeof callback != 'undefined') {
                callback(data);
            }
        });
    },
    /**
     *
     */
    init : function(options) {
        //游戏其他默认配置
        this.initOption = $.extend({
            
        },options);
        //初始JS-SDK
        WYX.Connect.init();
        //后续其他加载
        //@TODO
    },
    /**
     * 平台接口窗口
     */
    platformWin : function(winParams) {
        var _winParams = $.extend(true, {
            data : {
                modes       : 'all,af,naf,wyxf,bf',
                excludedIds : '',
                pageSize    : 24
            },
            template : '',
            width    : 740,
            height   : 600,
            close    : true
        }, winParams);
        var _content = '<div class="close">关闭</div>';
        if (_winParams.data && _winParams.template) {
            _content = this.template[_winParams.template].join('').process(_winParams.data);
        } else {
            this.log("error params for atlantis.win");
        }
        $('#test-win #platform-win').remove();
        $('#test-win').append('<div id="platform-win" style="position:absolute;left:50%;top:12%;margin-left:-' + _winParams.width / 2 + 'px;width:' + _winParams.width + 'px;height:' + _winParams.height + 'px;z-index:200;border:1px solid blue;">' + _content + '</div>').show();
        $('#test-win #platform-win #weiboForm').submit();
        if (_winParams.close) {
            $('#test-win #platform-win .close').click(function(){
                $('#test-win #platform-win').remove();
                if (0 == $('#test-win div').length) {
                    $('#test-win').hide();
                }
            });
        }
    },
    /**
     * 邀请好友
     */
    inviteFriend : function() {
        this.platformWin({
            template : 'platform',
            data     : {
                width    : 700,
                height   : 468,
                appId    : this.initOption.appKey,
                action   : this.initOption.gameURL + 'ajax_invite.php',
                content  : this.language.inviteContent,
                callback : this.initOption.appURL + '?invite_uid=' + this.initOption.uid,
                excludeIds : ''
            }
        });
    },
    /**
     * 关注好友
     */
    createFriend : function(fuid) {
        var _this = this;
        WB2.anyWhere(function(W){
            W.parseCMD("/friendships/create.json", function(sResult, bStatus){
               _this.log(sResult);
               _this.log(bStatus);
            },{
                uid : fuid
            },{
                method: 'post'
            });
        });
    },
    /**
     * 给某人发送礼物
     */
    sendGiftForOne : function(params) {
        /**
         * 使用单人邀请接口
         */
        var _this = this;
        WYX.Connect.send({
           method:'invite',
           params:{
               appId    : this.initOption.appKey,
               uid      : this.initOption.uid,
               friends  : [{id : '2271093597', name : '星期八的游戏'}], //这里需要替换为对方uid,name
               content  : this.language.sendGiftForOneContent,
               title    : this.language.sendGiftForOneTitle,
               inviteCallback : _this.initOption.appURL, //对方点击后跳转的地址
               action   : '', //留空
               target   : 'top'
           }
        }, function(data) {
            /**
             * 注意这里成功时返回的是字符串 true
             */
            if ('true' == data) {
                _this.post('ajax_gift.php',{}, function(data){
                    _this.frameCallBack(JSON.parse(data));
                });
            }
        });
    },    
    /**
     * 选择用户发送礼物
     */
    sendGiftForAll : function() {
        //功能类似inviteFriend
    },
    /**
     * 贴墙(发送新鲜事)
     */
    postWall : function(params) {
        var _this = this;
        this.post('ajax_get.php', {}, function(data){
            var response = JSON.parse(data);
            if (0 == response.code) {
                _this.log(_this.initOption);
                _this.log(response);
                WYX.Connect.send({
                    method : 'sendWeibo',
                    params : {
                        appId           : _this.initOption.appKey,
                        title           : response.data.title,
                        content         : response.data.content,
                        actionText      : response.data.actionText,
                        templateContent : response.data.templateContent,
                        link            : _this.initOption.appURL,
                        actionUrl       : _this.initOption.appURL,
                        imageUrl        : response.data.imageUrl
                    }
                },function(data) {
                    /**
                     * 注意这里成功时返回的是字符串 true
                     */
                    if ('true' == data) {
                        _this.post('ajax_wall.php', {},function(resp){
                            _this.log(resp);
                        });                        
                    } else {
                        _this.log("postwall failure");
                    }
                });
            } else {
                _this.log(response.error);
            }
        });
    },
    /**
     * 用于关闭使用JS－SDK发送邀请后关闭弹出的窗口
     */
    frameCallBack : function(data) {
        this.log(data);
        //关闭窗口
        $('#test-win #platform-win').remove();
        if (0 == $('#test-win div').length) {
            $('#test-win').hide();
        }
    }
    /**
     * 充值
     * @TODO
     */
}
