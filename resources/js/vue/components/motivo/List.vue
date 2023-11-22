<template>
    <div>
        <h1>Listado de motivo</h1>

        <o-button variant="primary"><router-link :to="{name:'motivosave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="motivos.current_page && motivos.data.length == 0 ? [] : motivos.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'motivosave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deletemotivo(p)">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="motivos.current_page && motivos.data.length > 0" 
        @change="updatePage"
            :total="motivos.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="motivos.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            motivos: [],
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
            this.$axios.get('/api/motivo?page='+this.currentPage).then((res) => {
            this.motivos = res.data,
            this.isLoading = false
        });
        },

        deletemotivo(row){
            this.motivos.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/motivo/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>