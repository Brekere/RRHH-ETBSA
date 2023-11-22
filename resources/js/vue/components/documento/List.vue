<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deleteDocumento()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>
        
        <h1>Listado de documento</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'documentosave' })">Crear</o-button>
        <div class="mb-5"></div>

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
                <router-link class="mr-5" :to="{name:'documentosave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deleteDocumentoRow=p, confirmDeleteActive = true">Eliminar</o-button>
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
            currentPage:1,
            confirmDeleteActive: false,
            deleteDocumentoRow: "",
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

        deleteDocumento(){
            this.confirmDeleteActive = false
            this.documentos.data.splice(this.deleteDocumentoRow.index,1)
            this.$axios.delete("/api/documento/"+this.deleteDocumentoRow.row.id)
            this.$oruga.notification.open({
                message: "Registro eliminado",
                position: "bottom-right",
                variant: "danger",
                duration: 4000,
                closable: true,
            });
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>