<script setup lang="ts">
import { Task } from '@/stores/task.store'
import { computed } from 'vue'

const props = defineProps<{
  task: Task
}>()

const isOverdue = computed(() => {
  if (!props.task.due_date) return false
  return new Date(props.task.due_date) < new Date() &&
         props.task.status !== 'done'
})
</script>

<template>
  <div
    class="p-5 rounded-xl shadow border transition"
    :class="isOverdue ? 'border-red-500 bg-red-50' : 'border-gray-200 bg-white'"
  >
    <div class="flex justify-between">
      <h3 class="font-semibold text-gray-800">{{ task.title }}</h3>
      <span class="text-sm bg-gray-400 text-white px-2 ml-2 py-1 rounded">{{ task.priority }}</span>
    </div>

    <p class="text-sm text-gray-600 mt-2">
      {{ task.description }}
    </p>

    <slot />
  </div>
</template>