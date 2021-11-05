$(document).ready(function () {
    var editProductPopup = document.getElementById('editProduct_popup');
    var editBtn = document.querySelectorAll('.add_button');
    var close_edit_Btn = document.querySelectorAll('.close_btn');
    var edit_popup = function(){
        editProductPopup.classList.add('active');
    }
    editBtn.forEach((editBtn,i) => {
        editBtn.addEventListener("click" ,()=>{
            edit_popup(i);
        });
    });
    close_edit_Btn.forEach((close_edit_Btn) =>{
        close_edit_Btn.addEventListener("click", () =>{
            editProductPopup.classList.remove('active');
        });
    }); 
});