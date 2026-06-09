<template>
  <Head>
    <title>Damaris Ramallo — Analista de Sistemas</title>
    <meta name="description" content="Portfolio de Damaris Ramallo, Analista de Sistemas y Desarrolladora Fullstack especializada en Laravel, Vue 3 e Inertia.js." />
    <meta name="keywords" content="desarrolladora fullstack, Laravel, Vue 3, Inertia.js, portfolio" />

    <meta property="og:title" content="Damaris Ramallo — Analista de Sistemas" />
    <meta property="og:description" content="Portfolio de Damaris Ramallo, Analista de Sistemas y Desarrolladora Fullstack." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://damarisramallo.com/" />

  </Head>
  <div class="layout">

    <!-- NAVBAR -->
    <header class="navbar">
      <div class="navbar-inner">

        <!-- Logo -->
        <Link href="/" class="navbar-logo">
          Damaris<span class="logo-dot">.</span>
        </Link>

        <!-- Links desktop -->
        <nav class="navbar-links">
          <a
            v-for="item in navItems"
            :key="item.id"
            :href="`/#${item.id}`"
            class="nav-link"
            :class="{ 'nav-link--active': activeSection === item.id }"
            @click.prevent="navigateTo(item.id)"
          >
            {{ item.label }}
            <span class="nav-indicator" />
          </a>
          <Link v-if="isAdmin" href="/admin/dashboard">
            Dashboard
          </Link>
        </nav>

        <!-- Botón contacto -->
        <a
          href="#contacto"
          class="navbar-cta"
          @click.prevent="scrollTo('contacto')"
        >
          Contacto
        </a>

        <!-- Hamburguesa mobile -->
        <button
          class="navbar-burger"
          @click="mobileOpen = !mobileOpen"
          aria-label="Menú"
        >
          <span class="burger-line" :class="{ 'line-1--open': mobileOpen }" />
          <span class="burger-line" :class="{ 'line-2--open': mobileOpen }" />
          <span class="burger-line" :class="{ 'line-3--open': mobileOpen }" />
        </button>

      </div>

      <!-- Menú mobile -->
      <div class="navbar-mobile" :class="{ 'navbar-mobile--open': mobileOpen }">
        <a
          v-for="item in navItems"
          :key="item.id"
          :href="`#${item.id}`"
          class="mobile-link"
          :class="{ 'mobile-link--active': activeSection === item.id }"
          @click.prevent="scrollTo(item.id); mobileOpen = false"
        >
          {{ item.label }}
        </a>
        <a
          href="#contacto"
          class="mobile-cta"
          @click.prevent="scrollTo('contacto'); mobileOpen = false"
        >
          Contacto
        </a>
      </div>
    </header>

    <!-- CONTENIDO -->
    <main>
      <slot />
    </main>

    <!-- FOOTER -->
    <footer class="footer">
      <div class="footer-inner">
        <span class="footer-name">
          Damaris Ramallo<span class="logo-dot">.</span>
        </span>
        <span class="footer-copy">
          {{ new Date().getFullYear() }} Argentina. Santa Fe. Todos los derechos reservados.
        </span>
      </div>
    </footer>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import { Head, Link, usePage } from '@inertiajs/vue3'

const navItems = [
  { id: 'sobre-mi',  label: 'Sobre mí'    },
  { id: 'skills',    label: 'Habilidades'  },
  { id: 'proyectos', label: 'Proyectos'    },
]

const mobileOpen    = ref(false)
const activeSection = ref('')

const page    = usePage()
const isAdmin = computed(() => page.props.auth?.roles?.includes('admin'))

// Detectar sección activa mientras se hace scroll
function onScroll() {
  for (const item of [...navItems].reverse()) {
    const el = document.getElementById(item.id)
    if (el && window.scrollY >= el.offsetTop - 100) {
      activeSection.value = item.id
      return
    }
  }
  activeSection.value = ''
}

// Scroll suave al hacer clic en los links
function scrollTo(id) {
  const el = document.getElementById(id)
  if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

function navigateTo(id) {
  const isHome = window.location.pathname === '/'

  if (isHome) {
    scrollTo(id)
  } else {
    window.location.assign(`${window.location.origin}/#${id}`)
  }
}

onMounted(()  => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))

