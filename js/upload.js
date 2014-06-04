jQuery(document).ready(function($){
  $('#medical_records_button').click(function(e) {
    wp.media.editor.send.attachment = function(props, attachment){
        $("#"+id).val(attachment.url);
      };
    }

    wp.media.editor.open(button);
    return false;
  });
});