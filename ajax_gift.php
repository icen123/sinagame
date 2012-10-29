<?php

/**
 * 
 */

$data = array('code' => 0, 'data' => '');
echo '<script type="text/javascript">var frame = window.parent;while(frame != frame.parent && frame.name != "app_frame") {frame=frame.parent;}frame.Test.frameCallBack(' . json_encode($data) .');</script>';
    