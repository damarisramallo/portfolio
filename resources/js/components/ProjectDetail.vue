<template>

  <div class="project-detail">
    <div class="detail-header">
      <Link href="/" class="back-link">← Volver al portfolio</Link>
      <h1 class="detail-title">{{ project.title }}</h1>

    </div>

    <!-- Video embed -->
    <div v-if="embedUrl" class="video-wrap">
      <iframe
        :src="embedUrl"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        class="project-video"
      />
    </div>

    <div class="detail-content">
      <h2 class="detail-title">Descripción</h2>
      <div v-if="project.description" class="detail-description">
        <template v-for="(block, i) in descriptionBlocks" :key="i">
          <p v-if="block.type === 'text'">{{ block.content }}</p>
          <ul v-else-if="block.type === 'list'">
            <li v-for="(item, j) in block.items" :key="j">{{ item }}</li>
          </ul>
        </template>
      </div>

      <div v-if="project.tags?.length" class="detail-tags">
        <span v-for="tag in project.tags" :key="tag" class="tag">
          {{ tag }}
        </span>
      </div>

      <!-- Botones -->
      <div class="detail-actions">
        <a
          v-if="project.url"
          :href="project.url"
          target="_blank"
          rel="noopener noreferrer"
          class="btn-primary"
        >
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
          </svg>
          Ver repositorio
        </a>
      </div>
    </div>
    

    <!-- Imagen fallback si no hay video -->
    <!-- <div v-else-if="project.image" class="detail-image-wrap">
      <img
        :src="`/storage/${project.image}`"
        :alt="project.title"
        class="detail-image"
      />
    </div> -->

  </div>
</template>

<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  project: Object
})

const embedUrl = computed(() => {
  if (!props.project.youtube_url) return null

  try {
    const url = new URL(props.project.youtube_url)
    let id = null

    if (url.hostname === 'youtu.be') {
      
      id = url.pathname.slice(1)
    } else {
      id = url.searchParams.get('v')
    }

    if (!id) return null

    const embed = new URL(`https://www.youtube.com/embed/${id}`)
    embed.searchParams.set('origin', window.location.origin)

    return embed.toString()
  } catch {
    return null
  }
})

const descriptionBlocks = computed(() => {
  if (!props.project.description) return []  

  const blocks = []
  let currentList = null

  for (const line of props.project.description.split(/\r?\n/)) { 
    const trimmed = line.trim()
    if (!trimmed) continue

    if (trimmed.startsWith('- ')) {
      if (!currentList) {
        currentList = { type: 'list', items: [] }
        blocks.push(currentList)
      }
      currentList.items.push(trimmed.slice(2))
    } else {
      currentList = null
      blocks.push({ type: 'text', content: trimmed })
    }
  }

  return blocks
})
</script>

<style scoped>
.project-detail {
  max-width: 900px;
  margin: 5rem auto;
  padding: 2rem;
  background: #ffffff;
  box-shadow: 0 0 40px rgba(0,0,0,0.15);
}

.back-link {
  display: inline-block;
  margin-bottom: 1.5rem;
  color: var(--color-primary);
  text-decoration: none;
}

.detail-title {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.detail-content {
  margin-bottom: 1rem;
  margin-top: 1rem;
}

.detail-description {
  color: var(--color-muted);
  margin-bottom: 1.5rem;
  line-height: 1.6;
}

.detail-description ul {
  list-style: disc;
  padding-left: 1.5rem;
  margin-bottom: 1rem;
}

.detail-description li {
  margin-bottom: 0.25rem;
}

.detail-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

.tag {
  background: rgb(207, 207, 207);
  padding: 0.25rem 0.75rem;
  border-radius: 999px;
  font-size: 0.85rem;
}

.detail-actions {
  display: flex;
  gap: 1rem;
  margin-top: 1.5rem;
}

.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.6rem 1.25rem;
  background: #1a1a18;
  color: #fafaf9;
  border-radius: 8px;
  text-decoration: none;
  font-size: 0.9rem;
  transition: opacity 0.2s;
}

.btn-primary:hover { opacity: 0.85; }

.video-wrap {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;
  margin-top: 2rem;
}

.project-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 8px;
}

.detail-image-wrap { margin-top: 2rem; }

.detail-image {
  width: 100%;
  border-radius: 8px;
}
</style>