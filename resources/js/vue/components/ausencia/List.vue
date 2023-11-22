<template>
    <div>

        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 p-3" >
                <o-button variant="danger" @click="deleteausencia()">Eliminar</o-button>
                <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
            </div>

        </o-modal>

        <h1>Listado de ausencia</h1>

        <o-button iconLeft="plus" @click="$router.push({ name: 'ausenciasave' })">Crear</o-button>
        <div class="mb-5"></div>

        <o-table :loading="isLoading" :data="ausencias.current_page && ausencias.data.length == 0 ? [] : ausencias.data">

            <o-table-column field="fecha_de_inicio" label="fecha de inicio" v-slot="p">
                {{ p.row.fecha_de_inicio }}
            </o-table-column>

            <o-table-column field="fecha_de_termino" label="fecha de termino" v-slot="p">
                {{ p.row.fecha_de_termino }}
            </o-table-column>

            <o-table-column field="fecha_de_regreso" label="fecha de regreso" v-slot="p">
                {{ p.row.fecha_de_regreso }}
            </o-table-column>

            <o-table-column field="dias_disfrute" label="dias disfrute" v-slot="p">
                {{ p.row.dias_disfrute }}
            </o-table-column>

            <o-table-column field="solicitante" label="solicitante" v-slot="p">
                {{ p.row.solicitante }}
            </o-table-column> 

            <o-table-column field="quien_cubre" label="quien_cubre" v-slot="p">
                {{ p.row.quien_cubre }}
            </o-table-column>

            <o-table-column field="status_id" label="status_id" v-slot="p">
                {{ p.row.status_id }}
            </o-table-column>

            <o-table-column field="motivo_id" label="motivo_id" v-slot="p">
                {{ p.row.motivo_id }}
            </o-table-column>

            <o-table-column field="id" label="Acciones" v-slot="p">
                <router-link class="mr-5" :to="{name:'ausenciasave',params:{'id': p.row.id}}">Editar</router-link>
                <o-button iconLeft="delete" :rounded="true" size="small" variant="danger" @click="deleteAusenciaRow=p, confirmDeleteActive = true">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="ausencias.current_page && ausencias.data.length > 0" 
        @change="updatePage"
            :total="ausencias.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="ausencias.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            ausencias: [],
            isLoading: true,
            currentPage:1,
            confirmDeleteActive: false,
            deleteAusenciaRow: "",
        }
    },

    methods:{

        updatePage(){
            setTimeout(this.listPage,100);
        },

        listPage(){
            this.isLoading = true
            this.$axios.get('/api/ausencia?page='+this.currentPage).then((res) => {
            this.ausencias = res.data,
            this.isLoading = false
        });
        },

        deleteausencia(){
            this.confirmDeleteActive = false
            this.ausencias.data.splice(this.deleteAusenciaRow.index,1)
            this.$axios.delete("/api/ausencia/"+this.deleteAusenciaRow.row.id)
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