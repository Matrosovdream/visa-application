document.addEventListener("DOMContentLoaded", function () {
  function toggleMenu(
    buttonId,
    menuId,
    classOpen,
    classClosed,
    iconOpen = null,
    iconClose = null
  ) {
    const button = document.getElementById(buttonId);
    const menu = document.getElementById(menuId);

    if (!button || !menu) return;

    button.addEventListener("click", function () {
      const isOpen = menu.classList.contains(classOpen);
      menu.classList.toggle(classOpen, !isOpen);
      menu.classList.toggle(classClosed, isOpen);

      if (iconOpen && iconClose) {
        document.getElementById(iconOpen)?.classList.toggle("hidden", !isOpen);
        document.getElementById(iconClose)?.classList.toggle("hidden", isOpen);
      }
    });
  }

  // бургер меню
  toggleMenu(
    "menu-button",
    "mobile-menu",
    "left-0",
    "left-[-100%]",
    "burger-icon",
    "close-icon"
  );

  // юзер меню
  toggleMenu("right-button", "mobile-rightmenu", "right-0", "right-[-100%]");
});
