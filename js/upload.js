function htmlEncode(value){ 
    if (value) {
        return jQuery('<div/>').text(value).html(); 
    } else {
        return '';
    }
}

jQuery(document).ready(function($){
  var attachments = [];
  $('#medical_records_button').click(function(e) {
    e.preventDefault();
    wp.media.editor.send.attachment = function(props, attachment){
        var nonce = jQuery("input[name='document_nonce']").attr("value");
        var pid = MediaUpload.post_id;
        var aid = attachment.id;
        jQuery.get(MediaUpload.ajax_url + "?action=documentUploadCB&pid=" + pid + "&nonce=" + nonce + "&aid=" + aid);
      };
      wp.media.editor.open($(this));
      return false;
  });
});

jQuery(document).ready(function($){
  var attachments = [];
  $('#medical_records_button_old').click(function(e) {
    e.preventDefault();
    wp.media.editor.send.attachment = function(props, attachment){
        attachments.push(attachment.url);
        console.log(JSON.stringify(attachments));
        $("#medical_records_files").prop("value", "{\"mystuff\":" + JSON.stringify(attachments) + "}");
      };
      wp.media.editor.open($(this));
      return false;
  });
});