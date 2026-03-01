import axios from 'axios'
import { useProjectStore } from '@/stores/project.store'

export function useProjects() {
  const store = useProjectStore()

  async function fetchProjects(page = 1) {
    store.loading = true

    const { data } = await axios.get('/api/projects', {
      params: { page }
    })

    store.projects = data
    store.loading = false
  }

  async function createProject(project: { name: string; description: string }) {
    try {
      const { data } = await axios.post('/api/projects', project)
      store.projects.push(data)
    } catch (err) {
      store.error = err
    }
  }

  return { fetchProjects, createProject }
}