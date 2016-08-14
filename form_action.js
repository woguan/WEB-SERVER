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

var textToFind = 'POST';

var dd = document.getElementById('method');
for (var i = 0; i < dd.options.length; i++) {
    if (dd.options[i].text === textToFind) {
        dd.options[i].text = 'CHANGED POST';
        break;
    }
}
