function select_change() {
var z = document.getElementById("form_action").selectedIndex;
var z1 = document.getElementsByTagName("option")[z].value;
alert("Form action changed to " + z1);
}
function myfunction() {
if (validation()) {
// Calling Validation function.
//select option value from select tag and storing it in a variable.
var x = document.getElementById("form_action").selectedIndex;
var action = document.getElementsByTagName("option")[x].value;
if (action !== "") {
document.getElementById("form_id").action = action;
document.getElementById("form_id").submit();
} else {
alert("Please set form action");
}
}
}
// Name and Email validation Function.
function validation() {
var name = document.getElementById("name").value;
var email = document.getElementById("email").value;
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
if (name === '' || email === '') {
alert("Please fill all fields...!!!!!!");
return false;
} else if (!(email).match(emailReg)) {
alert("Invalid Email...!!!!!!");
return false;
} else {
return true;
}
}
