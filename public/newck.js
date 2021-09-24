ClassicEditor.create(document.querySelector("#ckeditor"), {
  toolbar: {
    items: [
      "bold",
      "link",
      "bulletedList",
      "numberedList",
      "|",
      "outdent",
      "indent",
      "|",
      "insertTable",
      "undo",
      "redo",
      "underline",
    ],
  },
  language: "en",
  licenseKey: "",
})
  .then((editor) => {
    window.editor = editor;
  })
  .catch((error) => {
    console.error("Oops, something went wrong!");
    console.error(
      "Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:"
    );
    console.warn("Build id: xf8pgcvcxwmn-y6pzmrryqhyi");
    console.error(error);
  });
