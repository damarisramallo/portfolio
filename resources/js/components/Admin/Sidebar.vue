<template>
  <aside class="sidebar" :class="{ 'sidebar--open': open }">

    <!-- Logo -->
    <div class="sidebar-logo">
      <Link href="/" class="logo-text">
        Damaris<span class="logo-dot">.</span>
      </Link>
      <button class="sidebar-close" @click="$emit('close')">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <!-- Usuario -->
    <div class="sidebar-user">
      <div class="user-avatar">{{ initials }}</div>
      <div class="user-info">
        <p class="user-name">{{ page.props.auth.user?.name }}</p>
        <p class="user-role">Administrador</p>
      </div>
    </div>

    <div class="sidebar-divider" />

    <!-- Navegación -->
    <nav class="sidebar-nav">
      <p class="nav-group-label">General</p>

      <Link
        href="/admin/dashboard"
        class="nav-item"
        :class="{ 'nav-item--active': active('/admin/dashboard') }"
      >
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
          <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
        </svg>
        Resumen
      </Link>

      <p class="nav-group-label" style="margin-top:12px">Contenido</p>

      <Link
        href="/admin/projects"
        class="nav-item"
        :class="{ 'nav-item--active': active('/admin/projects') }"
      >
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="12 2 2 7 12 12 22 7 12 2"/>
          <polyline points="2 17 12 22 22 17"/>
          <polyline points="2 12 12 17 22 12"/>
        </svg>
        Proyectos
      </Link>

      <Link
        href="/admin/skills"
        class="nav-item"
        :class="{ 'nav-item--active': active('/admin/skills') }"
      >
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="3"/>
          <path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
        </svg>
        Habilidades
      </Link>

      <Link
        href="/admin/contacts"
        class="nav-item"
        :class="{ 'nav-item--active': active('/admin/contacts') }"
      >
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
          <polyline points="22,6 12,13 2,6"/>
        </svg>
        Mensajes
        <span v-if="page.props.unreadMessages > 0" class="nav-badge">
          {{ page.props.unreadMessages }}
        </span>
      </Link>
    </nav>

    <!-- Logout -->
    <div class="sidebar-footer">
      <button class="logout-btn" @click="logout">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
          <polyline points="16 17 21 12 16 7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        Cerrar sesión
      </button>
    </div>

  </aside>
</template>

<script setup>
import { computed } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'

// Props que recibe desde AdminLayout
defineProps({
  open: { type: Boolean, default: false },
})

// Evento que emite para cerrar el sidebar en mobile
defineEmits(['close'])

const page = usePage()

const initials = computed(() => {
  const name = page.props.auth.user?.name || 'A'
  return name.split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase()
})

function active(path) {
  return page.url.startsWith(path)
}

function logout() {
  router.post('/logout')
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap');

.sidebar {
  width: 220px;
  background: #fafaf9;
  border-right: 1px solid #ece9e4;
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  position: sticky;
  top: 0;
  height: 100vh;
  overflow-y: auto;
}

.sidebar-logo {
  padding: 1.25rem 1.25rem 1rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.logo-text {
  font-family: 'Playfair Display', serif;
  font-size: 1.1rem;
  font-weight: 700;
  color: #1a1a18;
  text-decoration: none;
}

.logo-dot { color: #3a7d5a; }

.sidebar-close {
  display: none;
  background: none;
  border: none;
  cursor: pointer;
  color: #78766f;
  padding: 4px;
}

.sidebar-user {
  padding: 0 1.25rem 1rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.user-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #1a1a18;
  color: #fafaf9;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 500;
  flex-shrink: 0;
}

.user-name {
  font-size: 13px;
  font-weight: 500;
  color: #1a1a18;
}

.user-role {
  font-size: 11px;
  color: #9c9a93;
  margin-top: 1px;
}

.sidebar-divider {
  height: 1px;
  background: #ece9e4;
  margin: 0 1.25rem;
}

.sidebar-nav {
  flex: 1;
  padding: 1rem .75rem;
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.nav-group-label {
  font-size: 10px;
  font-weight: 500;
  color: #b0ada6;
  letter-spacing: .08em;
  text-transform: uppercase;
  padding: 0 .5rem;
  margin-bottom: 4px;
  font-family: 'DM Sans', sans-serif;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 8px 10px;
  border-radius: 7px;
  font-size: 13px;
  font-family: 'DM Sans', sans-serif;
  color: #78766f;
  text-decoration: none;
  transition: background .15s, color .15s;
}

.nav-item:hover { background: #f0efed; color: #1a1a18; }

.nav-item--active {
  background: #f0efed;
  color: #1a1a18;
  font-weight: 500;
}

.nav-badge {
  margin-left: auto;
  background: #e55050;
  color: #fff;
  font-size: 10px;
  font-weight: 500;
  padding: 1px 6px;
  border-radius: 10px;
}

.sidebar-footer {
  padding: .75rem;
  border-top: 1px solid #ece9e4;
}

.logout-btn {
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 8px 10px;
  width: 100%;
  border-radius: 7px;
  font-size: 13px;
  font-family: 'DM Sans', sans-serif;
  color: #78766f;
  background: none;
  border: none;
  cursor: pointer;
  transition: background .15s, color .15s;
}

.logout-btn:hover { background: #fff0f0; color: #e55050; }

/* Responsive */
@media (max-width: 768px) {
  .sidebar {
    position: fixed;
    left: -220px;
    top: 0;
    bottom: 0;
    z-index: 50;
    transition: left .25s ease;
  }
  .sidebar--open { left: 0; }
  .sidebar-close { display: flex; }
}
</style>