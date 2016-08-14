/*
function myfunction() {
if (validation()) {
// Calling Validation function.
//select option value from select tag and storing it in a variable.
var x = document.getElementById("method").selectedIndex;

if (x == "POST"){
  
}

document.getElementById("hurl").method = "POST";
document.getElementById("form_id").submit();
} 

}*/

    document.body.style.backgroundColor = "#fffe1b";


function changeSelect() {
    if (document.getElementById("method").value == "POST") {
        document.getElementById("method").innerHTML = "POSTCH";
    } else if (document.getElementById("method").value == "GET") {
        document.getElementById("method").innerHTML = "GETC";
    } 
}
