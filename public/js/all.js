$(document).on( "click", '.edit_button',function(e) {

        var name = $(this).data('name');
        <!-- var id = $(this).data('id'); -->
        <!-- var content = $(this).data('content'); -->
        <!-- var quote = $(this).data('quote'); -->

        <!-- $(".business_skill_id").val(id); -->
        $(".data_name").val(name);
        <!-- $(".business_skill_quote").val(quote); -->
       <!-- tinyMCE.get('business_skill_content').setContent(content); -->

});
