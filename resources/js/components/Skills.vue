<template>
  <section class="skills">
    <div class="skills-inner">

      <!-- Encabezado -->
      <div class="skills-header">
        <p class="section-label">Qué sé hacer</p>
        <h2 class="section-title">Habilidades</h2>
        <p class="section-sub">
          Tecnologías y herramientas con las que trabajo a diario.
        </p>
      </div>

      <!-- Grilla de skills -->
      <div class="skills-grid">
        <div
          v-for="skill in skills"
          :key="skill.name"
          class="skill-card"
        >
          <!-- Ícono -->
          <div class="skill-icon">
            <img
              v-if="skill.icon"
              :src="`/storage/${skill.icon}`"
              :alt="skill.name"
              class="skill-icon-img"
            />
            <span v-else class="skill-icon-placeholder">
              {{ skill.name[0] }}
            </span>
          </div>

          <!-- Info -->
          <div class="skill-info">
            <span class="skill-name">{{ skill.name }}</span>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
defineProps({
  skills: {
    type: Array,
    default: () => [],
  },
})

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap');

.skills {
  padding: 4rem 2rem 8rem;
  background: #f5f4f2;
  border-top: 1px solid #ece9e4;
  border-bottom: 1px solid #ece9e4;
}

.skills-inner {
  max-width: 1080px;
  margin: 0 auto;
}

/* ── Encabezado ── */
.skills-header { margin-bottom: 3.5rem; }

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

/* ── Grilla ── */
.skills-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
}

.skill-card {
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 10px;
  padding: 1.25rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 12px;
  transition: border-color .18s, box-shadow .18s;
}

.skill-card:hover {
  border-color: #d2c9b4;
  box-shadow: 0 2px 12px rgba(0,0,0,.05);
}

.skill-icon {
  width: 90px;
  height: 90px;
  flex-shrink: 0;
}

.skill-icon-img {
  width: 90px;
  height: 90px;
  object-fit: contain;
}

.skill-name {
  font-family: 'DM Sans', sans-serif;
  font-size: 15px;
  font-weight: 500;
  color: #1a1a18;
  text-align: center;
}

/* ── Responsive ── */
@media (max-width: 900px)  { .skills-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 640px)  { .skills-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 400px)  { .skills-grid { grid-template-columns: 1fr; } }
</style>