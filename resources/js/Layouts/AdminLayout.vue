<template>
  <div class="admin-layout">

    <!-- Sidebar (componente separado) -->
    <Sidebar :open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Overlay mobile -->
    <div
      v-if="sidebarOpen"
      class="sidebar-overlay"
      @click="sidebarOpen = false"
    />

    <!-- CONTENIDO PRINCIPAL -->
    <div class="admin-main">

      <!-- Topbar -->
      <header class="topbar">
        <button class="topbar-burger" @click="sidebarOpen = true">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
          </svg>
        </button>
        <h1 class="topbar-title">{{ title }}</h1>
        <Link href="/" class="topbar-link" target="_blank">
          Ver portfolio →
        </Link>
      </header>

      <!-- Contenido de cada página admin -->
      <main class="admin-content">
        <slot />
      </main>

    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import Sidebar from '@/Components/Admin/Sidebar.vue'

defineProps({
  title: { type: String, default: 'Dashboard' },
})

const sidebarOpen = ref(false)
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap');

.admin-layout {
  display: flex;
  min-height: 100vh;
  background: #f5f4f2;
  font-family: 'DM Sans', sans-serif;
}

.admin-main {
  flex: 1;
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.topbar {
  background: #fafaf9;
  border-bottom: 1px solid #ece9e4;
  padding: 0 2rem;
  height: 56px;
  display: flex;
  align-items: center;
  gap: 1rem;
  position: sticky;
  top: 0;
  z-index: 10;
}

.topbar-burger {
  display: none;
  background: none;
  border: none;
  cursor: pointer;
  color: #78766f;
  padding: 4px;
}

.topbar-title {
  font-size: 14px;
  font-weight: 500;
  color: #1a1a18;
  flex: 1;
}

.topbar-link {
  font-size: 12px;
  color: #9c9a93;
  text-decoration: none;
  transition: color .18s;
}

.topbar-link:hover { color: #1a1a18; }

.admin-content {
  flex: 1;
  padding: 2rem;
}

.sidebar-overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.3);
  z-index: 40;
}

@media (max-width: 768px) {
  .topbar-burger  { display: flex; }
  .sidebar-overlay { display: block; }
  .admin-content  { padding: 1.25rem; }
}
</style>