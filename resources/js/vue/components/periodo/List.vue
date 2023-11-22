<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deletePeriodo()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>

        <h1>Listado de periodo</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'periodosave' })">Crear</o-button>
        <div class="mb-5"></div>

        <o-table :loading="isLoading" :data="periodos.current_page && periodos.data.length == 0 ? [] : periodos.data">

            <o-table-column field="años" label="Años" v-slot="p">
                {{ p.row.años }}
            </o-table-column>

            <o-table-column field="dias_correspondientes" label="Dias correspondientes" v-slot="p">
                {{ p.row.dias_correspondientes }}
            </o-table-column>

            <o-table-column field="regimen" label="Regimen" v-slot="p">
                {{ p.row.regimen }}
            </o-table-column>

            <o-table-column field="id" label="Acciones" v-slot="p">
                <router-link class="mr-5" :to="{name:'periodosave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deletePeriodoRow=p, confirmDeleteActive = true">Eliminar</o-button>
            </o-table-column>

        </o-table>

        <br>

        <o-pagination
        v-if="periodos.current_page && periodos.data.length > 0" 
        @change="updatePage"
            :total="periodos.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="periodos.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            periodos: [],
            isLoading: true,
            currentPage:1,
            confirmDeleteActive: false,
            deletePeriodoRow: "",
        }
    },

    methods:{

        updatePage(){
            setTimeout(this.listPage,100);
        },

        listPage(){
            this.isLoading = true
            this.$axios.get('/api/periodo?page='+this.currentPage).then((res) => {
            this.periodos = res.data,
            this.isLoading = false
        });
        },

        deletePeriodo(){
            this.confirmDeleteActive = false
            this.periodos.data.splice(this.deletePeriodoRow.index,1)
            this.$axios.delete("/api/periodo/"+this.deletePeriodoRow.row.id)
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