function $login(HTMLid){
    console.log('login');
    $(HTMLid).on('click', function(e){
        e.preventDefault();
        console.log($("#username").val());
        var username = $("#username").val();
        var password = $("#password").val();

            $.ajax({
                type: "POST",
                url: hosturl + "submit",
                data: "name="+username+"&pwd="+password,
                success: function(html){
                    console.log(html);
                    if(html=='true'){
                        $("#form-input").fadeOut("normal");
                        $("#shadow").fadeOut();
                        location.href = "dashboard";
                    } else {
                        alert("An error has occured.");
                    }
                }
            });
        return false;
    });
}
