jQuery(document).ready(function($) {
    function setImagePreview(input, imageField, previewImage, removeButton) {
        wp.media.editor.send.attachment = function(props, attachment) {
            imageField.val(attachment.id);
            previewImage.attr('src', attachment.url).show();
            removeButton.show();
        };
        wp.media.editor.open(input);
    }

    $('.portfolio-category-upload').click(function(e) {
        e.preventDefault();
        setImagePreview($(this), $('#portfolio_category_image'), $('#portfolio_category_preview'), $('.portfolio-category-remove'));
    });

    $('.portfolio-category-remove').click(function(e) {
        e.preventDefault();
        $('#portfolio_category_image').val('');
        $('#portfolio_category_preview').hide();
        $(this).hide();
    });
});
