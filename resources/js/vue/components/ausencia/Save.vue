<template>
    <form @submit.prevent="submit">

        <o-field
            label="fecha de inicio"
            :variant="errors.fecha_de_inicio ? 'danger' : 'primary'"
            :message="errors.fecha_de_inicio"
        >
            <o-input v-model="form.fecha_de_inicio"></o-input>
        </o-field>

        <o-field
            label="fecha de termino"
            :variant="errors.fecha_de_termino ? 'danger' : 'primary'"
            :message="errors.fecha_de_termino"
        >
            <o-input v-model="form.fecha_de_termino"></o-input>
        </o-field>

        <o-field
            label="fecha de regreso"
            :variant="errors.fecha_de_regreso ? 'danger' : 'primary'"
            :message="errors.fecha_de_regreso"
        >
            <o-input v-model="form.fecha_de_regreso"></o-input>
        </o-field>

        <o-field
            label="dias disfrute"
            :variant="errors.dias_disfrute ? 'danger' : 'primary'"
            :message="errors.dias_disfrute"
        >
            <o-input v-model="form.dias_disfrute"></o-input>
        </o-field>

        <o-field
            label="solicitante"
            :variant="errors.solicitante ? 'danger' : 'primary'"
            :message="errors.solicitante"
        >
            <o-input v-model="form.solicitante"></o-input>
        </o-field>

        <o-field
            label="quien_cubre"
            :variant="errors.quien_cubre ? 'danger' : 'primary'"
            :message="errors.quien_cubre"
        >
            <o-input v-model="form.quien_cubre"></o-input>
        </o-field>

        <o-field
            label="status_id"
            :variant="errors.status_id ? 'danger' : 'primary'"
            :message="errors.status_id"
        >
            <o-input v-model="form.status_id"></o-input>
        </o-field>

        <o-field
            label="motivo_id"
            :variant="errors.motivo_id ? 'danger' : 'primary'"
            :message="errors.motivo_id"
        >
            <o-input v-model="form.motivo_id"></o-input>
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
            form: {
                fecha_de_inicio: "",
                fecha_de_termino: "",
                fecha_de_regreso: "",
                dias_disfrute: "",
                solicitante: "",
                quien_cubre: "",
                status_id: "",
                motivo_id: "",
            },
            errors: {
                fecha_de_inicio: "",
                fecha_de_termino: "",
                fecha_de_regreso: "",
                dias_disfrute: "",
                solicitante: "",
                quien_cubre: "",
                status_id: "",
                motivo_id: "",
            },
            ausencia:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getAusencia();
            console.log(this.ausencia)
            this.initAusencia();
        }
        this.getEmpleado();
        this.getStatus();
        this.getMotivo();
    },
    methods: {
        cleanErrorsForm() {
            this.errors.fecha_de_inicio = "";
            this.errors.fecha_de_termino = "";
            this.errors.fecha_de_regreso = "";
            this.errors.dias_disfrute = "";
            this.errors.solicitante = "";
            this.errors.quien_cubre = "";
            this.errors.status_id = "";
            this.errors.motivo_id = "";
        },

        async getAusencia() {
            this.ausencia = await this.$axios.get("/api/ausencia/"+this.$route.params.id);
            this.ausencia = this.ausencia.data
        },

        getEmpleado() {
            this.$axios.get("/api/empleado/all").then(res => {
                this.empleados = res.data
            })
        },

        getStatus() {
            this.$axios.get("/api/status/all").then(res => {
                this.statuses = res.data
            })
        },

        getMotivo() {
            this.$axios.get("/api/motivo/all").then(res => {
                this.motivos = res.data
            })
        },

        initAusencia(){
            this.form.fecha_de_inicio = this.ausencia.fecha_de_inicio
            this.form.fecha_de_termino = this.ausencia.fecha_de_termino
            this.form.fecha_de_regreso = this.ausencia.fecha_de_regreso
            this.form.dias_disfrute = this.ausencia.dias_disfrute
            this.form.solicitante = this.ausencia.solicitante
            this.form.quien_cubre = this.ausencia.quien_cubre
            this.form.status_id = this.ausencia.status_id
            this.form.motivo_id = this.ausencia.motivo_id
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.ausencia == "") {
                return this.$axios
                .post("/api/ausencia", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.fecha_de_inicio)
                        this.errors.fecha_de_inicio = error.response.data.fecha_de_inicio[0];
                    if (error.response.data.fecha_de_termino)
                        this.errors.fecha_de_termino = error.response.data.fecha_de_termino[0];
                    if (error.response.data.fecha_de_regreso)
                        this.errors.fecha_de_regreso = error.response.data.fecha_de_regreso[0];
                    if (error.response.data.dias_disfrute)
                        this.errors.dias_disfrute = error.response.data.dias_disfrute[0];
                    if (error.response.data.solicitante)
                        this.errors.solicitante = error.response.data.solicitante[0];
                    if (error.response.data.status_id)
                        this.errors.status_id = error.response.data.status_id[0];
                    if (error.response.data.quien_cubre)
                        this.errors.quien_cubre = error.response.data.quien_cubre[0];
                    if (error.response.data.motivo_id)
                        this.errors.motivo_id = error.response.data.motivo_id[0];

                })
                
            }
            this.$axios
                .patch("/api/ausencia/"+this.ausencia.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.fecha_de_inicio)
                        this.errors.fecha_de_inicio = error.response.data.fecha_de_inicio[0];
                    if (error.response.data.fecha_de_termino)
                        this.errors.fecha_de_termino = error.response.data.fecha_de_termino[0];
                    if (error.response.data.fecha_de_regreso)
                        this.errors.fecha_de_regreso = error.response.data.fecha_de_regreso[0];
                    if (error.response.data.dias_disfrute)
                        this.errors.dias_disfrute = error.response.data.dias_disfrute[0];
                    if (error.response.data.solicitante)
                        this.errors.solicitante = error.response.data.solicitante[0];
                    if (error.response.data.status_id)
                        this.errors.status_id = error.response.data.status_id[0];
                    if (error.response.data.quien_cubre)
                        this.errors.quien_cubre = error.response.data.quien_cubre[0];
                    if (error.response.data.motivo_id)
                        this.errors.motivo_id = error.response.data.motivo_id[0];

                })
            
        }
    }
}
</script>