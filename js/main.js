$(() => {
    // this is the id of the form
    $("#my-form").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        const form = $(this);
        const errorMsg = $('#message');

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


    });

});