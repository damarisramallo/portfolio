<template>
  <section class="hero">
    <div class="hero-inner">

      <div class="hero-photo-wrap">
        <div class="hero-photo-ring">
          <img
            v-if="photo"
            :src="photo"
            :alt="name"
            class="hero-photo"
          />
          <div v-else class="hero-initials">
            {{ initials }}
          </div>
        </div>
        <span class="hero-badge">Disponible para trabajar</span>
      </div>

      <div class="hero-content">
        <p class="hero-label">Hola, soy</p>

        <h1 class="hero-name">{{ name }}</h1>

        <p class="hero-role">
          Analista de Sistemas
          <br />
          <span class="hero-role-muted">&amp;</span>
          Desarrolladora Fullstack
        </p>

        <p class="hero-bio">{{ bio }}</p>

        <div class="hero-actions">
          <a 
          class="btn-primary"
          @click.prevent="scrollTo('proyectos')"
          >Ver proyectos</a>
        </div>

      </div>

    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  name:  { type: String, default: 'Damaris' },
  bio:   {
    type: String,
    default: 'Diseño y construyo aplicaciones web completas — desde el análisis y la arquitectura hasta la interfaz final. Me enfoco en código limpio, buena experiencia de usuario y soluciones que escalan.',
  },
  photo: { type: String, default: null },
  stack: {
    type: Array,
    default: () => ['Laravel', 'Vue 3', 'Inertia.js', 'Tailwind', 'MySQL', 'PHP'],
  },
})

const initials = computed(() =>
  props.name
    .split(' ')
    .map(w => w[0])
    .slice(0, 2)
    .join('')
    .toUpperCase()
)

function scrollTo(id) {
  const el = document.getElementById(id)
  if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap');

.hero {
  min-height: 90vh;
  background: #fafaf9;
  display: flex;
  align-items: center;
  padding: 1rem 2rem;
}

.hero-inner {
  max-width: 1080px;
  margin: 0 auto;
  width: 100%;
  display: grid;
  grid-template-columns: auto 1fr;
  align-items: center;
  gap: 6rem;
}

/* ── Foto ── */
.hero-photo-wrap {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
  animation: fadeIn .6s ease both;
}

.hero-photo-ring {
  width: 200px;
  height: 200px;
  border-radius: 50%;
  border: 1.5px solid #e5e5e3;
  overflow: hidden;
  background: #f0efed;
}

.hero-photo {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.hero-initials {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Playfair Display', serif;
  font-size: 3.5rem;
  font-weight: 700;
  color: #1a1a18;
}

.hero-badge {
  font-family: 'DM Sans', sans-serif;
  font-size: 11px;
  font-weight: 500;
  color: #3a7d5a;
  background: #edf7f2;
  border: 1px solid #c6e8d6;
  border-radius: 20px;
  padding: 4px 12px;
  letter-spacing: .02em;
  white-space: nowrap;
}

/* ── Contenido ── */
.hero-content {
  animation: fadeIn .6s .12s ease both;
}

.hero-label {
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 400;
  color: #9c9a93;
  letter-spacing: .08em;
  text-transform: uppercase;
  margin-bottom: 12px;
}

.hero-name {
  font-family: 'Playfair Display', serif;
  font-size: clamp(3rem, 6vw, 5.5rem);
  font-weight: 900;
  color: #1a1a18;
  line-height: 1;
  letter-spacing: -.03em;
  margin-bottom: 16px;
}

.hero-role {
  font-family: 'DM Sans', sans-serif;
  font-size: clamp(1.1rem, 2vw, 1.35rem);
  font-weight: 300;
  color: #4a4a45;
  line-height: 1.4;
  margin-bottom: 28px;
}

.hero-role-muted {
  color: #c0bdb5;
  font-weight: 300;
}

.hero-bio {
  font-family: 'DM Sans', sans-serif;
  font-size: .975rem;
  font-weight: 400;
  color: #78766f;
  line-height: 1.8;
  max-width: 500px;
  margin-bottom: 20px;
}

/* ── Botones ── */
.hero-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 40px;
}

.btn-primary {
  display: inline-block;
  padding: 11px 26px;
  background: #1a1a18;
  color: #fafaf9;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 500;
  border-radius: 6px;
  text-decoration: none;
  letter-spacing: .02em;
  transition: background .18s;
}

.btn-primary:hover {
  background: #333330;
}

.btn-ghost {
  display: inline-block;
  padding: 11px 26px;
  background: transparent;
  color: #78766f;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 400;
  border: 1px solid #dddbd6;
  border-radius: 6px;
  text-decoration: none;
  letter-spacing: .02em;
  transition: border-color .18s, color .18s;
}

.btn-ghost:hover {
  border-color: #b0ada6;
  color: #4a4a45;
}

/* ── Stack ── */
.hero-stack {
  display: flex;
  flex-wrap: wrap;
  gap: 7px;
}

.hero-tag {
  font-family: 'DM Sans', sans-serif;
  font-size: 12px;
  font-weight: 400;
  color: #9c9a93;
  background: transparent;
  border: 1px solid #e5e5e3;
  border-radius: 4px;
  padding: 4px 10px;
}

/* ── Animación ── */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(14px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ── Responsive ── */
@media (max-width: 720px) {
  .hero-inner {
    grid-template-columns: 1fr;
    gap: 2.5rem;
    text-align: center;
  }
  .hero-photo-wrap { margin: 0 auto; }
  .hero-bio        { margin-inline: auto; }
  .hero-actions    { justify-content: center; }
  .hero-stack      { justify-content: center; }
}
</style>