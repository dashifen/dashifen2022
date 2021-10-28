/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/scripts/dashifen-2022.js":
/*!*****************************************!*\
  !*** ./assets/scripts/dashifen-2022.js ***!
  \*****************************************/
/***/ (() => {

eval("document.addEventListener('DOMContentLoaded', () => {\n  const htmlClasses = document.getElementsByTagName('html')[0].classList;\n  htmlClasses.remove('no-js');\n  htmlClasses.add('js');\n\n  // our menu can use the :target pseudo class to open and close the menu as\n  // a pure CSS solution.  however, that may not be the most accessible way to\n  // handle it.  these statements grab the menu elements and controls the way\n  // it's displayed using the aria-expanded attribute which is better.\n\n  const menu = document.querySelector('#main-menu');\n\n  const toggler = (event) => {\n    event.preventDefault();\n    const opening = event.target.getAttribute('aria-label') === 'open main menu';\n    menu.setAttribute('aria-expanded', opening ? 'true' : 'false');\n  }\n\n  document.querySelector('.hamburger').addEventListener('click', toggler);\n  document.querySelector('#main-menu-close').addEventListener('click', toggler);\n});\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9hc3NldHMvc2NyaXB0cy9kYXNoaWZlbi0yMDIyLmpzLmpzIiwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZXMiOlsid2VicGFjazovL2Rhc2hpZmVuLTIwMjIvLi9hc3NldHMvc2NyaXB0cy9kYXNoaWZlbi0yMDIyLmpzPzMyY2MiXSwic291cmNlc0NvbnRlbnQiOlsiZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsICgpID0+IHtcbiAgY29uc3QgaHRtbENsYXNzZXMgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZSgnaHRtbCcpWzBdLmNsYXNzTGlzdDtcbiAgaHRtbENsYXNzZXMucmVtb3ZlKCduby1qcycpO1xuICBodG1sQ2xhc3Nlcy5hZGQoJ2pzJyk7XG5cbiAgLy8gb3VyIG1lbnUgY2FuIHVzZSB0aGUgOnRhcmdldCBwc2V1ZG8gY2xhc3MgdG8gb3BlbiBhbmQgY2xvc2UgdGhlIG1lbnUgYXNcbiAgLy8gYSBwdXJlIENTUyBzb2x1dGlvbi4gIGhvd2V2ZXIsIHRoYXQgbWF5IG5vdCBiZSB0aGUgbW9zdCBhY2Nlc3NpYmxlIHdheSB0b1xuICAvLyBoYW5kbGUgaXQuICB0aGVzZSBzdGF0ZW1lbnRzIGdyYWIgdGhlIG1lbnUgZWxlbWVudHMgYW5kIGNvbnRyb2xzIHRoZSB3YXlcbiAgLy8gaXQncyBkaXNwbGF5ZWQgdXNpbmcgdGhlIGFyaWEtZXhwYW5kZWQgYXR0cmlidXRlIHdoaWNoIGlzIGJldHRlci5cblxuICBjb25zdCBtZW51ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI21haW4tbWVudScpO1xuXG4gIGNvbnN0IHRvZ2dsZXIgPSAoZXZlbnQpID0+IHtcbiAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIGNvbnN0IG9wZW5pbmcgPSBldmVudC50YXJnZXQuZ2V0QXR0cmlidXRlKCdhcmlhLWxhYmVsJykgPT09ICdvcGVuIG1haW4gbWVudSc7XG4gICAgbWVudS5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBvcGVuaW5nID8gJ3RydWUnIDogJ2ZhbHNlJyk7XG4gIH1cblxuICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuaGFtYnVyZ2VyJykuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCB0b2dnbGVyKTtcbiAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI21haW4tbWVudS1jbG9zZScpLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgdG9nZ2xlcik7XG59KTtcbiJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./assets/scripts/dashifen-2022.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./assets/scripts/dashifen-2022.js"]();
/******/ 	
/******/ })()
;