<template>
    <form @submit.prevent="submit">
        
        <o-field
            label="Años"
            :variant="errors.años ? 'danger' : 'primary'"
            :message="errors.años"
        >
            <o-input v-model="form.años"></o-input>
        </o-field>

        <o-field
            label="Dias correspondientes"
            :variant="errors.dias_correspondientes ? 'danger' : 'primary'"
            :message="errors.dias_correspondientes"
        >
            <o-input v-model="form.dias_correspondientes"></o-input>
        </o-field>

        <o-field
        :variant="errors.regimen ? 'danger' : 'primary'"
        :message="errors.regimen"
        label="Regimen"
        >
        <o-select
            v-model="form.regimen"
            placeholder="Seleccione un regimen"
        >
            <option value="2023" id="2023">2023</option>
            <option value="2022" id="2022">2022</option>
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
            periodo: [],
            form: {
                años: "",
                dias_correspondientes: "",
                regimen: "",
            },
            errors: {
                años: "",
                dias_correspondientes: "",
                regimen: "",
            },
            periodo:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getPeriodo();
            console.log(this.periodo)
            this.initPeriodo();
        }
    },
    methods: {
        cleanErrorsForm() {
            this.errors.años = "";
            this.errors.dias_correspondientes = "";
            this.errors.regimen = "";
        },

        async getPeriodo() {
            this.periodo = await this.$axios.get("/api/periodo/"+this.$route.params.id);
            this.periodo = this.periodo.data
        },
        initPeriodo(){
            this.form.años = this.periodo.años;
            this.form.dias_correspondientes = this.periodo.dias_correspondientes;
            this.form.regimen = this.periodo.regimen;
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.periodo == "") {
                return this.$axios
                .post("/api/periodo", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.años)
                        this.errors.años = error.response.data.años[0];

                    if (error.response.data.dias_correspondientes)
                        this.errors.dias_correspondientes = error.response.data.dias_correspondientes[0];

                    if (error.response.data.regimen)
                        this.errors.regimen = error.response.data.regimen[0];

                })
                
            }
            this.$axios
                .patch("/api/periodo/"+this.periodo.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.años)
                        this.errors.años = error.response.data.años[0];

                    if (error.response.data.dias_correspondientes)
                        this.errors.dias_correspondientes = error.response.data.dias_correspondientes[0];

                    if (error.response.data.regimen)
                        this.errors.regimen = error.response.data.regimen[0];

                })
            
        }
    }
}
</script>