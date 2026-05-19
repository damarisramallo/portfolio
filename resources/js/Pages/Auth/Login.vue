<template>
  <div class="login-page">
    <div class="login-card">

      <div class="login-header">
        <h1 class="login-title">Damaris<span class="dot">.</span></h1>
        <p class="login-sub">Acceso al dashboard</p>
      </div>

      <form @submit.prevent="submit">

        <div class="field">
          <label class="field-label" for="email">Email</label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            class="field-input"
            :class="{ 'field-input--error': form.errors.email }"
            placeholder="admin@portfolio.com"
            autocomplete="email"
          />
          <span v-if="form.errors.email" class="field-error">
            {{ form.errors.email }}
          </span>
        </div>

        <div class="field">
          <label class="field-label" for="password">Contraseña</label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            class="field-input"
            :class="{ 'field-input--error': form.errors.password }"
            placeholder="••••••••"
            autocomplete="current-password"
          />
          <span v-if="form.errors.password" class="field-error">
            {{ form.errors.password }}
          </span>
        </div>

        <div class="remember">
          <input
            id="remember"
            v-model="form.remember"
            type="checkbox"
            class="remember-check"
          />
          <label for="remember" class="remember-label">
            Recordarme
          </label>
        </div>

        <button
          type="submit"
          class="btn-submit"
          :disabled="form.processing"
        >
          <span v-if="form.processing" class="spinner" />
          {{ form.processing ? 'Ingresando...' : 'Ingresar' }}
        </button>

      </form>

      <div class="login-back">
        <Link href="/" class="back-link">← Volver al portfolio</Link>
      </div>

    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
  email:    '',
  password: '',
  remember: false,
})

function submit() {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  })
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap');

.login-page {
  min-height: 100vh;
  background: #f5f4f2;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.login-card {
  width: 100%;
  max-width: 400px;
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 16px;
  padding: 2.5rem;
}

.login-header { margin-bottom: 2rem; }

.login-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.75rem;
  font-weight: 700;
  color: #1a1a18;
  margin-bottom: 4px;
}

.dot { color: #3a7d5a; }

.login-sub {
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  color: #9c9a93;
}

form {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.field { display: flex; flex-direction: column; gap: 6px; }

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

.field-input:focus {
  border-color: #1a1a18;
  box-shadow: 0 0 0 3px rgba(26,26,24,.06);
}

.field-input--error { border-color: #e55050; }

.field-error {
  font-family: 'DM Sans', sans-serif;
  font-size: 12px;
  color: #e55050;
}

.remember {
  display: flex;
  align-items: center;
  gap: 8px;
}

.remember-check { cursor: pointer; }

.remember-label {
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  color: #78766f;
  cursor: pointer;
}

.btn-submit {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 11px;
  background: #1a1a18;
  color: #fafaf9;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  font-weight: 500;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background .18s;
  margin-top: 4px;
}

.btn-submit:hover:not(:disabled) { background: #333330; }
.btn-submit:disabled { opacity: .6; cursor: not-allowed; }

.spinner {
  width: 14px;
  height: 14px;
  border: 2px solid rgba(250,250,249,.3);
  border-top-color: #fafaf9;
  border-radius: 50%;
  animation: spin .7s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

.login-back { margin-top: 1.5rem; text-align: center; }

.back-link {
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  color: #9c9a93;
  text-decoration: none;
  transition: color .18s;
}

.back-link:hover { color: #1a1a18; }
</style>