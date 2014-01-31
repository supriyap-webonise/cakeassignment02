//email validation
function validate_email(val)
{

    var email = val.split(/[;,]+/); // split element by , and ;
    valid = true;
    for (var i in email)
    {
        if(!validateEmail(email[i]))
        {
            valid = false;
            $("#warning-message").html('Invalid email:'+email[i]);
            $("#schedule").attr('disabled', 'disabled');
        }
    }
    if(valid){
        $("#warning-message").html('');
        $("#schedule").removeAttr('disabled');
    }

}
//email validaiton
function validateEmail($email)
{
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( $email ) )
    {
        return false;
    } else {
        return true;
    }
}
//numeric validation for textbox
function validatePhone(obj)
{
    var number = $(obj).val();
    var filter = /^[0-9-+]+$/;
    if (filter.test(number))
    {
        return true;
    }
    else
    {
        $('#warning-message-'+$(obj).attr('id')).html(number+" is not a valid number");
    }
}