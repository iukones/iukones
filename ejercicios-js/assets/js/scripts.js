document.querySelector('#rank-input').addEventListener('keypress', function keyUpText(e) {
  var key = e.which || e.keyCode;
  if (key === 13) {
    e.preventDefault();
    cambiarPassword(document.querySelector('.form'));
  }
})

function cambiarPassword(form) {
  var password = form.passInput.value;
  console.log(form.passInput.value);
  var newPassword = "";

  for(var i = 0; i < password.length; i++) {
    if(password[i] == "a") {
      newPassword = newPassword + "";
    }else if (password[i] == "e") {
      newPassword = newPassword + "";
    }else if (password[i] == "i") {
      newPassword = newPassword + "";
    }else if (password[i] == "o") {
      newPassword = newPassword + "";
    }else if (password[i] == "u") {
      newPassword = newPassword + "";
    }else {
      newPassword = newPassword + password[i];
    }
  }
  console.log('tu nuevo pass: ' + newPassword);
  document.querySelector('.new-pass').innerHTML = '¡ " ' + newPassword + ' " es tu nueva contraseña!';
}


function startPalindrome() {
  var word = prompt('¿Ingresa una palabra para ver si es un Palindromo');

  function palindrome(word) {
    var newWord = word.toLowerCase();
    newWord = newWord.replace(/\s/g, '');
    for(var i = 1; i < newWord.length; i++) {
      if (newWord[i - 1] != newWord[newWord.length - i]) {
        document.querySelector('.palindrome-phrase').innerHTML = '¡"' + word + '" no es un palindromo :(';
        return;
      }
    }
    document.querySelector('.palindrome-phrase').innerHTML = '¡"' + word + '" es un palindromo!';
  };
document.querySelector('.palindrome').addEventListener('click', startPalindrome);
  palindrome(word);
}

function startPalindromTwo() {
  var word = prompt('¿Ingresa una palabra para ver si es un Palindromo');
  var newWord = word.toLowerCase().replace(/\s/g, '');
  newWord = newWord.split("").reverse();
  if (word == newWord) {
    document.querySelector('.palindrome-phrase').innerHTML = '¡"' + word + '" es un paindromo!';
  } else {
    document.querySelector('.palindrome-phrase').innerHTML = '¡"' + word + '" no es un palindromo :(';
  }
}

function startPalindromTree() {
  var word = prompt('¿Ingresa una palabra para ver si es un Palindromo');
  word = word.toLowerCase().replace(/\s/g, '');
  var newWord = '';
  for (i = word.length-1; i >= 0; i--) {
    newWord = newWord + word[i];
  }
  if (word == newWord) {
    document.querySelector('.palindrome-phrase').innerHTML = '¡"' + word + '" es un paindromo!';
  } else {
    document.querySelector('.palindrome-phrase').innerHTML = '¡"' + word + '" no es un palindromo :(';
  }
}


function pyramid(form) {
  var floors = form.floorsInput.value;
  console.log(form.floorsInput.value);
  var space = '';
  var bricks = '';
  for(var i = 0; i < floors; i++) {
    space = ' '.repeat(floors - i);
    bricks = bricks + '🌮🍺';
    console.log(space + bricks + bricks);
    var div = document.querySelector('.pyramid-div');
    var pre = document.createElement('pre');
    div.appendChild(pre);
    pre.innerHTML = space + bricks + bricks;
  }
  // document.querySelector('.pyramid').addEventListener('click', pyramid);
}

function levelTitle(form) {
  var level = form.rankInput.value;
  console.log(form.rankInput.value);
  if (level > 19) {
    document.querySelector('.level-rank').innerHTML = '¡Eres Ben 10!';
    document.querySelector('.character-image').src = 'assets/images/ben10.jpg';
  } else if (level <= 19 && level > 10) {
    document.querySelector('.level-rank').innerHTML = '¡Eres Robin!';
    document.querySelector('.character-image').src = 'assets/images/robin.jpg';
  } else {
    document.querySelector('.level-rank').innerHTML = '¡Eres un novato!';
    document.querySelector('.character-image').src = 'assets/images/portfolio_03.jpeg';
  }
}

function fibonacci() {
  var size = parseInt(prompt('Entonces... ¿que tanto quieres escucharme cantar?'));
  var first = 0;
  var second = 1;
  var serie = [];
  for( var i = 0; i < size; i++) {
    serie.push(' ' + first);
    second = first + second;
    first = second - first;
  }
  document.querySelector('.fibo').innerHTML = serie;
}
