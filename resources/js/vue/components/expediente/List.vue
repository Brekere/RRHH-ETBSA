<template>
    <div>
        <h1>Listado de expediente</h1>

        <o-button variant="primary"><router-link :to="{name:'expedientesave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="expedientes.current_page && expedientes.data.length == 0 ? [] : expedientes.data">

            <o-table-column field="path" label="Path" v-slot="p">
                {{ p.row.path }}
            </o-table-column>

            <o-table-column field="documento_id" label="Documento" v-slot="p">
                {{ p.row.documento_id }}
            </o-table-column>

            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'expedientesave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deleteexpediente(p)">Eliminar</o-button>
            </o-table-column>

        </o-table>

        <br>

        <o-pagination
        v-if="expedientes.current_page && expedientes.data.length > 0" 
        @change="updatePage"
            :total="expedientes.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="expedientes.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            expedientes: [],
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
            this.$axios.get('/api/expediente?page='+this.currentPage).then((res) => {
            this.expedientes = res.data,
            this.isLoading = false
        });
        },

        deleteexpediente(row){
            this.expedientes.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/expediente/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>