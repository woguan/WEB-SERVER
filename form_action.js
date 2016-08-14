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

    document.body.style.backgroundColor = "#ce7e1b";



var textToFind = 'POST';

var dd = document.getElementById('method');
dd.option[1].text = 'CHANGING';

/*
for (var i = 0; i < dd.length; i++) {
    if (dd[i].options[0].text === textToFind) {
        dd[i].options[0].text = 'CHANGED POST';
        break;
    }x
}*/