onMounted(() => {
  const hash = window.location.hash
  if (hash) {
    const id = hash.replace('#', '')
    setTimeout(() => {
      scrollTo(id)
      history.replaceState(null, '', window.location.pathname)
    }, 100)
  }
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap');

/* ── Layout ── */
.layout {
  min-height: 100vh;
  background: #fafaf9;
  display: flex;
  flex-direction: column;
}

main { flex: 1; }

/* ── Navbar ── */
.navbar {
  background: #fafaf9;
  border-bottom: 1px solid #ece9e4;
}

.navbar-inner {
  max-width: 1080px;
  margin: 0 auto;
  padding: 0 2rem;
  height: 64px;
  display: flex;
  align-items: center;
  gap: 2rem;
}

/* ── Logo ── */
.navbar-logo {
  font-family: 'Playfair Display', serif;
  font-size: 1.25rem;
  font-weight: 700;
  color: #1a1a18;
  text-decoration: none;
  flex-shrink: 0;
}

.logo-dot { color: #3a7d5a; }

/* ── Links ── */
.navbar-links {
  display: flex;
  align-items: center;
  gap: 2px;
  flex: 1;
}

.nav-link {
  position: relative;
  padding: 6px 12px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 400;
  color: #78766f;
  text-decoration: none;
  border-radius: 6px;
  transition: color .18s;
  cursor: pointer;
}

.nav-link:hover { color: #1a1a18; }

.nav-link--active {
  color: #1a1a18;
  font-weight: 500;
}

/* Indicador activo */
.nav-indicator {
  position: absolute;
  bottom: 2px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 2px;
  background: #1a1a18;
  border-radius: 1px;
  transition: width .2s ease;
}

.nav-link--active .nav-indicator { width: 16px; }

/* ── Botón CTA ── */
.navbar-cta {
  flex-shrink: 0;
  padding: 8px 20px;
  background: #1a1a18;
  color: #fafaf9;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 500;
  border-radius: 6px;
  text-decoration: none;
  transition: background .18s;
  cursor: pointer;
}

.navbar-cta:hover { background: #333330; }

/* ── Hamburguesa ── */
.navbar-burger {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 4px;
  margin-left: auto;
}

.burger-line {
  display: block;
  width: 22px;
  height: 1.5px;
  background: #1a1a18;
  border-radius: 1px;
  transition: transform .2s, opacity .2s;
  transform-origin: center;
}

.line-1--open { transform: translateY(6.5px) rotate(45deg); }
.line-2--open { opacity: 0; }
.line-3--open { transform: translateY(-6.5px) rotate(-45deg); }

/* ── Menú mobile ── */
.navbar-mobile {
  display: none;
  flex-direction: column;
  gap: 2px;
  padding: 0 1.5rem;
  overflow: hidden;
  max-height: 0;
  transition: max-height .25s ease, padding .25s ease;
  border-top: 1px solid transparent;
}

.navbar-mobile--open {
  max-height: 300px;
  padding: 10px 1.5rem 16px;
  border-top-color: #ece9e4;
}

.mobile-link {
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  color: #78766f;
  text-decoration: none;
  padding: 8px 10px;
  border-radius: 6px;
  transition: background .15s, color .15s;
}

.mobile-link:hover,
.mobile-link--active {
  background: #f0efed;
  color: #1a1a18;
}

.mobile-cta {
  margin-top: 8px;
  padding: 10px;
  background: #1a1a18;
  color: #fafaf9;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  text-align: center;
  border-radius: 6px;
  text-decoration: none;
}

/* ── Footer ── */
.footer {
  border-top: 1px solid #ece9e4;
  padding: 2rem;
}

.footer-inner {
  max-width: 1080px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 8px;
}

.footer-name {
  font-family: 'Playfair Display', serif;
  font-size: 1rem;
  font-weight: 700;
  color: #1a1a18;
}

.footer-copy {
  font-family: 'DM Sans', sans-serif;
  font-size: 12px;
  color: #b0ada6;
}

/* ── Responsive ── */
@media (max-width: 680px) {
  .navbar-links,
  .navbar-cta    { display: none; }
  .navbar-burger { display: flex; }
  .navbar-mobile { display: flex; }
}
</style>