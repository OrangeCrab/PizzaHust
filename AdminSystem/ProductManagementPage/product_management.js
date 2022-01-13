function addProduct() {
    document.getElementById('editProduct_popup').style.display = 'flex';
    document.getElementById('info_card').style.display = 'flex';
    document.getElementById('pizza_base_info_card').style.display = 'none';
    document.getElementById('edit_info_card').style.display = 'none';

    var detailRequest = new XMLHttpRequest();
    detailRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("info_card").innerHTML = detailRequest.responseText;
        }
    }
    detailRequest.open("GET", "product_popup.php?id="+0, true);
    detailRequest.send();
}

function openEditPopup(id) {
    document.getElementById('editProduct_popup').style.display = 'flex';
    document.getElementById('edit_info_card').style.display = 'flex';
    document.getElementById('info_card').style.display = 'none';
    document.getElementById('pizza_base_info_card').style.display = 'none';

    var detailRequest = new XMLHttpRequest();
    detailRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("edit_info_card").innerHTML = detailRequest.responseText;
        }
    }
    detailRequest.open("GET", "product_popup.php?id="+id, true);
    detailRequest.send();
}

function closePopup() {
    document.getElementById('editProduct_popup').style.display = "none";
}

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};

$(document).ready(function(){
    $('.deleteProductBtn').on('click',function(){
        option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?');
        if(!option) return;
        var trObj = $(this).closest("tr");
        var id = $(this).closest("tr").attr('id');
        $.ajax({
            type:'POST',
            url:'json_save.php',
            dataType: "json",
            data:'action=delete_product&id='+id,
            success:function(mes){
                if (mes.status == 'ok') {
                    trObj.remove();
                }
            }
        });
    });
});

function filterByCategory() {
    // Declare variables
    var selected, filter, table, tr, td, i, txtValue;
    selected = document.getElementById("filter");
    filter = selected.options[selected.selectedIndex].text;
    table = document.getElementById("main_table");
    tr = table.getElementsByTagName("tr");
    if (selected.selectedIndex == 0) {
        for (i = 0; i < tr.length; i++) {
            tr[i].style.display = "";
        }
    } else {
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[6];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}

function filterByName() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_tf");
    filter = input.value.toUpperCase();
    table = document.getElementById("main_table");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function openPizzaBase() {
    document.getElementById('editProduct_popup').style.display = 'flex';
    document.getElementById('pizza_base_info_card').style.display = 'flex';
    document.getElementById('info_card').style.display = 'none';
    document.getElementById('edit_info_card').style.display = 'none';
}

$(document).ready(function () {
    $('.add_pbBtn').on('click', function () {
        var name = $('#name').val();
        var price = $('#price').val();
        $.ajax({
            type:'POST',
            url:'json_save.php',
            dataType: "json",
            data:'action=add_pb&name='+name+'&price='+price,
            success:function(mes){
                if (mes.status == 'ok') {
                    location.reload();
                }
            }
        });
    });
});

$(document).ready(function(){
    $('.editBtn').on('click',function(){
        //hide edit span
        $(this).closest("tr").find(".editSpan").hide();
        //show edit input
        $(this).closest("tr").find(".editInput").show();
        //hide edit button
        $(this).closest("tr").find(".editBtn").hide();
        //show edit button
        $(this).closest("tr").find(".saveBtn").show();
    });
});

$(document).ready(function(){ 
    $('.saveBtn').on('click',function(){
        var trObj = $(this).closest("tr");
        var ID = trObj.attr('id');
        var inputData = trObj.find(".editInput").serialize();
        $.ajax({
            type:'POST',
            url:'json_save.php',
            dataType: "json",
            data:'action=edit&id='+ID+'&'+inputData,
            success:function(mes){
                if (mes.status == 'ok') {
                    trObj.find(".editSpan.name_span").text(mes.name);
                    trObj.find(".editSpan.price_span").text(mes.price);
                    
                    trObj.find(".editInput.name_input").text(mes.name);
                    trObj.find(".editInput.price_input").text(mes.price);
                    
                    trObj.find(".editInput").hide();
                    trObj.find(".saveBtn").hide();
                    trObj.find(".editSpan").show();
                    trObj.find(".editBtn").show();
                }
            }
        });
    });
});

$(document).ready(function(){  
    $('.deleteBtn').on('click',function(){
        option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
        if(!option) return;
        var trObj = $(this).closest("tr");
        var ID = trObj.attr('id');
        $.ajax({
            type:'POST',
            url:'json_save.php',
            dataType: "json",
            data:'action=delete_pb&id='+ID,
            success:function(mes){
                if(mes.status == 'ok'){
                    trObj.remove();
                } 
            }
        });
    });
});