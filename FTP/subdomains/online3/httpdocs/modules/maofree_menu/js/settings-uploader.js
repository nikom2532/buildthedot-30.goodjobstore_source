$(document).ready(function() {
   $('#file_upload').uploadify({
      'uploader'  : absolute_url + '/js/uploadify/uploadify.swf',
      'script'    : absolute_url + '/js/uploadify/uploadify.php',
      'cancelImg' : absolute_url + '/js/uploadify/cancel.png',
      'folder'    : absolute_url + '/img/menu/custom',
      'removeCompleted' : false,
      'multi'     : true,
      'sizeLimit' : 1000000,
      'simUploadLimit' : 7,
      'fileExt'   : '*.gif',
      'fileDesc'  : 'Only Gif Images',
      'buttonText' : 'SELECT IMAGES',
      'auto'      : true
   });
});
