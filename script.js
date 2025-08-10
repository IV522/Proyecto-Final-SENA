// Esperar que cargue el contenido del DOM
document.addEventListener("DOMContentLoaded", () => {
  // Asociar eventos de clic a los botones con ID

  // Ir a login.html
  const login = document.getElementById("loginOption");
  if (login) {
    login.addEventListener("click", () => {
      login.classList.add("active");
      setTimeout(() => window.location.href = "login.html", 200);
    });
  }

  // Ir a register.html
  const register = document.getElementById("Register");
  if (register) {
    register.addEventListener("click", () => {
      register.classList.add("active");
      setTimeout(() => window.location.href = "register.html", 200);
    });
  }

  // Ir a olvidar contraseña
  const forgot = document.getElementById("forgetOption");
  if (forgot) {
    forgot.addEventListener("click", () => {
      forgot.classList.add("active");
      setTimeout(() => window.location.href = "forget.html", 200);
    });
  }

  // Animación al hacer clic (rebote)
  const options = document.querySelectorAll(".option");
  options.forEach(option => {
    option.addEventListener("mousedown", () => {
      option.style.transform = "scale(0.97)";
    });
    option.addEventListener("mouseup", () => {
      option.style.transform = "scale(1)";
    });
  });
});
