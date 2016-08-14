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
375e35

function changeSelect() {
    if (document.getElementById("method").value == "POST") {
        document.body.style.backgroundColor = "#375e35";
    } else if (document.getElementById("method").value == "GET") {
        document.body.style.backgroundColor = "#540c46";
    } 
}
