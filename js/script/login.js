  //Login Validation
  if($("#login").length)
  {
      $("#loginForm").validate({
        rules:{
            userName: 'required',
            password:'required',
        },
        errorPlacement: function (error, element) {
            $(element).parent().append(error)
        },
        submitHandler: function(form) {
            form.submit();
        }

      });
  }