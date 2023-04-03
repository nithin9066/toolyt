$(function(){
    $("#switch").click(function(){
        if($(this).html() == 'Sign up')
        {
            $(this).html('Sign in')
            $('#signin').addClass('d-none')
            $('#signup').removeClass('d-none')
            document.title = "Sign up"
        }
        else
        {
            $(this).html('Sign up')
            $('#signup').addClass('d-none')
            $('#signin').removeClass('d-none')
            document.title = "Sign in"
        }
    })
})