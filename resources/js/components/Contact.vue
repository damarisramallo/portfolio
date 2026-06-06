<template>
  <section class="contact">
    <div class="contact-inner">

      <!-- Encabezado -->
      <div class="contact-header">
        <p class="section-label">Hablemos</p>
        <h2 class="section-title">Contacto</h2>
        <p class="section-sub">
          ¿Tenés un proyecto en mente o querés trabajar juntos?
          Escribime y te respondo a la brevedad.
        </p>
      </div>

      <div class="contact-layout">

        <!-- Info lateral -->
        <div class="contact-info">
          <div class="info-item">
            <span class="info-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/></svg>
            </span>
            <div>
              <p class="info-label">GitHub</p>
              <a href="https://github.com/damarisramallo" target="_blank" rel="noopener" class="info-value">
                github.com/damarisramallo
              </a>
            </div>
          </div>
          <div class="info-item">
            <span class="info-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
            </span>
            <div>
              <p class="info-label">LinkedIn</p>
              <a href="https://www.linkedin.com/in/damarisramallo/" target="_blank" rel="noopener" class="info-value">
                linkedin.com/in/damarisramallo
              </a>
            </div>
          </div>
        </div>

        <!-- Formulario -->
        <div class="form-wrap">

          <!-- Éxito -->
          <div v-if="form.wasSuccessful" class="success-msg">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <div>
              <p class="success-title">¡Mensaje enviado!</p>
              <p class="success-sub">Te respondo a la brevedad.</p>
            </div>
          </div>

          <form v-else @submit.prevent="submit" novalidate>

            <div class="form-row">
              <!-- Nombre -->
              <div class="field">
                <label class="field-label" for="name">Nombre</label>
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  class="field-input"
                  :class="{ 'field-input--error': form.errors.name }"
                  placeholder="Tu nombre"
                  autocomplete="name"
                />
                <span v-if="form.errors.name" class="field-error">
                  {{ form.errors.name }}
                </span>
              </div>

              <!-- Email -->
              <div class="field">
                <label class="field-label" for="email">Email</label>
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  class="field-input"
                  :class="{ 'field-input--error': form.errors.email }"
                  placeholder="tu@email.com"
                  autocomplete="email"
                />
                <span v-if="form.errors.email" class="field-error">
                  {{ form.errors.email }}
                </span>
              </div>
            </div>

            <!-- Asunto -->
            <div class="field">
              <label class="field-label" for="subject">Asunto</label>
              <input
                id="subject"
                v-model="form.subject"
                type="text"
                class="field-input"
                :class="{ 'field-input--error': form.errors.subject }"
                placeholder="¿De qué se trata?"
              />
              <span v-if="form.errors.subject" class="field-error">
                {{ form.errors.subject }}
              </span>
            </div>

            <!-- Mensaje -->
            <div class="field">
              <label class="field-label" for="message">Mensaje</label>
              <textarea
                id="message"
                v-model="form.message"
                class="field-input field-textarea"
                :class="{ 'field-input--error': form.errors.message }"
                placeholder="Contame tu proyecto o consulta..."
                rows="5"
              />
              <span v-if="form.errors.message" class="field-error">
                {{ form.errors.message }}
              </span>
            </div>

            <!-- Submit -->
            <button
              type="submit"
              class="btn-submit"
              :disabled="form.processing"
            >
              <span v-if="form.processing" class="spinner" />
              <span>{{ form.processing ? 'Enviando...' : 'Enviar mensaje' }}</span>
              <svg v-if="!form.processing" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>

          </form>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name:    '',
  email:   '',
  subject: '',
  message: '',
})

function submit() {
  form.post('/contacto', {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap');

.contact {
  padding: 4rem 2rem;
  background: #f5f4f2;
  border-top: 1px solid #ece9e4;
}

.contact-inner {
  max-width: 1080px;
  margin: 0 auto;
}

/* ── Encabezado ── */
.contact-header { margin-bottom: 3.5rem; }

.section-label {
  font-family: 'DM Sans', sans-serif;
  font-size: 12px;
  font-weight: 500;
  color: #9c9a93;
  letter-spacing: .1em;
  text-transform: uppercase;
  margin-bottom: 10px;
}

.section-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 700;
  color: #1a1a18;
  letter-spacing: -.02em;
  margin-bottom: 12px;
}

.section-sub {
  font-family: 'DM Sans', sans-serif;
  font-size: .95rem;
  color: #78766f;
  max-width: 480px;
  line-height: 1.7;
}

/* ── Layout dos columnas ── */
.contact-layout {
  display: grid;
  grid-template-columns: 260px 1fr;
  gap: 4rem;
  align-items: start;
}

/* ── Info lateral ── */
.contact-info {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  padding-top: 4px;
}

.info-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
}

.info-icon {
  width: 34px;
  height: 34px;
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #78766f;
  flex-shrink: 0;
  margin-top: 2px;
}

.info-label {
  font-family: 'DM Sans', sans-serif;
  font-size: 11px;
  font-weight: 500;
  color: #9c9a93;
  letter-spacing: .06em;
  text-transform: uppercase;
  margin-bottom: 3px;
}

.info-value {
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  color: #4a4a45;
  text-decoration: none;
  transition: color .18s;
}

.info-value:hover { color: #1a1a18; }

/* ── Formulario ── */
.form-wrap {
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 14px;
  padding: 2rem;
}

form {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}

/* ── Campos ── */
.field {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.field-label {
  font-family: 'DM Sans', sans-serif;
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

.field-input::placeholder { color: #b0ada6; }

.field-input:focus {
  border-color: #1a1a18;
  box-shadow: 0 0 0 3px rgba(26,26,24,.06);
}

.field-input--error {
  border-color: #e55050;
}

.field-input--error:focus {
  box-shadow: 0 0 0 3px rgba(229,80,80,.08);
}

.field-textarea {
  resize: vertical;
  min-height: 130px;
}

.field-error {
  font-family: 'DM Sans', sans-serif;
  font-size: 12px;
  color: #e55050;
}

/* ── Botón ── */
.btn-submit {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px 28px;
  background: #1a1a18;
  color: #fafaf9;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  font-weight: 500;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background .18s, gap .18s;
  align-self: flex-start;
}

.btn-submit:hover:not(:disabled) {
  background: #333330;
  gap: 12px;
}

.btn-submit:disabled {
  opacity: .6;
  cursor: not-allowed;
}

/* Spinner */
.spinner {
  width: 14px;
  height: 14px;
  border: 2px solid rgba(250,250,249,.3);
  border-top-color: #fafaf9;
  border-radius: 50%;
  animation: spin .7s linear infinite;
  flex-shrink: 0;
}

@keyframes spin { to { transform: rotate(360deg); } }

/* ── Mensaje de éxito ── */
.success-msg {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: 1.25rem;
  background: #edf7f2;
  border: 1px solid #c6e8d6;
  border-radius: 10px;
  color: #3a7d5a;
}

.success-title {
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  font-weight: 500;
  color: #3a7d5a;
  margin-bottom: 3px;
}

.success-sub {
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  color: #5aac82;
}

/* ── Responsive ── */
@media (max-width: 820px) {
  .contact-layout {
    grid-template-columns: 1fr;
    gap: 2.5rem;
  }
  .contact-info {
    flex-direction: row;
    flex-wrap: wrap;
    gap: 1rem;
  }
}

@media (max-width: 500px) {
  .form-row { grid-template-columns: 1fr; }
  .contact-info { flex-direction: column; }
}
</style>