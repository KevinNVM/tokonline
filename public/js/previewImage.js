function previewImage(target = "img", input = 'input[accept="image/*"]') {
    const imgInput = document.querySelector(input);
    const img = document.querySelector(target);

    imgInput.onchange = (e) => {
        const [file] = imgInput.files;
        if (file) {
            img.src = URL.createObjectURL(file);
        }
    };
}
