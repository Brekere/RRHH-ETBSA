<template>
    <div>
        <h1>Listado de periodo</h1>

        <o-button variant="primary"><router-link :to="{name:'periodosave'}">Crear</router-link></o-button>

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
                <o-button variant="succes"><router-link :to="{name:'periodosave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deleteperiodo(p)">Eliminar</o-button>
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
            currentPage:1
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

        deleteperiodo(row){
            this.periodos.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/periodo/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>