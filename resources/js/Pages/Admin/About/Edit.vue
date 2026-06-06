<template>
  <AdminLayout title="Mi perfil">
    <div class="page">
      <div class="page-header">
        <h2 class="page-title">Mi perfil</h2>
      </div>

      <form class="form-card" @submit.prevent="submit">

        <!-- Foto -->
        <div class="field">
          <label class="field-label">Foto de perfil</label>
          <div class="image-upload" @click="triggerFileInput('photo')">
            <img
              v-if="about.photo || photoPreview"
              :src="`/storage/${about.photo}` || photoPreview"
              alt="Preview"
              class="image-preview"
            />
            <div v-else class="image-placeholder">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <circle cx="8.5" cy="8.5" r="1.5" />
                <polyline points="21 15 16 10 5 21" />
              </svg>
              <p class="placeholder-text">Hacé clic para subir una foto</p>
              <p class="placeholder-sub">PNG, JPG hasta 2MB</p>
            </div>
          </div>
          <input ref="photoInput" type="file" accept="image/*" class="file-hidden" @change="onPhotoChange" />
          <span v-if="form.errors.photo" class="field-error">{{ form.errors.photo }}</span>
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
          />
          <span v-if="form.errors.name" class="field-error">{{ form.errors.name }}</span>
        </div>

        <!-- Bio -->
        <div class="field">
          <label class="field-label" for="bio">Bio</label>
          <textarea
            id="bio"
            v-model="form.bio"
            class="field-input field-textarea"
            :class="{ 'field-input--error': form.errors.bio }"
            rows="4"
          />
          <span v-if="form.errors.bio" class="field-error">{{ form.errors.bio }}</span>
        </div>

        <!-- Stack -->
        <div class="field">
          <label class="field-label">Stack</label>
          <div class="tags-wrap">
            <span v-for="(tag, i) in form.stack" :key="i" class="tag">
              {{ tag }}
              <button type="button" class="tag-remove" @click="removeTag(i)">×</button>
            </span>
            <input
              v-model="newTag"
              type="text"
              class="tag-input"
              placeholder="Agregar tecnología..."
              @keydown.enter.prevent="addTag"
              @keydown.comma.prevent="addTag"
            />
          </div>
        </div>

        <!-- CV -->
        <div class="field">
          <label class="field-label">Currículum (PDF)</label>
          <div class="cv-wrap">
            <a
              v-if="about.cv && !cvFile"
              :href="`/storage/${about.cv}`"
              target="_blank"
              class="cv-link"
            >
              Ver CV actual →
            </a>
            <span v-if="cvFile" class="cv-file">{{ cvFile }}</span>
            <button type="button" class="btn-ghost" @click="triggerFileInput('cv')">
              {{ about.cv ? 'Reemplazar CV' : 'Subir CV' }}
            </button>
          </div>
          <input ref="cvInput" type="file" accept=".pdf" class="file-hidden" @change="onCvChange" />
          <span v-if="form.errors.cv" class="field-error">{{ form.errors.cv }}</span>
        </div>

        <!-- Botones -->
        <div class="form-actions">
          <button type="submit" class="btn-primary" :disabled="form.processing">
            <span v-if="form.processing" class="spinner" />
            {{ form.processing ? 'Guardando...' : 'Guardar cambios' }}
          </button>
        </div>

      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Swal from 'sweetalert2'

const props = defineProps({
  about: { type: Object, required: true }
})

const photoInput = ref(null)
const cvInput    = ref(null)
const photoPreview = ref(null)
const cvFile       = ref(null)
const newTag       = ref('')

const form = useForm({
  name:  props.about.name,
  bio:   props.about.bio,
  stack: props.about.stack ?? [],
  photo: null,  
  cv:    null,
  _method: 'PUT',
})

function triggerFileInput(type) {
  if (type === 'photo') photoInput.value.click()
  if (type === 'cv')    cvInput.value.click()
}

function onPhotoChange(e) {
  const file = e.target.files[0]
  if (file) form.photo = file  // solo se agrega si hay archivo nuevo
}

