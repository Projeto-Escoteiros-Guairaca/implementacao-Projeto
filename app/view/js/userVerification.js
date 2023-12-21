var elements = document.getElementsByClassName("form-control");
var isEmpty = false;

var startVerification = function(lol) {
    input = lol["target"];

    position = input.id.search("-");
    apsod

    if(input.value.trim().length == 0) {
        isEmpty = true;
    }
    else {
        isEmpty = false;
    }

};

for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('focusout', startVerification, false);
}


function cantBeNull() {

}