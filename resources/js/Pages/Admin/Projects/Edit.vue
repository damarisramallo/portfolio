<template>
    <AdminLayout :title="`Editar: ${project.title}`">
        <div class="page">
            <div class="page-header">
                <Link href="/admin/projects" class="back-link">
                    ← Volver a proyectos
                </Link>
                <h2 class="page-title">Editar proyecto</h2>
            </div>

            <form class="form-card" @submit.prevent="submit">
                <!-- Imagen con preview -->
                <div class="field">
                    <label class="field-label">Imagen del proyecto</label>

                    <div class="image-upload" @click="triggerFileInput">
                        <!-- Muestra preview nuevo o imagen existente -->
                        <img
                            v-if="preview || project.image"
                            :src="preview || `/storage/${project.image}`"
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
                                <rect
                                    x="3"
                                    y="3"
                                    width="18"
                                    height="18"
                                    rx="2"
                                />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                            <p class="placeholder-text">
                                Hacé clic para cambiar la imagen
                            </p>
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

                    <span v-if="form.errors.image" class="field-error">
                        {{ form.errors.image }}
                    </span>
                </div>

                <!-- Video demo (YouTube) -->
                <div class="field">
                <label class="field-label">Video demo (YouTube)</label>
                <input
                    v-model="form.youtube_url"
                    type="url"
                    class="field-input"
                    placeholder="https://www.youtube.com/watch?v=..."
                />
                <span v-if="form.errors.youtube_url" class="field-error">
                    {{ form.errors.youtube_url }}
                </span>
                </div>

                <!-- Título -->
                <div class="field">
                    <label class="field-label" for="title">Título</label>
                    <input
                        id="title"
                        v-model="form.title"
                        type="text"
                        class="field-input"
                        :class="{ 'field-input--error': form.errors.title }"
                    />
                    <span v-if="form.errors.title" class="field-error">
                        {{ form.errors.title }}
                    </span>
                </div>

                <!-- Descripción -->
                <div class="field">
                    <label class="field-label" for="description"
                        >Descripción</label
                    >
                    <textarea
                        id="description"
                        v-model="form.description"
                        class="field-input field-textarea"
                        :class="{
                            'field-input--error': form.errors.description,
                        }"
                        rows="4"
                    />
                    <span v-if="form.errors.description" class="field-error">
                        {{ form.errors.description }}
                    </span>
                </div>

                <!-- Extracto -->
                <div class="field">
                    <label class="field-label" for="excerpt"
                        >Extracto (breve descripción)</label
                    >
                    <input
                        id="excerpt"
                        v-model="form.excerpt"
                        type="text"
                        class="field-input"
                        :class="{ 'field-input--error': form.errors.excerpt }"
                    />
                    <span v-if="form.errors.excerpt" class="field-error">
                        {{ form.errors.excerpt }}
                    </span>
                </div>

                <!-- Slug -->
                <div class="field">
                    <label class="field-label" for="slug"
                        >Slug (URL amigable)</label
                    >
                    <input
                        id="slug"
                        v-model="form.slug"
                        type="text"
                        class="field-input"
                        :class="{ 'field-input--error': form.errors.slug }"
                        placeholder="Ej: mi-proyecto-increible"
                    />
                    <span v-if="form.errors.slug" class="field-error">
                        {{ form.errors.slug }}
                    </span>
                    
                </div>

                <!-- URL -->
                <div class="field">
                    <label class="field-label" for="url"
                        >URL del proyecto</label
                    >
                    <input
                        id="url"
                        v-model="form.url"
                        type="url"
                        class="field-input"
                        :class="{ 'field-input--error': form.errors.url }"
                        placeholder="https://..."
                    />
                    <span v-if="form.errors.url" class="field-error">
                        {{ form.errors.url }}
                    </span>
                </div>

                <!-- Tags -->
                <div class="field">
                    <label class="field-label">Tags</label>
                    <div class="tags-input">
                        <span
                            v-for="tag in form.tags"
                            :key="tag"
                            class="tag-chip"
                        >
                            {{ tag }}
                            <button
                                type="button"
                                class="tag-remove"
                                @click="removeTag(tag)"
                            >
                                ×
                            </button>
                        </span>
                        <input
                            v-model="tagInput"
                            type="text"
                            class="tag-field"
                            placeholder="Agregar tag..."
                            @keydown.enter.prevent="addTag"
                            @keydown.comma.prevent="addTag"
                        />
                    </div>
                    <p class="field-hint">Presioná Enter o coma para agregar</p>
                </div>

                <div class="field">
                <label class="field-label">En desarrollo</label>
                <label class="toggle-label">
                    <input
                    v-model="form.in_development"
                    type="checkbox"
                    class="toggle-check"
                    />
                    <span class="toggle-text">
                    {{ form.in_development ? 'En desarrollo' : 'Completado' }}
                    </span>
                </label>
                </div>

                <div class="form-row">
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

                    <!-- Visible -->
                    <div class="field">
                        <label class="field-label">Visibilidad</label>
                        <label class="toggle-label">
                            <input
                                v-model="form.visible"
                                type="checkbox"
                                class="toggle-check"
                            />
                            <span class="toggle-text">
                                {{
                                    form.visible
                                        ? "Visible en el portfolio"
                                        : "Oculto"
                                }}
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Botones -->
                <div class="form-actions">
                    <Link href="/admin/projects" class="btn-ghost"
                        >Cancelar</Link
                    >
                    <button
                        type="submit"
                        class="btn-primary"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing" class="spinner" />
                        {{
                            form.processing ? "Guardando..." : "Guardar cambios"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Swal from "sweetalert2";

const props = defineProps({
    project: { type: Object, required: true },
});

const fileInput = ref(null);
const preview = ref(null);
const tagInput = ref("");


const form = useForm({
    title: props.project.title,
    description: props.project.description,
    url: props.project.url ?? "",
    youtube_url: props.project.youtube_url ?? '',
    image: null, 
    tags: props.project.tags ?? [],
    in_development: props.project.in_development,
    order: props.project.order,
    visible: props.project.visible,
    excerpt: props.project.excerpt,
    slug: props.project.slug,
    _method: "PUT", // necesario para spoofing de método HTTP
});

function triggerFileInput() {
    fileInput.value.click();
}

function onFileChange(e) {
    const file = e.target.files[0];
    if (!file) return;
    form.image = file;
    const reader = new FileReader();
    reader.onload = (event) => {
        preview.value = event.target.result;
    };
    reader.readAsDataURL(file);
}

function addTag() {
    const tag = tagInput.value.trim().replace(",", "");
    if (tag && !form.tags.includes(tag)) {
        form.tags.push(tag);
    }
    tagInput.value = "";
}

function removeTag(tag) {
    form.tags = form.tags.filter((t) => t !== tag);
}



async function submit() {
  form.post(`/admin/projects/${props.project.id}`, {
    forceFormData: true,
    onSuccess: () => {
      Swal.fire({
        title: '¡Proyecto actualizado!',
        text: 'El proyecto se actualizó correctamente.',
        icon: 'success',
        confirmButtonText: 'Aceptar'
      })
    },
    onError: () => {
      Swal.fire({
        title: 'Error',
        text: 'Hubo un problema al actualizar el proyecto.',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      })
    }
  })
}
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap");

.page {
    font-family: "DM Sans", sans-serif;
    max-width: 680px;
}
.page-header {
    margin-bottom: 1.5rem;
}
.back-link {
    font-size: 13px;
    color: #9c9a93;
    text-decoration: none;
    transition: color 0.18s;
    display: inline-block;
    margin-bottom: 8px;
}
.back-link:hover {
    color: #1a1a18;
}
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
    gap: 20px;
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
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
    font-family: "DM Sans", sans-serif;
    font-size: 14px;
    color: #1a1a18;
    background: #fff;
    border: 1px solid #e5e5e3;
    border-radius: 8px;
    padding: 10px 14px;
    outline: none;
    transition:
        border-color 0.18s,
        box-shadow 0.18s;
    width: 100%;
}
.field-input:focus {
    border-color: #1a1a18;
    box-shadow: 0 0 0 3px rgba(26, 26, 24, 0.06);
}
.field-input--error {
    border-color: #e55050;
}
.field-textarea {
    resize: vertical;
    min-height: 100px;
}
.field-error {
    font-size: 12px;
    color: #e55050;
}
.field-hint {
    font-size: 11px;
    color: #b0ada6;
}
.image-upload {
    border: 1.5px dashed #dddbd6;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.18s;
    min-height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.image-upload:hover {
    border-color: #b0ada6;
}
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
.placeholder-sub {
    font-size: 12px;
}
.file-hidden {
    display: none;
}
.tags-input {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    padding: 8px 10px;
    border: 1px solid #e5e5e3;
    border-radius: 8px;
    background: #fff;
    min-height: 44px;
}
.tag-chip {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #1a1a18;
    color: #fafaf9;
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 4px;
}
.tag-remove {
    background: none;
    border: none;
    color: #fafaf9;
    cursor: pointer;
    font-size: 14px;
    padding: 0;
    line-height: 1;
    opacity: 0.7;
}
.tag-remove:hover {
    opacity: 1;
}
.tag-field {
    border: none;
    outline: none;
    font-family: "DM Sans", sans-serif;
    font-size: 13px;
    color: #1a1a18;
    flex: 1;
    min-width: 120px;
    background: transparent;
}
.toggle-label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    padding: 10px 14px;
    border: 1px solid #e5e5e3;
    border-radius: 8px;
    background: #fff;
}
.toggle-check {
    cursor: pointer;
    width: 16px;
    height: 16px;
}
.toggle-text {
    font-size: 14px;
    color: #4a4a45;
}
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
    font-family: "DM Sans", sans-serif;
    font-size: 13px;
    font-weight: 500;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    transition: background 0.18s;
    text-decoration: none;
}
.btn-primary:hover:not(:disabled) {
    background: #333330;
}
.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
.btn-ghost {
    display: inline-flex;
    align-items: center;
    padding: 10px 22px;
    background: transparent;
    color: #78766f;
    font-family: "DM Sans", sans-serif;
    font-size: 13px;
    border: 1px solid #e5e5e3;
    border-radius: 7px;
    text-decoration: none;
    transition: border-color 0.15s;
}
.btn-ghost:hover {
    border-color: #b0ada6;
}
.spinner {
    width: 13px;
    height: 13px;
    border: 2px solid rgba(250, 250, 249, 0.3);
    border-top-color: #fafaf9;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
}
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
@media (max-width: 500px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    .form-card {
        padding: 1.25rem;
    }
}
</style>
