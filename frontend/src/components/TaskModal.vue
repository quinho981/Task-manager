<script setup lang="ts">
import { ref } from 'vue'

const props = defineProps<{
    loading: boolean
}>()

const emit = defineEmits(['close', 'create'])

const title = ref('')
const description = ref('')
const priority = ref('low')

function submit() {
    if (!title.value || !description.value) {
        alert('Por favor, informe o título e a descrição da tarefa.')
        return
    }

    emit('create', {
        title: title.value,
        description: description.value,
        priority: priority.value
    })
}
</script>

<template>
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div
        class="absolute inset-0 bg-black/40 backdrop-blur-sm"
        @click="$emit('close')"
        />
        <div class="relative bg-white w-full max-w-md mx-4 rounded-2xl shadow-2xl p-8 animate-fadeIn">
            <h2 class="text-xl font-semibold text-neutral-900">
                Nova Tarefa
            </h2>
            <p class="text-sm text-neutral-500 mt-1">
                Adicione uma nova tarefa ao projeto
            </p>
        <div class="mt-6 space-y-5">
            <div>
                <label class="text-sm text-neutral-600">Título</label>
                <input
                    v-model="title"
                    type="text"
                    class="mt-2 w-full px-4 py-2 
                        rounded-xl border border-neutral-200 
                        bg-neutral-50 text-black
                        focus:outline-none 
                        focus:ring-2 focus:ring-neutral-900/10
                        transition"
                    placeholder="Ex: Implementar autenticação"
                />
            </div>
            <div>
                <label class="text-sm text-neutral-600">Descrição</label>
                <textarea
                    v-model="description"
                    rows="3"
                    class="mt-2 w-full px-4 py-2 
                        rounded-xl border border-neutral-200 
                        bg-neutral-50 text-black
                        focus:outline-none 
                        focus:ring-2 focus:ring-neutral-900/10
                        transition"
                    placeholder="Detalhe o que precisa ser feito..."
                />
            </div>
            <div>
                <label class="text-sm text-neutral-600">Prioridade</label>
                <select
                    v-model="priority"
                    class="mt-2 w-full px-4 py-2 
                        rounded-xl border border-neutral-200 
                        bg-neutral-50 text-black
                        focus:outline-none 
                        focus:ring-2 focus:ring-neutral-900/10
                        transition"
                >
                    <option value="low">Baixa</option>
                    <option value="medium">Média</option>
                    <option value="high">Alta</option>
                </select>
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
                :disabled="props.loading"
                class="px-4 py-2 text-sm rounded-xl 
                    text-white bg-blue-500 
                    hover:bg-blue-600 
                    disabled:opacity-50
                    transition"
            >
                {{ props.loading ? 'Criando...' : 'Criar Tarefa' }}
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