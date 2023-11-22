<template>
    <div>
        <h1>Listado de sucursal</h1>

        <o-button variant="primary"><router-link :to="{name:'sucursalsave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="sucursals.current_page && sucursals.data.length == 0 ? [] : sucursals.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>
            <o-table-column field="domicilio" label="Domicilio" v-slot="p">
                {{ p.row.domicilio }}
            </o-table-column>
            <o-table-column field="encargado" label="Encargado" v-slot="p">
                {{ p.row.encargado }}
            </o-table-column>
            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'sucursalsave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deleteSucursal(p)">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="sucursals.current_page && sucursals.data.length > 0" 
        @change="updatePage"
            :total="sucursals.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="sucursals.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            sucursals: [],
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
            this.$axios.get('/api/sucursal?page='+this.currentPage).then((res) => {
            this.sucursals = res.data,
            this.isLoading = false
        });
        },

        deleteSucursal(row){
            this.sucursals.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/sucursal/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>