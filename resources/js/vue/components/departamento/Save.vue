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
                encargado: "",
            },
            errors: {
                nombre: "",
                encargado: "",
            },
            departamento:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getDepartamento();
            console.log(this.departamento)
            this.initDepartamento();
        }
        this.getEmpleados()
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
            this.errors.encargado = "";
        },
        getEmpleados() {
            this.$axios.get("/api/empleado/all").then(res => {
                this.empleados = res.data
            })
        },
        async getDepartamento() {
            this.departamento = await this.$axios.get("/api/departamento/"+this.$route.params.id);
            this.departamento = this.departamento.data
        },
        initDepartamento(){
            this.form.nombre = this.departamento.nombre
            this.form.domicilio = this.departamento.domicilio
            this.form.encargado = this.departamento.encargado
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.departamento == "") {
                return this.$axios
                .post("/api/departamento", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.encargado)
                        this.errors.encargado = error.response.data.encargado[0];

                })
                
            }
            this.$axios
                .patch("/api/departamento/"+this.departamento.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.encargado)
                        this.errors.encargado = error.response.data.encargado[0];
                })
            
        }
    }
}
</script>