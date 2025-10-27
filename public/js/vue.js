console.log('hello')

const {createApp, ref, computed} = Vue;

createApp({
    setup(){

        const foto = ref({})

        function subirFoto(item){
            const campo = item.target.name || item.target.id;
            const file = item.target.files[0];
            if(file && campo){
                foto.value[campo] = URL.createObjectURL(file);
            }
        }

        function handleSubmit(event) {
            console.log('Vue: handleSubmit llamado');
            
            // Guardar contenido de Quill
            if (typeof window.guardarContenidoQuill === 'function') {
                console.log('Llamando a guardarContenidoQuill...');
                window.guardarContenidoQuill();
            } else {
                console.error('guardarContenidoQuill no está definida');
            }
            
            // Verificar que el valor se guardó
            const descripcionInput = document.getElementById('descripcion');
            console.log('Valor final del input:', descripcionInput.value);
            
            // Enviar el formulario usando el método nativo
            const form = event.target;
            
            // Usar setTimeout para asegurar que el valor se guardó
            setTimeout(() => {
                form.submit();
            }, 100);
        }

        return{
            foto,
            subirFoto,
            handleSubmit
        }
    }

}).mount("#app");