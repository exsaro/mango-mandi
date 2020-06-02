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


  function printFarmerPayment(){
    // var printContents = document.getElementById("print_part").innerHTML;
    //     var originalContents = document.body.innerHTML;
    //     document.body.innerHTML = printContents;
    //     window.print();
    //     document.body.innerHTML = originalContents
    // $("#print_part").show();
    // window.print();
    // // $("#print_part").print();
}