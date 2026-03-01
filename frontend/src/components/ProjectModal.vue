<script setup lang="ts">
import { ref } from 'vue'

const emit = defineEmits(['close', 'create'])

const name = ref('')
const description = ref('')
const loading = ref(false)

async function submit() {
    if (!name.value || !description.value) {
        alert('Por favor, informe o nome e a descrição do projeto.')
        return
    }

    loading.value = true

    await emit('create', {
        name: name.value,
        description: description.value
    })

    name.value = ''
    description.value = ''
}
</script>

<template>
    <div
        class="fixed inset-0 z-50 flex items-center justify-center"
    >
        <div
            class="absolute inset-0 bg-black/40 backdrop-blur-sm"
            @click="$emit('close')"
        />
        <div
            class="relative bg-white w-full max-w-md mx-4 
                rounded-2xl shadow-2xl 
                p-8 animate-fadeIn"
        >
            <h2 class="text-xl font-semibold text-neutral-900">
                Novo Projeto
            </h2>

            <p class="text-sm text-neutral-500 mt-1">
                Crie um novo projeto para organizar suas tarefas
            </p>

            <div class="mt-6 space-y-5">
                <div>
                    <label class="text-sm text-neutral-600">Nome</label>
                    <input
                        v-model="name"
                        type="text"
                        class="mt-2 w-full px-4 py-2 
                            rounded-xl border border-neutral-200 
                            bg-neutral-50
                            focus:outline-none 
                            focus:ring-2 focus:ring-neutral-900/10
                            transition text-black"
                        placeholder="Ex: Sistema de Agendamento"
                    />
                </div>
                <div>
                    <label class="text-sm text-neutral-600">Descrição</label>
                    <textarea
                        v-model="description"
                        rows="3"
                        class="mt-2 w-full px-4 py-2 
                            rounded-xl border border-neutral-200 
                            bg-neutral-50
                            focus:outline-none 
                            focus:ring-2 focus:ring-neutral-900/10
                            transition text-black"
                        placeholder="Descreva o objetivo do projeto..."
                    />
                </div>

            </div>
            <div class="mt-8 flex justify-end gap-3">
                <button
                    @click="$emit('close')"
                    class="px-4 py-2 text-sm rounded-xl 
                            bg-gray-600
                            transition"
                >
                    Cancelar
                </button>

                <button
                @click="submit"
                :disabled="loading"
                class="px-4 py-2 text-sm rounded-xl 
                            text-white bg-blue-500 
                            hover:bg-blue-600 
                        disabled:opacity-50
                        transition"
                >
                    {{ loading ? 'Criando...' : 'Criar Projeto' }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(8px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.18s ease-out;
}
</style>