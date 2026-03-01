<script setup lang="ts">
import { onMounted, computed, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useTasks } from '@/composables/useTasks'
import { useTaskStore } from '@/stores/task.store'
import KanbanColumn from '@/components/KanbanColumn.vue'
import TaskModal from '@/components/TaskModal.vue'

const route = useRoute()
const { fetchTasks, updateStatus, createTask, deleteTask } = useTasks()
const store = useTaskStore()

const showModal = ref(false)
const creating = ref(false)
const loading = ref(false)
const statusFilter = ref('all')
const priorityFilter = ref('all')


onMounted(async () => {
  loading.value = true
  await fetchTasks(Number(route.params.id))
  loading.value = false
})

const tasks = computed(() => store.tasks?.data ?? [])

const filteredTasks = computed(() => {
  return tasks.value.filter(task => {
    const statusMatch =
      statusFilter.value === 'all' ||
      task.status === statusFilter.value

    const priorityMatch =
      priorityFilter.value === 'all' ||
      task.priority === priorityFilter.value

    return statusMatch && priorityMatch
  })
})

const todo = computed(() =>
  filteredTasks.value.filter(t => t.status === 'todo')
)

const inProgress = computed(() =>
  filteredTasks.value.filter(t => t.status === 'in_progress')
)

const done = computed(() =>
  filteredTasks.value.filter(t => t.status === 'done')
)

function handleMove(task: any, newStatus: string) {
  task.status = newStatus
  updateStatus(task, newStatus)
}

async function handleCreate(data: any) {
  creating.value = true

  await createTask(
    Number(route.params.id), {
    ...data,
    status: 'todo',
  })

  creating.value = false
  showModal.value = false

  fetchTasks(Number(route.params.id))
}

async function handleDelete(task: any) {
  if (!confirm('Tem certeza que deseja excluir essa tarefa?')) return

  await deleteTask(task.id)
  await fetchTasks(Number(route.params.id))
}
</script>

<template>
  <div class="min-h-screen">
    <div class="relative max-w-7xl mx-auto px-8 py-14">
      <div class="flex flex-col gap-6 mb-12 md:flex-row md:items-center md:justify-between">
        <div>
          <h1 class="text-3xl font-semibold tracking-tight text-gray-300">
            Board
          </h1>
          <p class="text-sm text-neutral-500 mt-2">
            Arraste as tarefas entre as colunas
          </p>
        </div>
        <div>
          <button
            @click="$router.push('/')"
            class="px-4 py-2 ml-4 text-sm rounded-md bg-gray-600 text-white hover:bg-gray-700 transition"
          >
            Voltar
          </button>

          <button
            @click="showModal = true"
            class="ml-2 px-4 py-2 text-sm rounded-md bg-blue-600 text-white hover:bg-blue-700 transition"
          >
            Adicionar Tarefa
          </button>
        </div>
      </div>

      <div class="flex flex-wrap gap-4 mb-8">
        <select
          v-model="statusFilter"
          class="px-3 py-2 text-sm rounded-md bg-neutral-700 text-white border border-neutral-700"
        >
          <option value="all">Todos Status</option>
          <option value="todo">To Do</option>
          <option value="in_progress">In Progress</option>
          <option value="done">Done</option>
        </select>
        <select
          v-model="priorityFilter"
          class="px-3 py-2 text-sm rounded-md bg-neutral-700 text-white border border-neutral-700"
        >
          <option value="all">Todas Prioridades</option>
          <option value="low">Baixa</option>
          <option value="medium">Média</option>
          <option value="high">Alta</option>
        </select>
      </div>

      <div
        v-if="loading"
        class="absolute inset-0 mt-60 z-20 flex items-center justify-center rounded-xl"
      >
        <div class="flex items-center gap-3">
          <div class="h-8 w-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
          <span class="text-sm font-medium text-gray-300">
            Carregando...
          </span>
        </div>
      </div>
      
      <div 
        v-else 
        class="grid grid-cols-1 md:grid-cols-3 gap-8"
      >
        <KanbanColumn
          title="To Do"
          status="todo"
          :tasks="todo"
          @moved="handleMove"
          @delete="handleDelete"
        />
        <KanbanColumn
          title="In Progress"
          status="in_progress"
          :tasks="inProgress"
          @moved="handleMove"
          @delete="handleDelete"
        />
        <KanbanColumn
          title="Done"
          status="done"
          :tasks="done"
          @moved="handleMove"
          @delete="handleDelete"
        />
      </div>
    </div>
    <TaskModal
      v-if="showModal"
      :loading="creating"
      @close="showModal = false"
      @create="handleCreate"
    />
  </div>
</template>