$(document).ready(function () {
    var editProductPopup = document.getElementById('Product_popup');
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

function deleteCoupon(id) {
    option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
    if(!option) return;
    $.post('ajaxcp.php', {
        'id': id,
        'action': 'delete'
    }, function(data) {
        location.reload();
    })
}
// $(document).on('keyup', 'input[name=value_cp]', function() {
//     var _this = $(this);
//     var min = parseInt(_this.attr('min')) || 1; // if min attribute is not defined, 1 is default
//     var max = parseInt(_this.attr('max')) || 100; // if max attribute is not defined, 100 is default
//     var val = parseInt(_this.val()) || (min - 1); // if input char is not a number the value will be (min - 1) so first condition will be true
//     if (val < min)
//       _this.val(min);
//     if (val > max)
//       _this.val(max);
//   });

// $(document).ready(function(){

// 	load_data();
// 	function load_data(query='')
// 	{
// 		$.ajax({
// 			url:"filter.php",
// 			method:"POST",
// 			data:{query:query},
// 			success:function(data)
// 			{
// 				$('#main_table > tbody').html(data);
// 			}
// 		})
// 	}

// 	$('#filter').change(function(){
// 		$('#category_selected').val($('#filter').val());
// 		var query = $('#category_selected').val();
// 		load_data(query);
// 	});
	
// });

// $(document).ready(function(){

//     load_data();
   
//     function load_data(query)
//     {
//         $.ajax({
//             url:"fetch.php",
//             method:"POST",
//             data:{query:query},
//             success:function(data)
//             {
//                 $('#main_table > tbody').html(data);
//             }
//         });
//     }
//     $('#search_tf').keyup(function(){
//         var search = $(this).val();
//         if(search != '')
//         {
//             load_data(search);
//         }
//         else
//         {
//             load_data();
//         }
//         });
// });  