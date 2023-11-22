<template>
    <div>
        <h1>Listado de linea</h1>

        <o-button variant="primary"><router-link :to="{name:'lineasave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="lineas.current_page && lineas.data.length == 0 ? [] : lineas.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="encargado" label="Encargado" v-slot="p">
                {{ p.row.encargado }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'lineasave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deletelinea(p)">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="lineas.current_page && lineas.data.length > 0" 
        @change="updatePage"
            :total="lineas.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="lineas.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            lineas: [],
            isLoading: true,
            currentPage:1
        }
    },

    methods:{

        updatePage(){
            setTimeout(this.listPage,100);
        },

        listPage(){
            this.isLoading = true
            this.$axios.get('/api/linea?page='+this.currentPage).then((res) => {
            this.lineas = res.data,
            this.isLoading = false
        });
        },

        deletelinea(row){
            this.lineas.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/linea/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>