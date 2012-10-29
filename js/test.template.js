/**
 * 
 * 
 * @author ixqbar@gmail.com 
 * http://xingqiba.sinaapp.com
 * 
 * 
 * 
 */

if (typeof Test == 'undefined') {
    Test = {};
}

Test.template = {}

Test.template.platform = [
    '<p class="close"><a href="javascript:void(0);">关闭</a></p>',
    '<div class="requestForm">',
    '<iframe width="${width}px" height="${height}px" frameborder="0" src="" name="friendSelector" scrolling="no" id="friendSelector"></iframe>',
    '<form method="post" action="http://game.weibo.com/home/widget/requestForm" id="weiboForm" target="friendSelector">',
        '<input type="hidden" name="target" value="self" />',
        '<input type="hidden" name="appId" value="${appId}" />',
        '<input type="hidden" name="modes" value="${modes}" />',
        '<input type="hidden" name="selectedMode" value="all" />',
        '<input type="hidden" name="action" value="${action}" />',
        '<input type="hidden" name="excludedIds" value="${excludeIds}" />',
        '<input type="hidden" name="pageSize" value="${pageSize}" />',
        '<input type="hidden" name="content" value="${content}" />',
        '<input type="hidden" name="callback" value="${callback}" />',
    '</form>',
    '</div>'
];