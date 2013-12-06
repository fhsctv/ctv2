tinymce.init({
    selector: "div.titel, div.column-title, div.column-text",
    theme: "modern",
    plugins: [
        ["advlist autolink image lists charmap preview hr pagebreak"],
        ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking"],
        ["save table contextmenu directionality emoticons paste contextmenu"],
    ],
    add_unload_trigger: false,
    schema: "html5",
    inline: true,
    toolbar: "undo redo | fontsizeselect styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview",
    statusbar: false,
    paste_data_images: true,
    language: "de",
});
