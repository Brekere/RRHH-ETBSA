<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deleteRequisito()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>
        <h1>Listado de requisito</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'requisitosave' })">Crear</o-button>
        <div class="mb-5"></div>

        <o-table :loading="isLoading" :data="requisitos.current_page && requisitos.data.length == 0 ? [] : requisitos.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <router-link class="mr-5" :to="{name:'requisitosave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deleteRequisitoRow=p, confirmDeleteActive = true">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="requisitos.current_page && requisitos.data.length > 0" 
        @change="updatePage"
            :total="requisitos.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="requisitos.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            requisitos: [],
            isLoading: true,
            currentPage:1,
            confirmDeleteActive: false,
            deleteRequisitoRow: "",
        }
    },

    methods:{

        updatePage(){
            setTimeout(this.listPage,100);
        },

        listPage(){
            this.isLoading = true
            this.$axios.get('/api/requisito?page='+this.currentPage).then((res) => {
            this.requisitos = res.data,
            this.isLoading = false
        });
        },

        deleteRequisito(){
            this.confirmDeleteActive = false
            this.requisitos.data.splice(this.deleteRequisitoRow.index,1)
            this.$axios.delete("/api/requisito/"+this.deleteRequisitoRow.row.id)
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