const store = {};
const loginButton = document.querySelector('#form-submit');
const form = document.forms[0];
// Insère le jwt dans l'objet store.


loginButton.addEventListener('submit', async (e) => {
  e.preventDefault();

  fetch('/index.php?p=userConnect', {
    method: 'POST',
    headers: {
      'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
    },
    body: JSON.stringify({
      username: form.inputEmail.value,
      password: form.inputPassword.value
    })
  })
});