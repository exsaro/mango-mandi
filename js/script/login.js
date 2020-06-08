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


/* Print the Page */
function printPage(check,page){
    if(check == 'printCheck')
        window.print();
        
    window.location = "../View/"+page+".php";
}
