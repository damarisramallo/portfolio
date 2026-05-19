<template>
  <PublicLayout>
    <section id="sobre-mi">
      <Hero :about="about" />     
    </section>

    <section id="skills">
      <Skills :skills="skills" />
    </section>
    <section id="proyectos">
      <Projects :projects="projects" /> 
    </section>
    <section id="contacto">
      <Contact />
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../Layouts/PublicLayout.vue'
import Hero from '../../components/Hero.vue'
import Skills from '../../components/Skills.vue'
import Projects from '../../components/Projects.vue'
import Contact from '../../components/Contact.vue'

defineProps({
  about: { type: Object, default: () => ({}) },
  skills:   { type: Array, default: () => [] },
  projects: { type: Array, default: () => [] },
})
</script>