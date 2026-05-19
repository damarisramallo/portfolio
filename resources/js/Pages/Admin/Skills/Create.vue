<template>
    <AdminLayout title="Nueva habilidad">
        <div class="page">
            <div class="page-header">
                <Link href="/admin/skills" class="back-link">
                    ← Volver a habilidades
                </Link>
                <h2 class="page-title">Nueva habilidad</h2>
            </div>

            <form class="form-card" @submit.prevent="submit">
                <!-- Imagen con preview -->
                <div class="field">
                    <label class="field-label">Ícono de la habilidad</label>

                    <div class="image-upload" @click="triggerFileInput">
                        <img
                            v-if="preview"
                            :src="preview"
                            alt="Preview"
                            class="image-preview"
                        />
                        <div v-else class="image-placeholder">
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                            <p class="placeholder-text">Hacé clic para subir un ícono</p>
                            <p class="placeholder-sub">PNG, JPG hasta 2MB</p>
                        </div>
                    </div>

                    <input
                        ref="fileInput"
                        type="file"
                        accept="image/*"
                        class="file-hidden"
                        @change="onFileChange"
                    />

                    <span v-if="form.errors.icon" class="field-error">
                        {{ form.errors.icon }}
                    </span>
                </div>

                <!-- Nombre -->
                <div class="field">
                    <label class="field-label" for="name">Nombre</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="field-input"
                        :class="{ 'field-input--error': form.errors.name }"
                        placeholder="Ej: Vue.js"
                    />
                    <span v-if="form.errors.name" class="field-error">
                        {{ form.errors.name }}
                    </span>
                </div>

                <!-- Orden -->
                <div class="field">
                    <label class="field-label" for="order">Orden</label>
                    <input
                        id="order"
                        v-model="form.order"
                        type="number"
                        min="0"
                        class="field-input"
                    />
                </div>

                <!-- Botones -->
                <div class="form-actions">
                    <Link href="/admin/skills" class="btn-ghost">Cancelar</Link>
                    <button
                        type="submit"
                        class="btn-primary"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing" class="spinner" />
                        {{ form.processing ? 'Guardando...' : 'Guardar habilidad' }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Swal from 'sweetalert2'

const fileInput = ref(null)
const preview = ref(null)

const form = useForm({
    name:  '',
    icon:  null,
    order: 0,
})

function triggerFileInput() {
    fileInput.value.click()
}

function onFileChange(e) {
    const file = e.target.files[0]
    if (!file) return
    form.icon = file
    const reader = new FileReader()
    reader.onload = (event) => {
        preview.value = event.target.result
    }
    reader.readAsDataURL(file)
}

async function submit() {
    form.post('/admin/skills', {
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                title: '¡Habilidad creada!',
                text: 'La habilidad se guardó correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        },
        onError: () => {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema al guardar la habilidad.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
        }
    })
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap');


.page { font-family: 'DM Sans', sans-serif; max-width: 680px; }

.page-header { margin-bottom: 1.5rem; }

.back-link {
  font-size: 13px;
  color: #9c9a93;
  text-decoration: none;
  transition: color .18s;
  display: inline-block;
  margin-bottom: 8px;
}

.back-link:hover { color: #1a1a18; }

.page-title {
  font-size: 18px;
  font-weight: 500;
  color: #1a1a18;
}

/* Formulario */
.form-card {
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 12px;
  padding: 2rem;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

/* Campos */
.field { display: flex; flex-direction: column; gap: 6px; }

.field-label {
  font-size: 13px;
  font-weight: 500;
  color: #4a4a45;
}

.field-input {
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  color: #1a1a18;
  background: #fff;
  border: 1px solid #e5e5e3;
  border-radius: 8px;
  padding: 10px 14px;
  outline: none;
  transition: border-color .18s, box-shadow .18s;
  width: 100%;
}

.field-input:focus {
  border-color: #1a1a18;
  box-shadow: 0 0 0 3px rgba(26,26,24,.06);
}

.field-input--error { border-color: #e55050; }

.field-textarea { resize: vertical; min-height: 100px; }

.field-error { font-size: 12px; color: #e55050; }

.field-hint { font-size: 11px; color: #b0ada6; }

/* Imagen upload */
.image-upload {
  border: 1.5px dashed #dddbd6;
  border-radius: 10px;
  overflow: hidden;
  cursor: pointer;
  transition: border-color .18s;
  min-height: 160px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.image-upload:hover { border-color: #b0ada6; }

.image-preview {
  width: 100%;
  height: 220px;
  object-fit: cover;
  display: block;
}

.image-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  padding: 2rem;
  color: #b0ada6;
}

.placeholder-text {
  font-size: 13px;
  font-weight: 500;
  color: #78766f;
}

.placeholder-sub { font-size: 12px; }

.file-hidden { display: none; }

/* Acciones */
.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  padding-top: 4px;
}

.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 22px;
  background: #1a1a18;
  color: #fafaf9;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 500;
  border: none;
  border-radius: 7px;
  cursor: pointer;
  transition: background .18s;
  text-decoration: none;
}

.btn-primary:hover:not(:disabled) { background: #333330; }
.btn-primary:disabled { opacity: .6; cursor: not-allowed; }

.btn-ghost {
  display: inline-flex;
  align-items: center;
  padding: 10px 22px;
  background: transparent;
  color: #78766f;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  border: 1px solid #e5e5e3;
  border-radius: 7px;
  text-decoration: none;
  transition: border-color .15s;
}

.btn-ghost:hover { border-color: #b0ada6; }

.spinner {
  width: 13px;
  height: 13px;
  border: 2px solid rgba(250,250,249,.3);
  border-top-color: #fafaf9;
  border-radius: 50%;
  animation: spin .7s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

@media (max-width: 500px) {
  .form-row { grid-template-columns: 1fr; }
  .form-card { padding: 1.25rem; }
}
</style>