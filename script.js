document.getElementById("sign_up").addEventListener("click" , sign_up) ;
function sign_up(){
    document.getElementById("signup_red").classList.add('hidden'); 
    console.log("hee") ;
}
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}