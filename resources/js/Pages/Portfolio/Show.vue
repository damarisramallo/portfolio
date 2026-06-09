<template>
  <Head>
    <title>{{ project.title }} — Damaris Ramallo</title>
    <meta name="description" :content="project.excerpt" />
    <meta property="og:title" :content="project.title" />
    <meta property="og:description" :content="project.excerpt" />
    <meta v-if="project.image" property="og:image" :content="`/storage/${project.image}`" />
  </Head>
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
