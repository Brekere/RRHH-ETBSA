<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deleteExpediente()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>
        <h1>Listado de expediente</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'expedientesave' })">Crear</o-button>
        <div class="mb-5"></div>

        <o-table :loading="isLoading" :data="expedientes.current_page && expedientes.data.length == 0 ? [] : expedientes.data">

            <o-table-column field="path" label="Path" v-slot="p">
                {{ p.row.path }}
            </o-table-column>

            <o-table-column field="documento_id" label="Documento" v-slot="p">
                {{ p.row.documento_id }}
            </o-table-column>

            <o-table-column field="id" label="Acciones" v-slot="p">
                <router-link class="mr-5" :to="{name:'expedientesave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deleteExpedienteRow=p, confirmDeleteActive = true">Eliminar</o-button>
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
            currentPage:1,
            confirmDeleteActive: false,
            deleteExpedienteRow: "",
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

        deleteExpediente(){
            this.confirmDeleteActive = false
            this.expedientes.data.splice(this.deleteExpedienteRow.index,1)
            this.$axios.delete("/api/expediente/"+this.deleteExpedienteRow.row.id)
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