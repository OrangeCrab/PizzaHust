//OPEN POP UP
function openPopup(str){
    //Tạo request lên CSDL lấy thông tin chi tiết theo mã đơn hàng
    //và in chi tiết ra một file php bên ngoài "DetailPopUp.php"
    //"nhúng" nội dung file trên vào phần pop up
    document.getElementById("popup_background").style.display = "block";
    var detailRequest = new XMLHttpRequest();

    detailRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("popup_panel").innerHTML = detailRequest.responseText;
        }
    }

    detailRequest.open("GET", "DetailPopUp.php?orderid="+str, true);
    detailRequest.send();
}

function openPopupFromElement(elem){
    //Khi ấn vào một mã đơn hàng thì sẽ lấy nội dung mã đó
    var str = elem.innerText || elem.textContent;
    if (str == ""){
        return;
    }

    openPopup(str);
}

var isChange = false;

function closePopup(){
    document.getElementById("popup_background").style.display = "none";
    if (isChange) {
        isChange = false;
        location.reload();
    }
}

function orderConfirmButtonChange(id) {
    var option = confirm("Bạn có chắc chắn muốn xác nhận đơn hàng này không?");
    if (!option) return;

    $.post('popup_api.php', {
        'id': id,
        'action': 'confirm'
    }, function(data){
        isChange = true;
        openPopup(id);
    });
}

function orderRejectButtonChange(id) {
    var option = confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');
    if (!option) return;

    $.post('popup_api.php', {
        'id': id,
        'action': 'reject'
    }, function(data){
        isChange = true;
        openPopup(id);
    });
}

//SORT TABLE
function sortTable(id, n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(id);
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

//SEARCH TABLE
function searchTable() {
    var searchOption, input, filter, table, tr, td, i, txtValue;
    searchOption = document.getElementById("searchOption").selectedIndex;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("OrderList");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[searchOption];

        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// NAVI TABLE
function filterStatus(filter){
    buttonAll = document.getElementById("filterButtonAll");
    buttonWaiting = document.getElementById("filterButtonWaiting");
    buttonConfirmed = document.getElementById("filterButtonConfirmed");
    buttonRejected = document.getElementById("filterButtonRejected");

    buttonAll.style.border = "none";
    buttonWaiting.style.border = "none";
    buttonConfirmed.style.border = "none";
    buttonRejected.style.border = "none";

    if (filter == ''){
        buttonAll.style.borderBottom = "3px solid #A80000";
        filterText = "";
    } else if (filter == '1'){
        buttonWaiting.style.borderBottom = "3px solid #A80000";
        filterText = "chờ xác nhận";
    } else if (filter == '2'){
        buttonConfirmed.style.borderBottom = "3px solid #A80000";
        filterText = "đã xác nhận";
    } else if (filter == '3'){
        buttonRejected.style.borderBottom = "3px solid #A80000";
        filterText = "đã bị hủy";
    }

    table = document.getElementById("OrderList");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++){
        td = tr[i].getElementsByTagName("td")[6];
        if (td){
            txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(filterText) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

//FILTER TABLE
// Chưa hoàn thành
$(document).ready(function () {
    $(".Orderlist_head th").click(showFilterOption(this));
});

var arrayMap = {};

function showFilterOption(tdObject) {
    var filterGrid = $(tdObject).find(".filter");

    if (filterGrid.is(":visible")) {
        filterGrid.hide();
        return;
    }

    $(".filter").hide();

    var index = 0;
    filterGrid.empty();
    var allSelected = true;
    filterGrid.append('<div><input id="all" type="checkbox" checked>Select All</div>');

    var $rows = $(tdObject).parents("table").find("td");

    $rows.each(function (ind, ele) {
        var currentTd = $(ele).children()[$(tdObject).attr("index")];
        var div = document.createElement("div");
        div.classList.add("grid-item")
        var str = $(ele).is(":visible") ? 'checked' : '';
        if ($(ele).is(":hidden")) {
            allSelected = false;
        }
        div.innerHTML = '<input type="checkbox" ' + str + ' >' + currentTd.innerHTML;
        filterGrid.append(div);
        arrayMap[index] = ele;
        index++;
    });

    if (!allSelected) {
        filterGrid.find("#all").removeAttr("checked");
    }

    filterGrid.append('<div><input id="close" type="button" value="Close"/><input id="ok" type="button" value="Ok"/></div>');
    filterGrid.show();

    var $closeBtn = filterGrid.find("#close");
    var $okBtn = filterGrid.find("#ok");
    var $checkElems = filterGrid.find("input[type='checkbox']");
    var $gridItems = filterGrid.find(".grid-item");
    var $all = filterGrid.find("#all");

    $closeBtn.click(function () {
        filterGrid.hide();
        return false;
    });

    $okBtn.click(function () {
        filterGrid.find(".grid-item").each(function (ind, ele) {
            if ($(ele).find("input").is(":checked")) {
                $(arrayMap[ind]).show();
            } else {
                $(arrayMap[ind]).hide();
            }
        });
        filterGrid.hide();
        return false;
    });

    $checkElems.click(function (event) {
        event.stopPropagation();
    });

    $gridItems.click(function (event) {
        var chk = $(this).find("input[type='checkbox']");
        $(chk).prop("checked", !$(chk).is(":checked"));
    });

    $all.change(function () {
        var chked = $(this).is(":checked");
        filterGrid.find(".grid-item [type='checkbox']").prop("checked", chked);
    })

    filterGrid.click(function (event) {
        event.stopPropagation();
    });

    return filterGrid;

}