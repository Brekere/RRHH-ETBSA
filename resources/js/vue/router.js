import { createRouter, createWebHistory } from "vue-router"

import SucursalList from './components/sucursal/List.vue'
import SucursalSave from './components/sucursal/Save.vue'
import LineaList from './components/linea/List.vue'
import LineaSave from './components/linea/Save.vue'
import DepartamentoList from './components/departamento/List.vue'
import DepartamentoSave from './components/departamento/Save.vue'
import CargoList from './components/cargo/List.vue'
import CargoSave from './components/cargo/Save.vue'
import PeriodoList from './components/periodo/List.vue'
import PeriodoSave from './components/periodo/Save.vue'
import RequisitoList from './components/requisito/List.vue'
import RequisitoSave from './components/requisito/Save.vue'
import DocumentoList from './components/documento/List.vue'
import DocumentoSave from './components/documento/Save.vue'
import ExpedienteList from './components/expediente/List.vue'
import ExpedienteSave from './components/expediente/Save.vue'
import EmpleadoList from './components/empleado/List.vue'
import EmpleadoSave from './components/empleado/Save.vue'
import StatusList from './components/status/List.vue'
import StatusSave from './components/status/Save.vue'
import MotivoList from './components/motivo/List.vue'
import MotivoSave from './components/motivo/Save.vue'
import FeriadoList from './components/feriado/List.vue'
import FeriadoSave from './components/feriado/Save.vue'
import AusenciaList from './components/ausencia/List.vue'
import AusenciaSave from './components/ausencia/Save.vue'

const routes = [
    {
        name:'sucursallist',
        path:'/vue/sucursal',
        component: SucursalList
    },
    {
        name:'sucursalsave',
        path:'/vue/sucursal/save/:id?',
        component: SucursalSave
    },

    {
        name:'linealist',
        path:'/vue/linea',
        component: LineaList
    },
    {
        name:'lineasave',
        path:'/vue/linea/save/:id?',
        component: LineaSave
    },

    {
        name:'departamentolist',
        path:'/vue/departamento',
        component: DepartamentoList
    },
    {
        name:'departamentosave',
        path:'/vue/departamento/save/:id?',
        component: DepartamentoSave
    },

    {
        name:'cargolist',
        path:'/vue/cargo',
        component: CargoList
    },
    {
        name:'cargosave',
        path:'/vue/cargo/save/:id?',
        component: CargoSave
    },

    {
        name:'periodolist',
        path:'/vue/periodo',
        component: PeriodoList
    },
    {
        name:'periodosave',
        path:'/vue/periodo/save/:id?',
        component: PeriodoSave
    },

    {
        name:'requisitolist',
        path:'/vue/requisito',
        component: RequisitoList
    },
    {
        name:'requisitosave',
        path:'/vue/requisito/save/:id?',
        component: RequisitoSave
    },

    {
        name:'documentolist',
        path:'/vue/documento',
        component: DocumentoList
    },
    {
        name:'documentosave',
        path:'/vue/documento/save/:id?',
        component: DocumentoSave
    },

    {
        name:'expedientelist',
        path:'/vue/expediente',
        component: ExpedienteList
    },
    {
        name:'expedientesave',
        path:'/vue/expediente/save/:id?',
        component: ExpedienteSave
    },

    {
        name:'empleadolist',
        path:'/vue/empleado',
        component: EmpleadoList
    },
    {
        name:'empleadosave',
        path:'/vue/empleado/save/:id?',
        component: EmpleadoSave
    },

    {
        name:'statuslist',
        path:'/vue/status',
        component: StatusList
    },
    {
        name:'statussave',
        path:'/vue/status/save/:id?',
        component: StatusSave
    },

    {
        name:'motivolist',
        path:'/vue/motivo',
        component: MotivoList
    },
    {
        name:'motivosave',
        path:'/vue/motivo/save/:id?',
        component: MotivoSave
    },

    {
        name:'feriadolist',
        path:'/vue/feriado',
        component: FeriadoList
    },
    {
        name:'feriadosave',
        path:'/vue/feriado/save/:id?',
        component: FeriadoSave
    },

    {
        name:'ausencialist',
        path:'/vue/ausencia',
        component: AusenciaList
    },
    {
        name:'ausenciasave',
        path:'/vue/ausencia/save/:id?',
        component: AusenciaSave
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router