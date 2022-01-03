function send(){
    var name = document.getElementById('name').value;
    var sdt = document.getElementById('sdt').value;
    var quan_huyen =document.getElementById('diachi').value;
    var sonha = document.getElementById('quan_huyen').value
    var diachi = document.getElementById('diachi').value + ', ' + document.getElementById('quan_huyen').value;
    var thanhtoan = document.getElementById('thanhtoan').value;
    console.log(thanhtoan);
    if(thanhtoan == 0){
        confirm("Bạn chưa có sản phẩm nào trong giỏ hàng!");
        return false;
    } 
    if(name == "" || sdt ==""||quan_huyen ==""||diachi ==""){
        confirm("Vui lòng điền đầy đủ thông tin của bạn");
        return false;
    }
    if(sdt.length != 10 || isNaN(sdt)){
        confirm("Vui lòng Nhập đúng số điện thoại");
        return false;
    }
    if(quan_huyen == "" && sonha == " "){
        confirm("Vui lòng điền đầy đủ địa của bạn");
        return false;
    }
    confirm('Thông tin khách hàng: \nTên:'+name +'\nSđt: '+sdt+'\nĐịa chỉ: '+diachi+'\nNếu có sai sót thì mời bạn nhập lại! \nSau khi bạn đặt hàng, cửa hàng sẽ gọi lại cho bạn để xác nhận\nCảm ơn quý khách đã mua hàng ở PizzaHust!');
    alert("Bạn đã đặt hàng thành công! Bạn có thể quay lại trang chủ để mua hàng tiếp!")

}