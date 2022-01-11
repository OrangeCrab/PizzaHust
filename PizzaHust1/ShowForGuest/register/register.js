
    var password = document.getElementById("password").value;
    var password_confirm = document.getElementById("password-confirm").value;
    var password_inform = document.getElementById("pass-inform");
    // var gmail = document.getElementById("gmail").value;
    if(password !== password_confirm){
        password_inform.textContent = "Mật khẩu không khớp !";
    }


    var gmail = document.getElementById("gmail").value;
    var gmail_inform = document.getElementById("gmail-inform");
    const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
    var check = regex.test(gmail);

    if(!check){
        gmail_inform.textContent = "Trường này phải là gmail !";
    }
    

    

