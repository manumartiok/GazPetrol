console.log('hello')

const {createApp,ref,computed} = Vue;

createApp({
    setup(){

        const foto=ref({})

        function subirFoto(item){
            const campo= item.target.name || item.target.id;
            const file= item.target.files[0];
            if(file&&campo){
                foto.value[campo]=URL.createObjectURL(file);
            }
        };

        return{
            foto,
            subirFoto
        }
    }

}).mount("#app");