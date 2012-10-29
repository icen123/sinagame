<?php


/**
 *
 * @param array $data
 */
function callback($data) {
    die('<script type="text/javascript">var frame = window.parent;while(frame != frame.parent && frame.name != "app_frame") {frame=frame.parent;}frame.Test.frameCallBack(' . json_encode($data) .');</script>');
}

$post_select_uids = isset($_POST['ids']) ? explode(',', $_POST['ids']) : array();
if (empty($post_select_uids)) {
    callback(array('code' => 1, 'data' => '', 'error' => 'error select uids'));
}

/**
 * 
 * @TODO 逻辑处理
 * 
 */



//响应
$response = array('code' => 0, 'data' => $_POST['ids'], 'error' => '');

callback($response);
?>
