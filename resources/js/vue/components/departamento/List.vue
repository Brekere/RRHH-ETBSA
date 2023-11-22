<template>
    <div>
        <h1>Listado de departamento</h1>

        <o-button variant="primary"><router-link :to="{name:'departamentosave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="departamentos.current_page && departamentos.data.length == 0 ? [] : departamentos.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="encargado" label="Encargado" v-slot="p">
                {{ p.row.encargado }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'departamentosave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deletedepartamento(p)">Eliminar</o-button>
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
            currentPage:1
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

        deletedepartamento(row){
            this.departamentos.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/departamento/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>