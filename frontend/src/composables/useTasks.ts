import axios from 'axios'
import { useTaskStore } from '@/stores/task.store'
import type { Task } from '@/stores/task.store'

export function useTasks() {
  const store = useTaskStore()

  async function fetchTasks(projectId: number) {
    store.loading = true
    try {
      const { data } = await axios.get(`/api/projects/${projectId}/tasks`)
      store.tasks = data
    } catch (err: any) {
      store.error = err.message
    } finally {
      store.loading = false
    }
  }

  async function updateStatus(task: Task, newStatus: Task['status']) {
    const oldStatus = task.status
    task.status = newStatus

    try {
      await axios.patch(`/api/tasks/${task.id}`, {
        status: newStatus
      })
    } catch {
      task.status = oldStatus
    }
  }

  async function createTask(projectId: number, task: { title: string; description: string, priority: string }) {
    try {
      const { data } = await axios.post(`/api/projects/${projectId}/tasks`, task)
      store.tasks.push(data)
    } catch (err) {
      store.error = err
    }
  }

  async function deleteTask(id: number) {
    await axios.delete(`/api/tasks/${id}`)
  }

  return {
    fetchTasks,
    updateStatus,
    createTask, 
    deleteTask
  }
}