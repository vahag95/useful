$(document).ready( function() {
    var inputs = $('input:text');
    window.addEventListener("beforeunload", function (event) {
        for( var input in inputs ){
            var val = inputs[input].value;
            if( val && val !== '' ){
                event.returnValue = "All changes will lose";
            }else{
                window.onbeforeunload = null;
            }
        }
    });
})