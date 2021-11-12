function mouseover(){
    var password = document.getElementById("password").value;
    var password_confirm = document.getElementById("password-confirm").value;
    var gmail = document.getElementById("gmail").value;
    if(password !== password_confirm){
        alert("Mật khẩu nhập không khớp !!!");
        password_confirm = null;
    }
}
function gmail(){
    var gmail = document.getElementById("gmail").value;
    var gmail_inform = document.getElementById("gmail-inform");
    const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
    var check = regex.test(gmail);

    if(!check){
        gmail_inform.textContent = "Trường này phải là gmail !";
    }
}
