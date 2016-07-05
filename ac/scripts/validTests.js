$(document).ready(function(){
        $('#signup').validate(
            {
                // validate on focus out, but on live form ONLY works with input="text". All others will be validated on submit
                // http://stackoverflow.com/questions/10151266/showing-error-off-focus-validation-jquery
                onfocusout: function(element) { 
                    $(element).valid(); 
                },

                rules:{
                    name:'required',
                    email:{
                        required:true,
                        email:true
                    }, //closes email
                    url:{
                        required:true,
                        url:true
                    }, //closes url
                    phone:{
                        minlength:12
                    } //closes phone
                }, //closes rules

                messages:{
                    name:{
                        required:"Please supply your name"
                    },//closes name message
                    email:{
                        required:"please supply your email",
                        email:"this is not a valid email"
                    }, //closes email message
                    url:{
                        required:"please supply your url",
                        url:"this is not a valid url"
                    }, //closes url messages
                    phone:{
                        minlength:"please use this format: xxx-xxx-xxxx"
                    }//end phone messages
                },//closes messages
                errorPlacement:function(error,element){
                    if(element.is(":radio")||element.is(":checkbox")){
                        error.appendTo(element.parent());
                    }else{
                        error.insertAfter(element);
                    }

                }//end of error placement

            });//end of validate
    }); //end of doc ready