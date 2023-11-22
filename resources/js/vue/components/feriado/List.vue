<template>
    <div>
        <h1>Listado de feriado</h1>

        <o-button variant="primary"><router-link :to="{name:'feriadosave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="feriados.current_page && feriados.data.length == 0 ? [] : feriados.data">

            <o-table-column field="fecha" label="Fecha" v-slot="p">
                {{ p.row.fecha }}
            </o-table-column>

            <o-table-column field="descripcion" label="Descripcion" v-slot="p">
                {{ p.row.descripcion }}
            </o-table-column>

            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'feriadosave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deleteferiado(p)">Eliminar</o-button>
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
            currentPage:1
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

        deleteferiado(row){
            this.feriados.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/feriado/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>