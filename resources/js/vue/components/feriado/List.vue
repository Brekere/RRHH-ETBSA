<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deleteFeriado()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>
        <h1>Listado de feriado</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'feriadosave' })">Crear</o-button>
        <div class="mb-5"></div>

        <o-table :loading="isLoading" :data="feriados.current_page && feriados.data.length == 0 ? [] : feriados.data">

            <o-table-column field="fecha" label="Fecha" v-slot="p">
                {{ p.row.fecha }}
            </o-table-column>

            <o-table-column field="descripcion" label="Descripcion" v-slot="p">
                {{ p.row.descripcion }}
            </o-table-column>

            <o-table-column field="id" label="Acciones" v-slot="p">
                <router-link class="mr-5" :to="{name:'feriadosave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deleteFeriadoRow=p, confirmDeleteActive = true">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="feriados.current_page && feriados.data.length > 0" 
        @change="updatePage"
            :total="feriados.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="feriados.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            feriados: [],
            isLoading: true,
            currentPage:1,
            confirmDeleteActive: false,
            deleteFeriadoRow: "",
        }
    },

    methods:{

        updatePage(){
            setTimeout(this.listPage,100);
        },

        listPage(){
            this.isLoading = true
            this.$axios.get('/api/feriado?page='+this.currentPage).then((res) => {
            this.feriados = res.data,
            this.isLoading = false
        });
        },

        deleteFeriado(){
            this.confirmDeleteActive = false
            this.feriados.data.splice(this.deleteFeriadoRow.index,1)
            this.$axios.delete("/api/feriado/"+this.deleteFeriadoRow.row.id)
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