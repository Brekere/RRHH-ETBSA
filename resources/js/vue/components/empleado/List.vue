<template>
    <div>
        <h1>Listado de empleado</h1>

        <o-button variant="primary"><router-link :to="{name:'empleadosave'}">Crear</router-link></o-button>

        <o-table :loading="isLoading" :data="empleados.current_page && empleados.data.length == 0 ? [] : empleados.data">

            <o-table-column field="nombre" label="Nombre" v-slot="p">
                {{ p.row.nombre }}
            </o-table-column>

            <o-table-column field="apellido_paterno" label="Apellido paterno" v-slot="p">
                {{ p.row.apellido_paterno }}
            </o-table-column>

            <o-table-column field="apellido_materno" label="Apellido materno" v-slot="p">
                {{ p.row.apellido_materno }}
            </o-table-column>

            <o-table-column field="curp" label="CURP" v-slot="p">
                {{ p.row.curp }}
            </o-table-column>

            <o-table-column field="rfc" label="RFC" v-slot="p">
                {{ p.row.rfc }}
            </o-table-column>

            <o-table-column field="imss" label="IMSS" v-slot="p">
                {{ p.row.imss }}
            </o-table-column>

            <o-table-column field="domicilio" label="Domicilio" v-slot="p">
                {{ p.row.domicilio }}
            </o-table-column>

            <o-table-column field="telefono" label="Telefono" v-slot="p">
                {{ p.row.telefono }}
            </o-table-column>

            <o-table-column field="fecha_de_ingreso" label="Fecha de ingreso" v-slot="p">
                {{ p.row.fecha_de_ingreso }}
            </o-table-column>

            <o-table-column field="cuenta_de_nomina" label="Cuenta de nomina" v-slot="p">
                {{ p.row.cuenta_de_nomina }}
            </o-table-column>

            <o-table-column field="user_id" label="user_id" v-slot="p">
                {{ p.row.user_id }}
            </o-table-column>

            <o-table-column field="sucursal_id" label="sucursal_id" v-slot="p">
                {{ p.row.sucursal_id }}
            </o-table-column>

            <o-table-column field="departamento_id" label="departamento_id" v-slot="p">
                {{ p.row.departamento_id }}
            </o-table-column>

            <o-table-column field="cargo_id" label="cargo_id" v-slot="p">
                {{ p.row.cargo_id }}
            </o-table-column>

            <o-table-column field="expediente_id" label="expediente_id" v-slot="p">
                {{ p.row.expediente_id }}
            </o-table-column>

            <o-table-column field="periodo_id" label="periodo_id" v-slot="p">
                {{ p.row.periodo_id }}
            </o-table-column>

            <o-table-column field="jefe_directo" label="jefe_directo" v-slot="p">
                {{ p.row.jefe_directo }}
            </o-table-column>

            <o-table-column field="id" label="Acciones" v-slot="p">
                <o-button variant="succes"><router-link :to="{name:'empleadosave',params:{'id': p.row.id}}">Editar</router-link></o-button>
                <o-button variant="danger" @click="deleteempleado(p)">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="empleados.current_page && empleados.data.length > 0" 
        @change="updatePage"
            :total="empleados.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="empleados.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            empleados: [],
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
            this.$axios.get('/api/empleado?page='+this.currentPage).then((res) => {
            this.empleados = res.data,
            this.isLoading = false
        });
        },

        deleteempleado(row){
            this.empleados.data.splice(row.index,1)
            console.log(row)
            this.$axios.delete("/api/empleado/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>