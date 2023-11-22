<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deleteLinea()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>
        <h1>Listado de linea</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'lineasave' })">Crear</o-button>
        <div class="mb-5"></div>

        <o-table :loading="isLoading" :data="lineas.current_page && lineas.data.length == 0 ? [] : lineas.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="encargado" label="Encargado" v-slot="p">
                {{ p.row.encargado }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <router-link class="mr-5" :to="{name:'lineasave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deleteLineaRow=p, confirmDeleteActive = true">Eliminar</o-button>
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
            currentPage:1,
            confirmDeleteActive: false,
            deleteLineaRow: "",
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

        deleteLinea(){
            this.confirmDeleteActive = false
            this.lineas.data.splice(this.deleteLineaRow.index,1)
            this.$axios.delete("/api/linea/"+this.deleteLineaRow.row.id)
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