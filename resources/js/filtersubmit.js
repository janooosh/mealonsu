var forminputs = document.getElementsByTagName("input");
var formselects = document.getElementsByTagName("select");

for(var x = 0; x<forminputs.length; x++) {
    forminputs[x].addEventListener('change',function() {
        this.form.submit();
    })
}

for(var x = 0; x<formselects.length; x++) {
    formselects[x].addEventListener('change',function() {
        this.form.submit();
    })
}
