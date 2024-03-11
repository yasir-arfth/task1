 jQuery.validator.addMethod("noSpace", function(value, element) { 
    return value == '' || value.trim().length != 0;  
}, "No space please and don't leave it empty");
  jQuery.validator.addMethod("customEmail", function(value, element) { 
  return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ); 
}, "Please enter valid email address!");

var $myForm = $('#myForm');
if($myForm.length){
  $myForm.validate({
      rules:{
          name: {
              required: true,
              noSpace: true
          },
          surname: {
              required: true,
              noSpace: true
          },
          phone: {
              required: true,
              digits: true,
              minlength:10,
              maxlength:10
              
          },
          email: {
              required: true,
              customEmail: true
          },
          address: {
              required: true
          },
          country: {
              required: true
          },
          state:{
            required: true
          }
      },
      messages:{
          name: {
              required: 'Please enter Name!'
          },
          surname: {
              required: 'Please enter Surname!'
          },
          phone: {
              required: 'Please enter Phone !',
              digits: 'Please Enter Only Numbers!'
          },
          email: {
              required: 'Please enter NumberEmail!'
          },
          address: {
              required: 'Please Address!'
          },
          country: {
              required: 'Please Select Country!'
          },
          state: {
              required: 'Please Select State!'
          }
      }
  });
}
