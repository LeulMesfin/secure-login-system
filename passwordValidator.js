
var pass = document.getElementById("password");
var length = document.getElementById("length");
var lower = document.getElementById("lower");
var upper = document.getElementById("upper");
var number = document.getElementById("number");
var alphanum = document.getElementById("chars");

/* This arrow function displays the password validation box once the password field is selected */
pass.onfocus = () => {
    document.getElementById("check-password").style.display = "block";
} 

/* This arrow function hides the password validation box once the password field is not selected */
/* might remove (not needed) */
pass.onblur = () => {
    document.getElementById("check-password").style.display = "none";
} 

pass.onkeyup = () => {
    // the g flag(global) searches for all occurences of a pattern within a target string
    // /[a-z]/g finds all occurences of a lowercase
    var lowercaseREGEX = /[a-z]/g;
    var uppercaseREGEX = /[A-Z]/g;
    var digitsREGEX = /[0-9]/g;
    var alphanumREGEX = /[#!"$%&'()*+,-.\/:;<>?@\[\\\]^_`{|}~]/g // '#' isnt being valided properly

    // length check
    if (pass.value.length >= 8) {
        length.classList.remove("incomplete");
        length.classList.add("complete");
    } else {
        length.classList.remove("complete");
        length.classList.add("incomplete");
    }

    // lowercase check
    // if the password contains a lowercase char, remove invalid class, add valid class to lower tag
    // if password doesn't contain lowercase, remove valid class, add invalid class to lower tag
    if (pass.value.match(lowercaseREGEX)) {
        // contains lowercase char
        lower.classList.remove("incomplete");
        lower.classList.add("complete");
    } else {
        // doesn't contain lowercase char
        lower.classList.remove("complete");
        lower.classList.add("incomplete");
    }

    // uppercase check
    // if the password contains a uppercase char, remove invalid class, add valid class to lower tag
    // if password doesn't contain uppercase, remove valid class, add invalid class to lower tag
    if (pass.value.match(uppercaseREGEX)) {
        // contains uppercase char
        upper.classList.remove("incomplete");
        upper.classList.add("complete");
    } else {
        // doesn't contain uppercase char
        upper.classList.remove("complete");
        upper.classList.add("incomplete");
    }

    // digits check
    // if the password contains a digit, remove invalid class, add valid class to lower tag
    // if password doesn't contain a digit remove valid class, add invalid class to lower tag
    if (pass.value.match(digitsREGEX)) {
        // contains a digit
        number.classList.remove("incomplete");
        number.classList.add("complete");
    } else {
        // doesn't contain a digit
        number.classList.remove("complete");
        number.classList.add("incomplete");
    }

    // alphanum check
    // if the password contains a alphanum char, remove invalid class, add valid class to lower tag
    // if password doesn't contain a alphanum char remove valid class, add invalid class to lower tag
    if (pass.value.match(alphanumREGEX)) {
        // contains alphanum char
        alphanum.classList.remove("incomplete");
        alphanum.classList.add("complete");
    } else {
        // doesn't contain alphanum char
        alphanum.classList.remove("complete");
        alphanum.classList.add("incomplete");
    }
}
