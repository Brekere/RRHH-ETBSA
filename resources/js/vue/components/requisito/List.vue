<template>
    <div>
        <h1>Listado de requisito</h1>

        <o-button variant="primary"><router-link :to="{name:'requisitosave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="requisitos.current_page && requisitos.data.length == 0 ? [] : requisitos.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'requisitosave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deleterequisito(p)">Eliminar</o-button>
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
            currentPage:1
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

        deleterequisito(row){
            this.requisitos.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/requisito/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>