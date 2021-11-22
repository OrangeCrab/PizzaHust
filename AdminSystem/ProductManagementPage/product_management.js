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

function deleteProduct(id) {
    option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
    if(!option) return;

    $.post('form_api.php', {
        'id': id,
        'action': 'delete'
    }, function(data) {
        location.reload()
    })
}

$(document).ready(function(){

	load_data();
	function load_data(query='')
	{
		$.ajax({
			url:"filter.php",
			method:"POST",
			data:{query:query},
			success:function(data)
			{
				$('#main_table > tbody').html(data);
			}
		})
	}

	$('#filter').change(function(){
		$('#category_selected').val($('#filter').val());
		var query = $('#category_selected').val();
		load_data(query);
	});
	
});

$(document).ready(function(){

    load_data();
   
    function load_data(query)
    {
        $.ajax({
            url:"fetch.php",
            method:"POST",
            data:{query:query},
            success:function(data)
            {
                $('#main_table > tbody').html(data);
            }
        });
    }
    $('#search_tf').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            load_data();
        }
        });
});  