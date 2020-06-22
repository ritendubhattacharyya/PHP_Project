const hamburger = document.querySelector(".hamburger");
const menu = document.querySelector(".menu");
const list = document.querySelectorAll(".menu li");
const line1 = document.querySelector(".line1");
const line2 = document.querySelector(".line2");
const line3 = document.querySelector(".line3");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("menuslide");
  line1.classList.toggle("line1Mod");
  line2.classList.toggle("line2Mod");
  line3.classList.toggle("line3Mod");

  list.forEach((item, index) => {
    if (item.style.animation) {
      item.style.animation = "";
    } else {
      item.style.animation = `item_slide 0.6s forwards ease ${index / 10}s`;
    }
  });
});
