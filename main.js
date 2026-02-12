document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const courseCheckboxes = document.querySelectorAll(".course-checkbox");
  const errorMessage = document.getElementById("error-message");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); 

    let isValid = true;
    const firstName = document.getElementById("validationCustom01");
    const secondName = document.querySelectorAll("#validationCustom01")[1];
    const email = document.getElementById("exampleInputEmail1");
    const password = document.getElementById("inputPassword6");

    if (firstName.value.trim() === "") {
      firstName.classList.add("is-invalid");
      isValid = false;
    } else {
      firstName.classList.remove("is-invalid");
    }

    if (secondName.value.trim() === "") {
      secondName.classList.add("is-invalid");
      isValid = false;
    } else {
      secondName.classList.remove("is-invalid");
    }

    if (email.value.trim() === "") {
      email.classList.add("is-invalid");
      isValid = false;
    } else {
      email.classList.remove("is-invalid");
    }

    if (password.value.length < 8) {
      password.classList.add("is-invalid");
      isValid = false;
    } else {
      password.classList.remove("is-invalid");
    }
    let courseSelected = false;
    courseCheckboxes.forEach(box => {
      if (box.checked) courseSelected = true;
    });

    if (!courseSelected) {
      errorMessage.classList.remove("d-none");
      isValid = false;
    } else {
      errorMessage.classList.add("d-none");
    }

    if (isValid) {
      form.submit();
    }
  });
});