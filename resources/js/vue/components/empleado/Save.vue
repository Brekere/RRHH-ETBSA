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
            label="Apellido paterno"
            :variant="errors.apellido_paterno ? 'danger' : 'primary'"
            :message="errors.apellido_paterno"
        >
            <o-input v-model="form.apellido_paterno"></o-input>
        </o-field>

        <o-field
            label="Apellido materno"
            :variant="errors.apellido_materno ? 'danger' : 'primary'"
            :message="errors.apellido_materno"
        >
            <o-input v-model="form.apellido_materno"></o-input>
        </o-field>

        <o-field
            label="CURP"
            :variant="errors.curp ? 'danger' : 'primary'"
            :message="errors.curp"
        >
            <o-input v-model="form.curp"></o-input>
        </o-field>

        <o-field
            label="RFC"
            :variant="errors.rfc ? 'danger' : 'primary'"
            :message="errors.rfc"
        >
            <o-input v-model="form.rfc"></o-input>
        </o-field>

        <o-field
            label="IMSS"
            :variant="errors.imss ? 'danger' : 'primary'"
            :message="errors.imss"
        >
            <o-input v-model="form.imss"></o-input>
        </o-field>

        <o-field
            label="Domicilio"
            :variant="errors.domicilio ? 'danger' : 'primary'"
            :message="errors.domicilio"
        >
            <o-input v-model="form.domicilio"></o-input>
        </o-field>

        <o-field
            label="Telefono"
            :variant="errors.telefono ? 'danger' : 'primary'"
            :message="errors.telefono"
        >
            <o-input v-model="form.telefono"></o-input>
        </o-field>

        <o-field
            label="Fecha de ingreso"
            :variant="errors.fecha_de_ingreso ? 'danger' : 'primary'"
            :message="errors.fecha_de_ingreso"
        >
            <o-input v-model="form.fecha_de_ingreso"></o-input>
        </o-field>

        <o-field
            label="Cuenta de nomina"
            :variant="errors.cuenta_de_nomina ? 'danger' : 'primary'"
            :message="errors.cuenta_de_nomina"
        >
            <o-input v-model="form.cuenta_de_nomina"></o-input>
        </o-field>

        <o-field
        :variant="errors.user_id ? 'danger' : 'primary'"
        :message="errors.user_id"
        label="Usuario"
        >
        <o-select
            v-model="form.user_id"
            placeholder="Seleccione un usuario"
        >
            <option v-for="u in users" v-bind:key="u.id" :value="u.id">
            {{ u.name }}
            </option>
        </o-select>
        </o-field>

        <o-field
        :variant="errors.sucursal_id ? 'danger' : 'primary'"
        :message="errors.sucursal_id"
        label="Sucursal"
        >
        <o-select
            v-model="form.sucursal_id"
            placeholder="Seleccione una sucursal"
        >
            <option v-for="s in sucursals" v-bind:key="s.id" :value="s.id">
            {{ s.nombre }}
            </option>
        </o-select>
        </o-field>

        <o-field
        :variant="errors.linea_id ? 'danger' : 'primary'"
        :message="errors.linea_id"
        label="Lineas"
        >
        <o-select
            v-model="form.linea_id"
            placeholder="Seleccione una linea"
        >
            <option v-for="c in lineas" v-bind:key="c.id" :value="c.id">
            {{ c.nombre }}
            </option>
        </o-select>
        </o-field>

        <o-field
        :variant="errors.departamento_id ? 'danger' : 'primary'"
        :message="errors.departamento_id"
        label="Departamento"
        >
        <o-select
            v-model="form.departamento_id"
            placeholder="Seleccione un departamento"
        >
            <option v-for="c in departamentos" v-bind:key="c.id" :value="c.id">
            {{ c.nombre }}
            </option>
        </o-select>
        </o-field>

        <o-field
        :variant="errors.cargo_id ? 'danger' : 'primary'"
        :message="errors.cargo_id"
        label="Cargo"
        >
        <o-select
            v-model="form.cargo_id"
            placeholder="Seleccione un cargo"
        >
            <option v-for="c in cargos" v-bind:key="c.id" :value="c.id">
            {{ c.nombre }}
            </option>
        </o-select>
        </o-field>

        <o-field
        :variant="errors.expediente_id ? 'danger' : 'primary'"
        :message="errors.expediente_id"
        label="Expediente"
        >
        <o-select
            v-model="form.expediente_id"
            placeholder="Seleccione un expediente"
        >
            <option v-for="c in expedientes" v-bind:key="c.id" :value="c.id">
            {{ c.path }}
            </option>
        </o-select>
        </o-field>

        <o-field
        :variant="errors.periodo_id ? 'danger' : 'primary'"
        :message="errors.periodo_id"
        label="Años"
        >
        <o-select
            v-model="form.periodo_id"
            placeholder="Años de antigüedad"
        >
            <option v-for="c in periodos" v-bind:key="c.id" :value="c.id">
            {{ c.años }}
            </option>
        </o-select>
        </o-field>

        <o-field
        :variant="errors.jefe_directo ? 'danger' : 'primary'"
        :message="errors.jefe_directo"
        label="Jefe directo"
        >
        <o-select
            v-model="form.jefe_directo"
            placeholder="Seleccione un jefe directo"
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
            users: [],
            sucursals: [],
            lineas: [],
            departamentos: [],
            cargos: [],
            expedientes: [],
            periodos: [],
            empleados: [],
            form: {
                nombre: "",
                apellido_paterno: "",
                apellido_materno: "",
                curp: "",
                rfc: "",
                imss: "",
                domicilio: "",
                telefono: "",
                fecha_de_ingreso: "",
                cuenta_de_nomina: "",
                user_id: "",
                sucursal_id: "",
                linea_id: "",
                departamento_id: "",
                cargo_id: "",
                expediente_id: "",
                periodo_id: "",
                jefe_directo: "",
            },
            errors: {
                nombre: "",
                apellido_paterno: "",
                apellido_materno: "",
                curp: "",
                rfc: "",
                imss: "",
                domicilio: "",
                telefono: "",
                fecha_de_ingreso: "",
                cuenta_de_nomina: "",
                user_id: "",
                sucursal_id: "",
                linea_id: "",
                departamento_id: "",
                cargo_id: "",
                expediente_id: "",
                periodo_id: "",
                jefe_directo: "",
            },
            empleado:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getEmpleado();
            console.log(this.empleado)
            this.initEmpleado();
        }
        this.getUser()
        this.getSucursal()
        this.getLinea()
        this.getDepartamento()
        this.getCargo()
        this.getExpediente()
        this.getPeriodo()
        this.getJefeDirecto()
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
            this.errors.apellido_paterno = "";
            this.errors.apellido_materno = "";
            this.errors.curp = "";
            this.errors.rfc = "";
            this.errors.imss = "";
            this.errors.domicilio = "";
            this.errors.telefono = "";
            this.errors.fecha_de_ingreso = "";
            this.errors.cuenta_de_nomina = "";
            this.errors.user_id = "";
            this.errors.sucursal_id = "";
            this.errors.linea_id = "";
            this.errors.departamento_id = "";
            this.errors.cargo_id = "";
            this.errors.expediente_id = "";
            this.errors.periodo_id = "";
            this.errors.jefe_directo = "";
        },

        getUser() {
            this.$axios.get("/api/user/all").then(res => {
                this.users = res.data
            })
        },

        getSucursal() {
            this.$axios.get("/api/sucursal/all").then(res => {
                this.sucursals = res.data
            })
        },

        getLinea() {
            this.$axios.get("/api/linea/all").then(res => {
                this.lineas = res.data
            })
        },

        getDepartamento() {
            this.$axios.get("/api/departamento/all").then(res => {
                this.departamentos = res.data
            })
        },

        getCargo() {
            this.$axios.get("/api/cargo/all").then(res => {
                this.cargos = res.data
            })
        },

        getExpediente() {
            this.$axios.get("/api/expediente/all").then(res => {
                this.expedientes = res.data
            })
        },

        getPeriodo() {
            this.$axios.get("/api/periodo/all").then(res => {
                this.periodos = res.data
            })
        },

        getJefeDirecto() {
            this.$axios.get("/api/empleado/all").then(res => {
                this.empleados = res.data
            })
        },

        async getEmpleado() {
            this.empleado = await this.$axios.get("/api/empleado/"+this.$route.params.id);
            this.empleado = this.empleado.data
        },
        initEmpleado(){
            this.form.nombre = this.empleado.nombre
            this.form.apellido_paterno = this.empleado.apellido_paterno
            this.form.apellido_materno = this.empleado.apellido_materno
            this.form.curp = this.empleado.curp
            this.form.rfc = this.empleado.rfc
            this.form.imss = this.empleado.imss
            this.form.domicilio = this.empleado.domicilio
            this.form.telefono = this.empleado.telefono
            this.form.fecha_de_ingreso = this.empleado.fecha_de_ingreso
            this.form.cuenta_de_nomina = this.empleado.cuenta_de_nomina
            this.form.user_id = this.empleado.user_id
            this.form.sucursal_id = this.empleado.sucursal_id
            this.form.linea_id = this.empleado.linea_id
            this.form.departamento_id = this.empleado.departamento_id
            this.form.cargo_id = this.empleado.cargo_id
            this.form.expediente_id = this.empleado.expediente_id
            this.form.periodo_id = this.empleado.periodo_id
            this.form.jefe_directo = this.empleado.jefe_directo
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.empleado == "") {
                return this.$axios
                .post("/api/empleado", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.apellido_paterno)
                        this.errors.apellido_paterno = error.response.data.apellido_paterno[0];

                    if (error.response.data.apellido_materno)
                        this.errors.apellido_materno = error.response.data.apellido_materno[0];

                    if (error.response.data.curp)
                        this.errors.curp = error.response.data.curp[0];

                    if (error.response.data.rfc)
                        this.errors.rfc = error.response.data.rfc[0];

                    if (error.response.data.imss)
                        this.errors.imss = error.response.data.imss[0];

                    if (error.response.data.domicilio)
                        this.errors.domicilio = error.response.data.domicilio[0];

                    if (error.response.data.telefono)
                        this.errors.telefono = error.response.data.telefono[0];

                    if (error.response.data.fecha_de_ingreso)
                        this.errors.fecha_de_ingreso = error.response.data.fecha_de_ingreso[0];

                    if (error.response.data.cuenta_de_nomina)
                        this.errors.cuenta_de_nomina = error.response.data.cuenta_de_nomina[0];

                    if (error.response.data.user_id)
                        this.errors.user_id = error.response.data.user_id[0];

                    if (error.response.data.sucursal_id)
                        this.errors.sucursal_id = error.response.data.sucursal_id[0];

                    if (error.response.data.linea_id)
                        this.errors.linea_id = error.response.data.linea_id[0];

                    if (error.response.data.departamento_id)
                        this.errors.departamento_id = error.response.data.departamento_id[0];

                    if (error.response.data.cargo_id)
                        this.errors.cargo_id = error.response.data.cargo_id[0];

                    if (error.response.data.expediente_id)
                        this.errors.expediente_id = error.response.data.expediente_id[0];

                    if (error.response.data.periodo_id)
                        this.errors.periodo_id = error.response.data.periodo_id[0];

                    if (error.response.data.jefe_directo)
                        this.errors.jefe_directo = error.response.data.jefe_directo[0];

                })
                
            }
            this.$axios
                .patch("/api/empleado/"+this.empleado.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.apellido_paterno)
                        this.errors.apellido_paterno = error.response.data.apellido_paterno[0];

                    if (error.response.data.apellido_materno)
                        this.errors.apellido_materno = error.response.data.apellido_materno[0];

                    if (error.response.data.curp)
                        this.errors.curp = error.response.data.curp[0];

                    if (error.response.data.rfc)
                        this.errors.rfc = error.response.data.rfc[0];

                    if (error.response.data.imss)
                        this.errors.imss = error.response.data.imss[0];

                    if (error.response.data.domicilio)
                        this.errors.domicilio = error.response.data.domicilio[0];

                    if (error.response.data.telefono)
                        this.errors.telefono = error.response.data.telefono[0];

                    if (error.response.data.fecha_de_ingreso)
                        this.errors.fecha_de_ingreso = error.response.data.fecha_de_ingreso[0];

                    if (error.response.data.cuenta_de_nomina)
                        this.errors.cuenta_de_nomina = error.response.data.cuenta_de_nomina[0];

                    if (error.response.data.user_id)
                        this.errors.user_id = error.response.data.user_id[0];

                    if (error.response.data.sucursal_id)
                        this.errors.sucursal_id = error.response.data.sucursal_id[0];

                    if (error.response.data.linea_id)
                        this.errors.linea_id = error.response.data.linea_id[0];

                    if (error.response.data.departamento_id)
                        this.errors.departamento_id = error.response.data.departamento_id[0];

                    if (error.response.data.cargo_id)
                        this.errors.cargo_id = error.response.data.cargo_id[0];

                    if (error.response.data.expediente_id)
                        this.errors.expediente_id = error.response.data.expediente_id[0];

                    if (error.response.data.periodo_id)
                        this.errors.periodo_id = error.response.data.periodo_id[0];

                    if (error.response.data.jefe_directo)
                        this.errors.jefe_directo = error.response.data.jefe_directo[0];
                })
        }
    }
}
</script>