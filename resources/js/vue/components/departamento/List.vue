<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deleteDepartamento()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>
        <h1>Listado de departamento</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'departamentosave' })">Crear</o-button>
        <div class="mb-5"></div>

        <o-table :loading="isLoading" :data="departamentos.current_page && departamentos.data.length == 0 ? [] : departamentos.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="encargado" label="Encargado" v-slot="p">
                {{ p.row.encargado }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <router-link class="mr-5" :to="{name:'departamentosave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deleteDepartamentoRow=p, confirmDeleteActive = true">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="departamentos.current_page && departamentos.data.length > 0" 
        @change="updatePage"
            :total="departamentos.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="departamentos.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            departamentos: [],
            isLoading: true,
            currentPage:1,
            confirmDeleteActive: false,
            deleteDepartamentoRow: "",
        }
    },

    methods:{

        updatePage(){
            setTimeout(this.listPage,100);
        },

        listPage(){
            this.isLoading = true
            this.$axios.get('/api/departamento?page='+this.currentPage).then((res) => {
            this.departamentos = res.data,
            this.isLoading = false
        });
        },

        deleteDepartamento(){
            this.confirmDeleteActive = false
            this.departamentos.data.splice(this.deleteDepartamentoRow.index,1)
            this.$axios.delete("/api/departamento/"+this.deleteDepartamentoRow.row.id)
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