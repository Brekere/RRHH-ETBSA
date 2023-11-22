<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deleteCargo()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>

        <h1>Listado de cargo</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'cargosave' })">Crear</o-button>
        <div class="mb-5"></div>

        <o-table :loading="isLoading" :data="cargos.current_page && cargos.data.length == 0 ? [] : cargos.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <router-link class="mr-5" :to="{name:'cargosave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deleteCargoRow=p, confirmDeleteActive = true">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="cargos.current_page && cargos.data.length > 0" 
        @change="updatePage"
            :total="cargos.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="cargos.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            cargos: [],
            isLoading: true,
            currentPage:1,
            confirmDeleteActive: false,
            deleteCargoRow: "",
        }
    },

    methods:{

        updatePage(){
            setTimeout(this.listPage,100);
        },

        listPage(){
            this.isLoading = true
            this.$axios.get('/api/cargo?page='+this.currentPage).then((res) => {
            this.cargos = res.data,
            this.isLoading = false
        });
        },

        deleteCargo(){
            this.confirmDeleteActive = false
            this.cargos.data.splice(this.deleteCargoRow.index,1)
            this.$axios.delete("/api/cargo/"+this.deleteCargoRow.row.id)
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