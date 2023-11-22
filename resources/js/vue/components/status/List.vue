<template>
    <div>
        <h1>Listado de status</h1>

        <o-button variant="primary"><router-link :to="{name:'statussave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="statuses.current_page && statuses.data.length == 0 ? [] : statuses.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'statussave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deletestatus(p)">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="statuses.current_page && statuses.data.length > 0" 
        @change="updatePage"
            :total="statuses.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="statuses.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            statuses: [],
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
            this.$axios.get('/api/status?page='+this.currentPage).then((res) => {
            this.statuses = res.data,
            this.isLoading = false
        });
        },

        deletestatus(row){
            this.statuses.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/status/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>