function onCvChange(e) {
  const file = e.target.files[0]
  if (file) form.cv = file
}

function addTag() {
  const tag = newTag.value.trim().replace(',', '')
  if (tag && !form.stack.includes(tag)) {
    form.stack.push(tag)
  }
  newTag.value = ''
}

function removeTag(i) {
  form.stack.splice(i, 1)
}

function submit() {
  form.post('/admin/about', {
    forceFormData: true,
    onSuccess: () => {
      Swal.fire({
        title: '¡Perfil actualizado!',
        icon: 'success',
        confirmButtonText: 'Aceptar'
      })
    },
    onError: () => {
      Swal.fire({
        title: 'Error',
        text: 'Hubo un problema al guardar los cambios.',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      })
    }
  })
}
</script>

<style scoped>
.page { font-family: 'DM Sans', sans-serif; }

.page-header { margin-bottom: 1.5rem; }

.page-title {
  font-size: 18px;
  font-weight: 500;
  color: #1a1a18;
}

.form-card {
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 12px;
  padding: 2rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  max-width: 640px;
}

.field {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.field-label {
  font-size: 13px;
  font-weight: 500;
  color: #4a4a45;
}

.field-input {
  font-size: 14px;
  color: #1a1a18;
  background: #fff;
  border: 1px solid #e5e5e3;
  border-radius: 8px;
  padding: 10px 14px;
  outline: none;
  transition: border-color .18s;
}

.field-input:focus { border-color: #1a1a18; }
.field-input--error { border-color: #e55050; }
.field-textarea { resize: vertical; min-height: 100px; }
.field-error { font-size: 12px; color: #e55050; }

/* Imagen */
.image-upload {
  width: 160px;
  height: 160px;
  border-radius: 50%;
  border: 1px dashed #d6d3cc;
  overflow: hidden;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f5f4f2;
  transition: border-color .18s;
}

.image-upload:hover { border-color: #1a1a18; }

.image-preview {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.image-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  color: #9c9a93;
  padding: 1rem;
  text-align: center;
}

.placeholder-text { font-size: 12px; }
.placeholder-sub  { font-size: 11px; color: #b0ada6; }
.file-hidden      { display: none; }

/* Tags */
.tags-wrap {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  padding: 8px 12px;
  background: #fff;
  border: 1px solid #e5e5e3;
  border-radius: 8px;
  min-height: 44px;
  align-items: center;
}

.tag {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 3px 10px;
  background: #1a1a18;
  color: #fafaf9;
  border-radius: 20px;
  font-size: 12px;
}

.tag-remove {
  background: none;
  border: none;
  color: #fafaf9;
  cursor: pointer;
  font-size: 14px;
  line-height: 1;
  padding: 0;
  opacity: .7;
}

.tag-remove:hover { opacity: 1; }

.tag-input {
  border: none;
  outline: none;
  font-size: 13px;
  color: #1a1a18;
  background: transparent;
  min-width: 140px;
}

/* CV */
.cv-wrap {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}

.cv-link {
  font-size: 13px;
  color: #1a1a18;
  text-decoration: underline;
}

.cv-file {
  font-size: 13px;
  color: #78766f;
}

/* Botones */
.form-actions { display: flex; justify-content: flex-end; }

.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 24px;
  background: #1a1a18;
  color: #fafaf9;
  font-size: 13px;
  font-weight: 500;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background .18s;
}

.btn-primary:hover:not(:disabled) { background: #333330; }
.btn-primary:disabled { opacity: .6; cursor: not-allowed; }

.btn-ghost {
  display: inline-flex;
  align-items: center;
  padding: 8px 16px;
  background: transparent;
  color: #78766f;
  font-size: 13px;
  border: 1px solid #e5e5e3;
  border-radius: 8px;
  cursor: pointer;
  transition: border-color .18s;
  text-decoration: none;
}

.btn-ghost:hover { border-color: #b0ada6; }

.spinner {
  width: 14px;
  height: 14px;
  border: 2px solid rgba(250,250,249,.3);
  border-top-color: #fafaf9;
  border-radius: 50%;
  animation: spin .7s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }
</style>