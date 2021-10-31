var addProductPopup = document.getElementById('addProduct_popup');
var addProductBtn = document.querySelectorAll('.addProduct_btn');
var close_add_Btn = document.querySelectorAll('.close_btn');
var addCf = document.getElementById('add_btn');
var editProductPopup = document.getElementById('editProduct_popup');
var editBtn = document.querySelectorAll('.edit_btn');
var close_edit_Btn = document.querySelectorAll('.close_btn');
var save = document.getElementById('save_btn');

var add_popup = function(){
    addProductPopup.classList.add('active');
}

addProductBtn.forEach((addProductBtn,i) => {
    addProductBtn.addEventListener("click" ,()=>{
        add_popup(i);
    });
});
close_add_Btn.forEach((close_add_Btn) =>{
    close_add_Btn.addEventListener("click", () =>{
        addProductPopup.classList.remove('active');
    });
});

addCf.addEventListener("click", () =>{
    addProductPopup.classList.remove('active');
});

var edit_popup = function(){
    editProductPopup.classList.add('active');
}
editBtn.forEach((editBtn,i) => {
    editBtn.addEventListener("click" ,()=>{
        edit_popup(i);
    });
});
save.addEventListener("click", () =>{
    editProductPopup.classList.remove('active');
});
close_edit_Btn.forEach((close_edit_Btn) =>{
    close_edit_Btn.addEventListener("click", () =>{
        editProductPopup.classList.remove('active');
    });
});