<template>
    <div>
        <h1>Listado de cargo</h1>

        <o-button variant="primary"><router-link :to="{name:'cargosave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="cargos.current_page && cargos.data.length == 0 ? [] : cargos.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'cargosave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deletecargo(p)">Eliminar</o-button>
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
            currentPage:1
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

        deletecargo(row){
            this.cargos.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/cargo/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>