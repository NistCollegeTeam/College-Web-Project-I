const ckeditor = document.querySelectorAll(".ck.ck-content")[0];
const inp_desc = document.getElementById("create-help-description");
const render_inp_desc = document.querySelectorAll(".help-description");

ckeditor.addEventListener("keyup", function () {
  let text = ckeditor.innerHTML;
  inp_desc.value = text;
  render_inp_desc.forEach((element) => {
    element.innerHTML = `${text}`;
  });
});

const inp_title = document.getElementById("create-help-title");
const render_inp_title = document.querySelectorAll(".help-title");
inp_title.addEventListener("keyup", function () {
  render_inp_title.forEach((element) => {
    element.innerHTML = `<h3>${inp_title.value}<h3>`;
  });
});

const inp_loc = document.getElementById("create-help-location");
const render_inp_loc = document.querySelectorAll(".help-meta-location");
inp_loc.addEventListener("keyup", function () {
  render_inp_loc.forEach((element) => {
    element.innerHTML = `Address: ${inp_loc.value}`;
  });
});

const inp_contact = document.getElementById("create-help-contact");
const render_inp_contact = document.querySelectorAll(".help-meta-contact");
inp_contact.addEventListener("keyup", function (e) {
  render_inp_contact.forEach((element) => {
    element.innerHTML = `Contact: ${inp_contact.value}`;
  });
});

const inp_category = document.getElementById("create-help-category");
const render_inp_category = document.querySelectorAll(".help-meta-category");
inp_category.addEventListener("change", function (e) {
  render_inp_category.forEach((element) => {
    element.innerHTML = `Category: ${
      e.srcElement.options[e.srcElement.options.selectedIndex].text
    }`;
  });
});
