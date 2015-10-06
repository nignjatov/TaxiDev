<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 12/12/14
 * Time: 20:56
 */
?>
<script type="text/javascript">
    function showGeneralPopUp(title, text, success){
        var icon_image = success ? 'icon_success.png' : 'icon_error.png';
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: title,
            // (string | mandatory) the text inside the notification
            text: text,
            // (string | optional) the image to display on the left
            image: '<?php echo base_url()?>application/views/images/'+icon_image,
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '5000',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });
    }
</script>