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

  //  document.body.style.backgroundColor = "#fffe1b";
/*
function changeSelect() {
    if (document.getElementById("method").value == "POST") {
        document.body.style.backgroundColor = "#375e35";
        document.getElementById("hurl").method = "POST";
    } else if (document.getElementById("method").value == "GET") {
        document.body.style.backgroundColor = "#540c46";
        document.getElementById("hurl").method = "GET";
    } 
}*/

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


function myfunction(){
    if (document.getElementById("method").value == "POST") {
        document.getElementById("hurl").method = "POST";
    }else if (document.getElementById("method").value == "GET") {
        document.getElementById("hurl").method = "GET";
    }  
  
}

function delcookie(){
  document.body.style.backgroundColor = "#fffe1b";
  document.cookie = "Cookie_First_Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  document.cookie = "Cookie_Last_Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  document.cookie = "Cookie_Favorite_Color=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
}

var randNumber = getRandomInt(0,10);

if(randNumber > 7){
document.body.style.backgroundColor = "#f6f6f3";
}
else if (randNumber < 3){
document.body.style.backgroundColor = "#ec2a07";
}
else{
  document.body.style.backgroundColor = "#4807ec";
}

