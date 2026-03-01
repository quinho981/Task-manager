<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useProjects } from '@/composables/useProjects'
import { useProjectStore } from '@/stores/project.store'
import { useRouter } from 'vue-router'
import ProjectModal from '@/components/ProjectModal.vue'

const { fetchProjects, createProject } = useProjects()
const store = useProjectStore()
const router = useRouter()

const showModal = ref(false)

onMounted(() => {
  fetchProjects()
})

function goToProject(id: number) {
  router.push(`/projects/${id}`)
}

async function handleCreate(data: any) {
  await createProject(data)
  showModal.value = false
  fetchProjects()
}
</script>

<template>
    <div class="min-h-screen">
        <div class="max-w-6xl mx-auto px-8 py-14">
            <div class="mb-12 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-gray-300 ">
                        Projetos
                    </h1>
                    <p class="text-sm text-neutral-500 mt-2">
                        Gerencie e acompanhe seus projetos ativos
                    </p>
                </div>
                <div>
                    <button
                    @click="showModal = true"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium 
                            rounded-xl text-white bg-blue-500 
                            hover:bg-blue-600 transition-all duration-300"
                    >
                        + Novo Projeto
                    </button>
                </div>
            </div>

            <div v-if="store.loading" class="grid gap-6 md:grid-cols-2">
                <div
                    v-for="n in 4"
                    :key="n"
                    class="h-32 rounded-2xl bg-white border border-neutral-200 animate-pulse"
                />
            </div>

            <div
                v-else
                class="grid gap-6 md:grid-cols-2 xl:grid-cols-3"
            >
                <div
                    v-for="project in store.projects.data"
                    :key="project.id"
                    @click="goToProject(project.id)"
                    class="group relative p-6 rounded-2xl bg-white border border-neutral-200 
                        hover:border-neutral-300 hover:shadow-xl 
                        transition-all duration-300 ease-out 
                        cursor-pointer"
                >
                    <span class="text-xs font-medium text-neutral-400">
                        Projeto #{{ project.id }}
                    </span>

                    <h2 class="mt-3 text-lg font-medium text-neutral-900 group-hover:text-black transition-colors">
                        {{ project.name }}
                    </h2>

                    <p class="mt-3 text-sm text-neutral-500 leading-relaxed line-clamp-2">
                        {{ project.description }}
                    </p>

                    <div class="absolute inset-0 rounded-2xl ring-1 ring-transparent group-hover:ring-neutral-900/5 transition" />
                </div>
            </div>
        </div>
        <ProjectModal
            v-if="showModal"
            @close="showModal = false"
            @create="handleCreate"
        />
    </div>
</template>