<template>
  <AdminLayout title="Resumen">
    <div class="page">

      <div class="page-header">
        <h2 class="page-title">Resumen</h2>
        <p class="page-sub">Un vistazo rápido a tu portfolio.</p>
      </div>

      <!-- Stats -->
      <div class="stats-grid">

        <div class="stat-card">
          <div class="stat-icon stat-icon--projects">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
            </svg>
          </div>
          <div class="stat-info">
            <p class="stat-value">{{ stats.projects }}</p>
            <p class="stat-label">Proyectos</p>
          </div>
          <div class="stat-breakdown">
            <span class="breakdown-item breakdown-item--green">{{ stats.projects_visible }} visibles</span>
            <span class="breakdown-item breakdown-item--yellow">{{ stats.projects_dev }} en desarrollo</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon stat-icon--skills">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
            </svg>
          </div>
          <div class="stat-info">
            <p class="stat-value">{{ stats.skills }}</p>
            <p class="stat-label">Habilidades</p>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon stat-icon--messages">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
            </svg>
          </div>
          <div class="stat-info">
            <p class="stat-value">{{ stats.messages }}</p>
            <p class="stat-label">Mensajes</p>
          </div>
          <div class="stat-breakdown">
            <span v-if="stats.messages_today > 0" class="breakdown-item breakdown-item--green">
              {{ stats.messages_today }} hoy
            </span>
            <span v-else class="breakdown-item">Sin mensajes hoy</span>
          </div>
        </div>

      </div>

      <!-- Accesos rápidos -->
      <div class="quick-section">
        <p class="quick-title">Accesos rápidos</p>
        <div class="quick-grid">
          <Link href="/admin/projects/create" class="quick-card">
            <span class="quick-label">+ Nuevo proyecto</span>
          </Link>
          <Link href="/admin/skills/create" class="quick-card">
            <span class="quick-label">+ Nueva habilidad</span>
          </Link>
          <Link href="/admin/contacts" class="quick-card">
            <span class="quick-label">Ver mensajes</span>
          </Link>
          <Link href="/admin/about" class="quick-card">
            <span class="quick-label">Editar perfil</span>
          </Link>
        </div>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({
  stats: { type: Object, default: () => ({}) }
})
</script>

<style scoped>
.page { font-family: 'DM Sans', sans-serif; }

.page-header { margin-bottom: 2rem; }

.page-title {
  font-size: 18px;
  font-weight: 500;
  color: #1a1a18;
  margin-bottom: 3px;
}

.page-sub { font-size: 13px; color: #9c9a93; }

/* ── Stats ── */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
  margin-bottom: 2.5rem;
}

.stat-card {
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 12px;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.stat-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.stat-icon--projects { background: #edf7f2; color: #3a7d5a; }
.stat-icon--skills   { background: #eff6ff; color: #3b82f6; }
.stat-icon--messages { background: #fef9ec; color: #d97706; }

.stat-value {
  font-size: 2rem;
  font-weight: 600;
  color: #1a1a18;
  line-height: 1;
  margin-bottom: 4px;
}

.stat-label {
  font-size: 13px;
  color: #9c9a93;
}

.stat-breakdown {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
}

.breakdown-item {
  font-size: 11px;
  padding: 3px 8px;
  border-radius: 20px;
  background: #f5f4f2;
  color: #9c9a93;
}

.breakdown-item--green  { background: #edf7f2; color: #3a7d5a; }
.breakdown-item--yellow { background: #fef9ec; color: #d97706; }

/* ── Accesos rápidos ── */
.quick-section { }

.quick-title {
  font-size: 12px;
  font-weight: 500;
  color: #9c9a93;
  letter-spacing: .08em;
  text-transform: uppercase;
  margin-bottom: 12px;
}

.quick-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1rem;
}

.quick-card {
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 10px;
  padding: 1rem 1.25rem;
  text-decoration: none;
  transition: border-color .18s, box-shadow .18s;
  display: flex;
  align-items: center;
}

.quick-card:hover {
  border-color: #d6d3cc;
  box-shadow: 0 2px 8px rgba(0,0,0,.05);
}

.quick-label {
  font-size: 13px;
  font-weight: 500;
  color: #1a1a18;
}

/* ── Responsive ── */
@media (max-width: 768px) {
  .stats-grid { grid-template-columns: 1fr; }
  .quick-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>