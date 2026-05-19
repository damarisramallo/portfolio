<template>
  <PublicLayout>
    <section id="proyecto">
      <ProjectDetail :project="project" />
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../Layouts/PublicLayout.vue'
import ProjectDetail from '../../components/ProjectDetail.vue'

defineProps({
  project: Object
})
</script>