function buscar(form) {
    var str = document.getElementById('googlebox').value;
    // str = "https://www.google.com/search?q=" + str;
    var replaced = str.replace(" ","+");
    location.assign("https://www.google.com/search?q="+str);

}

document.querySelector('#googlebox').addEventListener('keypress', function keyupText(e) {
    var key = e.which || e.keyCode;
    if (key === 13) {
      e.preventDefault();
      buscar(document.querySelector('.form'));
    }
});

// verificando codigo de teclas, presiona una tecla y ver en consola.
window.addEventListener('keydown', function (e) {
    console.log(e);
});