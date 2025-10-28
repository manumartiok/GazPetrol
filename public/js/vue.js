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
            
            if (typeof window.guardarContenidoQuill === 'function') {
                window.guardarContenidoQuill();
            } else {
                console.error('guardarContenidoQuill no está definida');
            }

            // Ahora sí enviamos el formulario
            event.target.submit();
        }

        return{
            foto,
            subirFoto,
            handleSubmit
        }
    }

}).mount("#app");