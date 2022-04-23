$('document').ready(function () {
  /* validation */
  $('#loginForm').validate({
    rules: {
      username: {
        required: true,
        email: true,
      },

      password: {
        required: true,
      },
    },

    messages: {
      username: { required: 'Please enter your email' },
      password: { required: 'Please enter your password' },
    },
    errorElement: 'span',
    errorClass: 'help-block',

    submitHandler: submitForm,
  })
  /* validation */

  /* login submit */
  function submitForm() {
    var data = $('#loginForm').serialize()

    $.ajax({
      type: 'POST',
      cache: false,
      url: 'models/mailer-ajax.php',
      data: data,
      beforeSend: function () {
        $('#error').fadeOut()
        $('#btn-send').html(
          '<span class="fa fa-spinner fa-spin"></span> &nbsp; loging in...'
        )
      },
      success: function (response) {
        if (response == 'ok') {
          $('#btn-send').html(
            '<span class="fa fa-spinner fa-spin"></span> &nbsp; loging...'
          )
          $('#btn-send').html('Sign in')
          setTimeout('alert("Success")', 3000)
          $('#loginForm').trigger('reset')
        } else {
          $('#error').fadeIn(1000, function () {
            $('#error').html(response)
            $('#btn-send').html('Sign in')
            // $('#contactForm').trigger('reset')
          })
        }

        //Auto Notification dismiss
        window.setTimeout(function () {
          $('#error')
            .fadeTo(500, 0)
            .slideUp(500, function () {
              $(this).remove()
            })
        }, 5000)
      },
    })
    return false
  }
})
