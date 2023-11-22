<template>
    <form @submit.prevent="submit">
        
        <o-field
            label="Nombre"
            :variant="errors.nombre ? 'danger' : 'primary'"
            :message="errors.nombre"
        >
            <o-input v-model="form.nombre"></o-input>
        </o-field>

        <o-field
        :variant="errors.domicilio ? 'danger' : 'primary'"
        :message="errors.domicilio"
        label="Domicilio"
        >
        <o-input v-model="form.domicilio" type="textarea"></o-input>
        </o-field>

        <o-field
        :variant="errors.encargado ? 'danger' : 'primary'"
        :message="errors.encargado"
        label="Encargado"
        >
        <o-select
            v-model="form.encargado"
            placeholder="Seleccione un encargado"
        >
            <option v-for="c in empleados" v-bind:key="c.id" :value="c.id">
            {{ c.nombre }}
            </option>
        </o-select>
        </o-field>

        <o-button variant="primary" native-type="submit">
            Enviar
        </o-button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            empleados: [],
            form: {
                nombre: "",
                domicilio: "",
                encargado: "",
            },
            errors: {
                nombre: "",
                domicilio: "",
                encargado: "",
            },
            sucursal:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getSucursal();
            console.log(this.sucursal)
            this.initSucursal();
        }
        this.getEmpleados()
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
            this.errors.domicilio = "";
            this.errors.encargado = "";
        },
        getEmpleados() {
            this.$axios.get("/api/empleado/all").then(res => {
                this.empleados = res.data
            })
        },
        async getSucursal() {
            this.sucursal = await this.$axios.get("/api/sucursal/"+this.$route.params.id);
            this.sucursal = this.sucursal.data
        },
        initSucursal(){
            this.form.nombre = this.sucursal.nombre
            this.form.domicilio = this.sucursal.domicilio
            this.form.encargado = this.sucursal.encargado
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.sucursal == "") {
                return this.$axios
                .post("/api/sucursal", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.domicilio)
                        this.errors.domicilio = error.response.data.domicilio[0];

                    if (error.response.data.encargado)
                        this.errors.encargado = error.response.data.encargado[0];

                })
                
            }
            this.$axios
                .patch("/api/sucursal/"+this.sucursal.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.domicilio)
                        this.errors.domicilio = error.response.data.domicilio[0];

                    if (error.response.data.encargado)
                        this.errors.encargado = error.response.data.encargado[0];
                })
            
        }
    }
}
</script>