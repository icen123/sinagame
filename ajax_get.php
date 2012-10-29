<?php

/**
 * 游戏逻辑
 */


/**
 * 注意所有的字符长度不能太长,图片平台要能访问到，否则贴墙窗口就有可能出不来
 * 
 */
$data = array(
    'title'           => '新鲜事－title',
    'content'         => '新鲜事－content',
    'actionText'      => '新鲜事－actionText',
    'templateContent' => '新鲜事－templateContent',
    'imageUrl'        => 'http://wyx-dev.break.sh.cn/images/post_wall/friendly.png'
);


echo json_encode(array('code' => 0, 'data' => $data));