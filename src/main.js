const questions = document.getElementsByClassName('question');

for (const question of questions) {
  question.addEventListener('click', function() {
    const answer = this.nextElementSibling;
    answer.classList.toggle('show');
  });
}

/* Menu Funcion */
function menuShow() {
  let menuMobile = document.querySelector('.mobile-menu');
  if (menuMobile.classList.contains('open')) {
      menuMobile.classList.remove('open');
      document.querySelector('.icon').src = "/src/img/menu.png";
  } else {
      menuMobile.classList.add('open');
      document.querySelector('.icon').src = "/src/img/close.png";
  }
}
