<script>
    $(function () {
        $("form").submit(function (e) {

            e.preventDefault();

            // Clear the errors
            $(".ajax-remove").remove();
            $(".row").removeClass('has-error');

            var $form = $(this);

            $('.save').addClass('disabled');

            $.post($form.attr("action"), $form.serialize())
                    .done(function (result) {
                        if (result['errors']) {

                            $('.save, .button').removeClass('disabled');

                            $.each(result['errors'], function (k, v) {
                                $('#' + k).closest('.row').addClass('has-error').prepend('<div class="small-12 columns ajax-remove help-block">' + v + '</div>');
                            });
                            return;
                        } else if (result['redirect']) {
                            return window.top.location.href = result['redirect'];
                        }
                    });
        });
    });
</script>