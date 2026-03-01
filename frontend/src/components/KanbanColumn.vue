<script setup lang="ts">
import draggable from 'vuedraggable'
import TaskCard from '@/components/TaskCard.vue'

interface Task {
  id: number
  status: string
  [key: string]: any
}

const props = defineProps<{
  title: string
  status: string
  tasks: Task[]
  loading?: boolean
}>()

const emit = defineEmits<{
  (e: 'moved', task: Task, status: string): void
  (e: 'delete', task: Task): void
}>()

function handleChange(evt: any) {
  if (evt.added) {
    const task = evt.added.element
    emit('moved', task, props.status)
  }
}
</script>

<template>
    <div>
      <h2 class="text-sm font-medium text-gray-300 mb-4">
          {{ title }}
      </h2>
      <draggable
          :list="tasks"
          group="tasks"
          item-key="id"
          class="space-y-4 min-h-[200px]"
          ghost-class="ghost"
          @change="handleChange"
      >
          <template #item="{ element: task }">
              <div class="card cursor-grab active:cursor-grabbing">
                  <TaskCard :task="task" />
                  <button
                      @click.stop="emit('delete', task)"
                      class="ml-3 text-xs text-red-500 hover:text-red-700 hover:!border-red-500 mt-2 transition"
                  >
                      Deletar                    
                  </button>
              </div>
          </template>
      </draggable>
    </div>
</template>

<style scoped>
.card {
  background: white;
  border: 1px solid #e5e5e5;
  border-radius: 1rem;
  padding: 1.5rem;
  transition: all 0.25s ease;
}

.card:hover {
  border-color: #d4d4d4;
  box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.ghost {
  opacity: 0.4;
}
</style>