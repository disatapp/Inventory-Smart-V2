function $signup(HTMLid,hosturl){
    console.log('signup');
    $(HTMLid).on('click', function(e){
        e.preventDefault();
        console.log($("#username").val());
        var username = $("#username").val();
        var password = $("#password").val();
        $.ajax({
        type: "POST",
        url: hosturl + "submit",
        data: "name="+username+"&pwd="+password,
        dataType: 'text',
        success: function(html){
                    console.log(html);
                    if(html=='true'){
                        location.href = hosturl + "success";
                    } else {
                        alert("An error has occured.");
                    }
                }
            });
            return false;
        });
}
