import axios from 'axios'
import { useProjectStore } from '@/stores/project.store'

export function useProjects() {
  const store = useProjectStore()

  async function fetchProjects() {
    store.loading = true
    try {
      const { data } = await axios.get('/api/projects')
      store.projects = data
    } catch (err) {
      store.error = err
    } finally {
      store.loading = false
    }
  }

  return { fetchProjects }
}