function cancel_inform(){
    document.getElementById('popup').style.display = 'none';
}
setTimeout(cancel_inform,3000);


// menu
pizza1 = document.getElementById('pizza');
beverage1 = document.getElementById('beverage');
salad1 = document.getElementById('salad');
spaghetti1 = document.getElementById('spaghetti');
bbq1 = document.getElementById('bbq');
combo1= document.getElementById('combo');

function pizza(){
    pizza1.style.display = "block";
    beverage1.style.display = "none";
    salad1.style.display = "none";
    spaghetti1.style.display = "none";
    bbq1.style.display = "none";
    combo1.style.display = "none";

}
function beverage(){
    pizza1.style.display = "none";
    beverage1.style.display = "block";
    salad1.style.display = "none";
    spaghetti1.style.display = "none";
    bbq1.style.display = "none";
    combo1.style.display = "none";

}
function salad(){
    pizza1.style.display = "none";
    beverage1.style.display = "none";
    salad1.style.display = "block";
    spaghetti1.style.display = "none";
    bbq1.style.display = "none";
    combo1.style.display = "none";

}
function spaghetti(){
    pizza1.style.display = "none";
    beverage1.style.display = "none";
    salad1.style.display = "none";
    spaghetti1.style.display = "block";
    bbq1.style.display = "none";
    combo1.style.display = "none";

}
function bbq(){
    pizza1.style.display = "none";
    beverage1.style.display = "none";
    salad1.style.display = "none";
    spaghetti1.style.display = "none";
    bbq1.style.display = "block";
    combo1.style.display = "none";

}
function combo(){
    pizza1.style.display = "none";
    beverage1.style.display = "none";
    salad1.style.display = "none";
    spaghetti1.style.display = "none";
    bbq1.style.display = "none";
    combo1.style.display = "block";

}