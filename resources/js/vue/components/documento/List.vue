<template>
    <div>
        <h1>Listado de documento</h1>

        <o-button variant="primary"><router-link :to="{name:'documentosave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="documentos.current_page && documentos.data.length == 0 ? [] : documentos.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>

            <o-table-column field="path" label="Path" v-slot="p">
                {{ p.row.path }}
            </o-table-column>

            <o-table-column field="requisito_id" label="Requisito" v-slot="p">
                {{ p.row.requisito_id }}
            </o-table-column>

            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'documentosave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deletedocumento(p)">Eliminar</o-button>
            </o-table-column>

        </o-table>

        <br>

        <o-pagination
        v-if="documentos.current_page && documentos.data.length > 0" 
        @change="updatePage"
            :total="documentos.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="documentos.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            documentos: [],
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
            this.$axios.get('/api/documento?page='+this.currentPage).then((res) => {
            this.documentos = res.data,
            this.isLoading = false
        });
        },

        deletedocumento(row){
            this.documentos.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/documento/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>