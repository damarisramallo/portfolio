<template>
  <section class="projects">
    <div class="projects-inner">

      <!-- Encabezado -->
      <div class="projects-header">
        <p class="section-label">Lo que construí</p>
        <h2 class="section-title">Proyectos</h2>
        <p class="section-sub">
          Una selección de proyectos en los que trabajé.
        </p>
      </div>

      <!-- Grilla -->
      <div class="projects-grid">
        <TransitionGroup name="card" tag="div" class="grid-inner">
          <component
            v-for="project in projects"
            :key="project.slug"
            class="project-card"
            :style="{ cursor: project.in_development ? 'default' : 'pointer' }"
            @click="!project.in_development && goToProject(project.slug)"
          >
          <!-- Imagen -->
          <div class="card-image-wrap">
              <img
                v-if="project.image"
                :src="`/storage/${project.image}`"
                :alt="project.title"
                class="card-image"
              />
              <div v-else class="card-placeholder">
                <span class="placeholder-letter">{{ project.title[0] }}</span>
              </div>

              <!-- Badge en desarrollo -->
              <div v-if="project.in_development" class="dev-badge">
                <span class="dev-dot"></span>
                En desarrollo
              </div>
          </div>

          <!-- Contenido -->
          <div class="card-body">
            <div class="card-tags">
              <span v-for="tag in project.tags" :key="tag" class="card-tag">
                {{ tag }}
              </span>
            </div>
            <h3 class="card-title">{{ project.title }}</h3>
            <p class="card-desc">{{ project.excerpt }}</p>
          </div>
          </component>
        </TransitionGroup>
    
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'


const props = defineProps({
  projects: {
    type: Array,
    default: () => [],
  },
})

function goToProject(slug) {
  router.visit(`/projects/${slug}`)
}

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap');

.projects {
  padding: 4rem 2rem 9rem;
  background: #fafaf9;
}

.projects-inner {
  max-width: 1080px;
  margin: 0 auto;
}

/* ── Encabezado ── */
.projects-header { margin-bottom: 2.5rem; }

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
  max-width: 440px;
}

/* ── Filtros ── */
.filters {
  display: flex;
  flex-wrap: wrap;
  gap: 7px;
  margin-bottom: 2.5rem;
}

.filter-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 14px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  color: #78766f;
  background: transparent;
  border: 1px solid #e5e5e3;
  border-radius: 20px;
  cursor: pointer;
  transition: all .18s;
}

.filter-btn:hover {
  border-color: #b0ada6;
  color: #1a1a18;
}

.filter-btn--active {
  background: #1a1a18;
  border-color: #1a1a18;
  color: #fafaf9;
}

.filter-count {
  font-size: 11px;
  opacity: .6;
}

/* ── Grilla ── */
.projects-grid { position: relative; }

.grid-inner {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
}

/* ── Card ── */
.project-card {
  background: #fff;
  border: 1px solid #ece9e4;
  border-radius: 12px;
  overflow: hidden;
  transition: border-color .18s, box-shadow .18s, transform .18s;
  display: block;
  text-decoration: none;
  color: inherit;
}

.project-card:hover {
  border-color: #d6d3cc;
  box-shadow: 0 4px 20px rgba(0,0,0,.07);
  transform: translateY(-2px);
}

/* ── Imagen ── */
.card-image-wrap {
  aspect-ratio: 16 / 9;
  overflow: hidden;
  background: #f0efed;
  position: relative;
}

.card-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .3s ease;
}

.project-card:hover .card-image { transform: scale(1.03); }

.card-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #f0efed, #e5e5e3);
}

.placeholder-letter {
  font-family: 'Playfair Display', serif;
  font-size: 3rem;
  font-weight: 700;
  color: #c0bdb5;
}

/* ── Overlay GitHub ── */
.github-overlay {
  position: absolute;
  inset: 0;
  background: rgba(20, 20, 18, 0.82);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity .22s ease;
  backdrop-filter: blur(2px);
}

.project-card:hover .github-overlay {
  opacity: 1;
}

.github-overlay-inner {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  color: #fafaf9;
  transform: translateY(6px);
  transition: transform .22s ease;
}

.project-card:hover .github-overlay-inner {
  transform: translateY(0);
}

.github-icon {
  width: 28px;
  height: 28px;
}

.github-overlay-inner span {
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 500;
  letter-spacing: .04em;
}

/* ── Badge en desarrollo ── */
.dev-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 4px 10px;
  background: rgba(255, 255, 255, 0.92);
  border: 1px solid #e5e5e3;
  border-radius: 20px;
  font-family: 'DM Sans', sans-serif;
  font-size: 11px;
  font-weight: 500;
  color: #78766f;
  backdrop-filter: blur(4px);
}

.dev-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #f59e0b;
  animation: pulse-dot 1.8s ease-in-out infinite;
}

@keyframes pulse-dot {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: .5; transform: scale(.75); }
}

/* ── Cuerpo ── */
.card-body {
  padding: 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

/* ── Tags ── */
.card-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
}

.card-tag {
  font-family: 'DM Sans', sans-serif;
  font-size: 11px;
  color: #78766f;
  background: #f5f4f2;
  border: 1px solid #e5e5e3;
  border-radius: 4px;
  padding: 2px 8px;
}

.card-title {
  font-family: 'DM Sans', sans-serif;
  font-size: 15px;
  font-weight: 500;
  color: #1a1a18;
  margin-top: 2px;
}

.card-desc {
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  color: #78766f;
  line-height: 1.65;
}

/* ── Estado vacío ── */
.empty {
  padding: 4rem 0;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}

.empty p {
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  color: #9c9a93;
}

/* ── Transición al filtrar ── */
.card-enter-active,
.card-leave-active { transition: opacity .2s ease, transform .2s ease; }
.card-enter-from   { opacity: 0; transform: translateY(8px); }
.card-leave-to     { opacity: 0; }
.card-leave-active { position: absolute; }

/* ── Responsive ── */
@media (max-width: 900px) { .grid-inner { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .grid-inner { grid-template-columns: 1fr; } }
</style>