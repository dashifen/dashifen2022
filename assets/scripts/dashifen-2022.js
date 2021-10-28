document.addEventListener('DOMContentLoaded', () => {
  const htmlClasses = document.getElementsByTagName('html')[0].classList;
  htmlClasses.remove('no-js');
  htmlClasses.add('js');

  // our menu can use the :target pseudo class to open and close the menu as
  // a pure CSS solution.  however, that may not be the most accessible way to
  // handle it.  these statements grab the menu elements and controls the way
  // it's displayed using the aria-expanded attribute which is better.

  const menu = document.querySelector('#main-menu');

  const toggler = (event) => {
    event.preventDefault();
    const opening = event.target.getAttribute('aria-label') === 'open main menu';
    menu.setAttribute('aria-expanded', opening ? 'true' : 'false');
  }

  document.querySelector('.hamburger').addEventListener('click', toggler);
  document.querySelector('#main-menu-close').addEventListener('click', toggler);
});
