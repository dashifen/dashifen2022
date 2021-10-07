document.addEventListener('DOMContentLoaded', () => {
  const htmlClasses = document.getElementsByTagName('html')[0].classList;
  htmlClasses.remove('no-js');
  htmlClasses.add('js');
});
