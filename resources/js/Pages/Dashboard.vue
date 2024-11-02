<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Prueba Netberry
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <v-container >
                        <h2>Gestor de tareas</h2>
                    </v-container>
                    <di>
                        <v-progress-linear
                        color="blue-lighten-1"
                        model-value="100"
                        rounded
                        ></v-progress-linear>
                    </di>
                    <v-container>
                        <v-form @submit.prevent="addTask">
                            <v-row >
                                <v-col col="12"md="3">
                                    <v-text-field label="Nueva Tarea" v-model.trim="task" required></v-text-field>
                                </v-col>
                                <v-col col="12" md="3">
                                    <v-combobox
                                    multiple
                                    label="Seleccionar categoria"
                                    v-model.trim="selectCategories"
                                    :items="categories"
                                    item-value="id"      
                                    item-title="name" 
                                    variant="outlined"
                                    ></v-combobox>
                                </v-col>
                                <v-col col="12" md="3">
                                    <v-btn type="submit" color="primary">Guardar</v-btn>
                                </v-col>
                                <v-col col="12" md="2">
                                    <v-btn color="info" @click="dialogAddCategory = true">Añadir Categoría</v-btn>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-container>
                    <v-container>
                        <v-table v-if="ListTasks.length > 0">
                            <thead>
                                <tr>
                                    <th class="text-left">
                                        Tarea
                                    </th>
                                    <th class="text-left">
                                        Categoria
                                    </th>
                                    <th class="text-left">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in ListTasks" :key="task.taskId">
                                   <td> {{ task.taskName }}</td>
                                   <td> {{ task.categories.join(', ') }}</td>
                                    <td>
                                        <v-btn color="warning" @click="dialog=true; callModal(task)">Eliminar</v-btn>
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                        <p v-else>No hay tareas.Por favor cree una</p>
                    </v-container>
                    <v-dialog v-model="dialog" width="auto">
                        <v-card
                            max-width="400"
                            prepend-icon="mdi-update"
                            text="¿Estás seguro de que deseas eliminar la tarea? "
                            title="Confirmar Eliminacion"
                        >
                            <template v-slot:actions>
                            <v-btn
                                class="ms-auto"
                                text="Cancelar"
                                @click="dialog = false"
                            ></v-btn>
                             <v-btn color="red" @click="deleteTask()">Eliminar</v-btn>
                            </template>
                        </v-card>
                    </v-dialog>

                    <v-dialog v-model="dialogAddCategory" width="auto">
                        <v-card max-width="400">
                            <v-card-title>Añadir Nueva Categoría</v-card-title>
                            <v-card-text>
                                <v-text-field
                                    label="Nombre de la categoría"
                                    v-model.trim="newCategoryName"
                                ></v-text-field>
                            </v-card-text>
                            <template v-slot:actions>
                                <v-btn text @click="dialogAddCategory = false">Cancelar</v-btn>
                                <v-btn color="primary" @click="addCategory">Añadir</v-btn>
                            </template>
                        </v-card>
                    </v-dialog>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { toast } from 'vue3-toastify';

export default {
    components: {
        AppLayout,
        Welcome
    },
    props: {
        categories: Array,
        tasks: Object
    },
    data() {
        return {
            task: '',
            selectCategories: [],
            ListTasks: [],
            dialog: false,
            selectTask:'',
            dialogAddCategory: false,
            newCategoryName: '',
        }
    },
    created() {
        this.ListTasks = Object.values(this.tasks).map(taskGroup => {
        return {
            taskId: taskGroup[0].taskId,
            taskName: taskGroup[0].taskName,
            categories: taskGroup.map(category => category.categoryName),
        };
    });
    console.log(this.ListTasks);
    },
    methods: {
        addTask() {
            if(!this.task || !this.selectCategories) {
                toast.error('Debe llenar todos los campos'); 
                return;
            }
            if(this.selectCategories.length == 0) {
                toast.error('Debe seleccionar al menos una categoria'); 
                return;
            }
            const data = {
                task: this.task,
                categories: this.selectCategories
            }
            axios.post(route('searchAll-create'), data)
                .then(response => {
                    const newTaskGroup = Object.values(response.data).map(taskGroup => {
                    return {
                        taskId: taskGroup[0].taskId,
                        taskName: taskGroup[0].taskName,
                        categories: taskGroup.map(category => category.categoryName),
                    };
                });
                    this.ListTasks.push(...newTaskGroup);
                    toast.success('Tarea creada correctamente');
                    this.task = '';
                    this.selectCategories = [];
                })
        },
        callModal(task) {
            this.dialog = true;
            this.selectTask = task;
        },
        deleteTask() {
            const data = {
                task: this.selectTask
            }
            axios.post(route('searchAll-delete', data))
                .then(response => {
                    const index = this.ListTasks.findIndex(task => task.taskId === this.selectTask.taskId);
                    if (index !== -1) {
                        this.ListTasks.splice(index, 1);
                    }
                    this.dialog = false;
                    toast.success('Tarea eliminada correctamente');
                })
        },
        callModalAddCategory() {
            this.dialogAddCategory = true;
        },
        addCategory() {
            if(!this.newCategoryName) {
                toast.error('Debe llenar el campo de categoria'); 
                return;
            }
            const data = {
                name: this.newCategoryName
            }
            axios.post(route('category-create', data))
                .then(response => {
                    this.categories.push(response.data);
                    this.dialogAddCategory = false;
                    this.newCategoryName = '';
                    toast.success('Categoría creada correctamente');
                })
        }
    }
}
</script>