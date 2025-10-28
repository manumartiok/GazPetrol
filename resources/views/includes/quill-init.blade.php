<script>
setTimeout(function() {
    if (typeof Quill === 'undefined') {
        console.error('ERROR: Quill no está cargado');
        return;
    }

    const toolbarConfig = [
        ['bold', 'italic', 'underline'],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'align': [] }],
        ['clean']
    ];

    const editores = [];

    document.querySelectorAll('.quill-editor').forEach(function(container) {
        const fieldName = container.dataset.field;
        const quill = new Quill(container, {
            theme: 'snow',
            modules: { toolbar: toolbarConfig },
            placeholder: 'Escribe aquí...'
        });

        editores.push({ quill, fieldName });
        console.log('✓ Editor', fieldName, 'inicializado');
    });

    window.guardarContenidoQuill = function() {
        let contador = 0;
        editores.forEach(function(editor) {
            let contenido = editor.quill.root.innerHTML;
            if (contenido === '<p><br></p>' || contenido.trim() === '') contenido = ' ';
            const input = document.querySelector('input[name="' + editor.fieldName + '"]');
            if (input) {
                input.value = contenido;
                contador++;
            }
        });
        console.log('✓ Total editores guardados:', contador);
        return true;
    };
}, 1000);
</script>