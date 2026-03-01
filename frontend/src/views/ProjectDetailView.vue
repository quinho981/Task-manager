<script setup lang="ts">
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useTasks } from '@/composables/useTasks'
import { useTaskStore } from '@/stores/task.store'
import TaskCard from '@/components/TaskCard.vue'

const route = useRoute()
const { fetchTasks, updateStatus } = useTasks()
const store = useTaskStore()

onMounted(() => {
  fetchTasks(Number(route.params.id))
})
</script>

<template>
  <div class="p-6 space-y-4">
    <h1 class="text-2xl font-bold">Tarefas</h1>

    <button @click="$router.go(-1)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Voltar</button>

    <div v-if="store.loading">Carregando...</div>

    <transition-group name="fade" tag="div" class="space-y-3">
        
      <TaskCard
        v-for="task in store.tasks.data"
        :key="task.id"
        :task="task"
      >
        <select
          v-model="task.status"
          @change="updateStatus(task, task.status)"
          class="mt-3 border rounded p-1 text-sm text-black"
        >
          <option value="todo">To Do</option>
          <option value="in_progress">In Progress</option>
          <option value="done">Done</option>
        </select>
      </TaskCard>
    </transition-group>
  </div>
</template>