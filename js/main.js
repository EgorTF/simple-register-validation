$(() => {
    $("#my-form").on("submit", ({
        currentTarget,
        preventDefault
    }) => {
        const form = currentTarget;
        const errorMsg = $('#message');

        preventDefault();

        $.ajax({
            url: '../php/main.php',
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),

            success: ({ success, message }) => {
                errorMsg.removeClass('d-none alert-danger alert-success');

                if(!success) {
                    errorMsg.addClass('alert-danger');
                } else {
                    form.remove();
                    errorMsg.addClass('alert-success');
                }

                errorMsg.text(message);
            },
        });
    })
});