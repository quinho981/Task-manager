<script setup lang="ts">
import { onMounted } from 'vue'
import { useProjects } from '@/composables/useProjects'
import { useProjectStore } from '@/stores/project.store'
import { useRouter } from 'vue-router'

const { fetchProjects } = useProjects()
const store = useProjectStore()
const router = useRouter()

onMounted(() => {
  fetchProjects()
})

function goToProject(id: number) {
  router.push(`/projects/${id}`)
}
</script>

<template>
    <div class="p-6 space-y-4">
        <h1 class="text-2xl font-bold">Projetos</h1>

        <div v-if="store.loading">Carregando...</div>

        <div class="grid gap-4 md:grid-cols-2">
            <!-- {{store.projects}} -->
            <div
                v-for="project in store.projects.data"
                :key="project.id"
                class="p-4 bg-white shadow rounded-xl cursor-pointer hover:shadow-lg transition"
                @click="goToProject(project.id)"
            >
                <span class="text-blue-600">#{{ project.id }}</span>
                <h2 class="font-semibold text-lg text-gray-800">
                    {{ project.name }}
                </h2>

                <p class="text-sm text-gray-500 mt-2">
                    {{ project.description }}
                </p>
            </div>
        </div>
    </div>
</template>