<template>
  <AdminLayout title="Habilidades">
    <div class="page">

      <!-- Header -->
      <div class="page-header">
        <div>
          <h2 class="page-title">Habilidades</h2>
          <!-- <p class="page-sub">{{ projects.length }} proyecto{{ projects.length !== 1 ? 's' : '' }} en total</p> -->
        </div>
        <Link href="/admin/skills/create" class="btn-primary">
          + Nueva habilidad
        </Link>
      </div>

      <!-- Tabla -->
      <div class="table-wrap">
        <table class="table" v-if="skills.length > 0">
          <thead>
            <tr>
              <th>Ícono</th>
              <th>Nombre</th>
              <th>Orden</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="skill in skills" :key="skill.id">

              <!-- Ícono -->
              <td>
                <div class="icon-cell">
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
              </td>

              <!-- Nombre -->
              <td>
                <p class="skill-title">{{ skill.name }}</p>
              </td>

              <!-- Orden -->
              <td class="order-cell">{{ skill.order }}</td>

              <!-- Acciones -->
              <td style="text-align: right; vertical-align: middle;">
                <div class="actions">
                  <Link :href="`/admin/skills/${skill.id}/edit`" class="btn-edit">
                    Editar
                  </Link>
                  <button class="btn-delete" @click="confirmDelete(skill)">
                    Eliminar
                  </button>
                </div>
              </td>

            </tr>
          </tbody>
        </table>

        <!-- Estado vacío -->
        <div v-else class="empty">
          <p>No hay habilidades todavía.</p>
          <Link href="/admin/skills/create" class="btn-primary">
            Crear la primera
          </Link>
        </div>
      </div>


    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Swal from 'sweetalert2'

const props = defineProps({
  skills: { type: Array, default: () => [] },
})


function truncate(text, length = 60) {
  return text.length > length ? text.slice(0, length) + '...' : text
}

async function confirmDelete(skill) {
  const result = await Swal.fire({
    title: '¿Eliminar habilidad?',
    text: `"${skill.name}" se eliminará permanentemente.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar',
    confirmButtonColor: '#e3342f',
  })

  if (result.isConfirmed) {
    router.delete(`/admin/skills/${skill.id}`, {
      onSuccess: () => {
        Swal.fire({
          title: '¡Eliminado!',
          text: 'La habilidad fue eliminada correctamente.',
          icon: 'success',
          confirmButtonText: 'Aceptar'
        })
      },
      onError: () => {
        Swal.fire({
          title: 'Error',
          text: 'No se pudo eliminar la habilidad.',
          icon: 'error',
          confirmButtonText: 'Aceptar'
        })
      }
    })
  }
}

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap');

.page { font-family: 'DM Sans', sans-serif; }

.page-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  margin-bottom: 1.5rem;
  gap: 1rem;
  flex-wrap: wrap;
}

.page-title {
  font-size: 18px;
  font-weight: 500;
  color: #1a1a18;
  margin-bottom: 3px;
}

.page-sub { font-size: 13px; color: #9c9a93; }

.btn-primary {
  display: inline-flex;
  align-items: center;
  padding: 9px 18px;
  background: #1a1a18;
  color: #fafaf9;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 500;
  border-radius: 7px;
  text-decoration: none;
  transition: background .18s;
  white-space: nowrap;
}

.btn-primary:hover { background: #333330; }

/* Tabla */
.table-wrap {
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 12px;
  overflow: hidden;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table thead tr {
  border-bottom: 1px solid #ece9e4;
}

.table th {
  padding: 11px 16px;
  text-align: left;
  font-size: 11px;
  font-weight: 500;
  color: #9c9a93;
  letter-spacing: .06em;
  text-transform: uppercase;
}

.table th:nth-child(3) {
  text-align: left;
}

.table th:last-child {
  text-align: right;
}

.table td {
  padding: 14px 16px;
  border-bottom: 1px solid #f5f4f2;
  vertical-align: middle;
}

.table tbody tr:last-child td { border-bottom: none; }
.table tbody tr:hover td { background: #fdfcfb; }


.skill-cell {
  display: flex;
  align-items: center;
  gap: 12px;
}

.skill-thumb {
  width: 48px;
  height: 36px;
  border-radius: 6px;
  overflow: hidden;
  background: #f0efed;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.thumb-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.thumb-placeholder {
  font-size: 16px;
  font-weight: 600;
  color: #c0bdb5;
}

.skill-icon-img {
  width: 36px;
  height: 36px;
  object-fit: contain;
  border-radius: 6px;
}

.skill-title {
  font-size: 13px;
  font-weight: 500;
  color: #1a1a18;
  margin-bottom: 2px;
}

.skill-desc { font-size: 12px; color: #9c9a93; }


/* Orden */
.order-cell {
  font-size: 13px;
  color: #9c9a93;
  text-align: left;
  vertical-align: middle;
}

/* Acciones */
.actions {
  display: flex;
  gap: 6px;
  align-items: center;
  justify-content: flex-end;
}

.btn-edit {
  font-size: 12px;
  font-family: 'DM Sans', sans-serif;
  padding: 5px 12px;
  border-radius: 6px;
  background: #f0efed;
  color: #4a4a45;
  text-decoration: none;
  transition: background .15s;
}

.btn-edit:hover { background: #e5e5e3; }

.btn-delete {
  font-size: 12px;
  font-family: 'DM Sans', sans-serif;
  padding: 5px 12px;
  border-radius: 6px;
  background: transparent;
  color: #e55050;
  border: 1px solid #fce8e8;
  cursor: pointer;
  transition: background .15s;
}

.btn-delete:hover { background: #fff0f0; }

/* Estado vacío */
.empty {
  padding: 4rem;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}

.empty p { font-size: 14px; color: #9c9a93; }

/* Modal */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.3);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 100;
  padding: 1rem;
}

.modal {
  background: #fafaf9;
  border: 1px solid #ece9e4;
  border-radius: 14px;
  padding: 2rem;
  max-width: 400px;
  width: 100%;
}

.modal-title {
  font-size: 16px;
  font-weight: 500;
  color: #1a1a18;
  margin-bottom: 8px;
}

.modal-text {
  font-size: 14px;
  color: #78766f;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

.modal-actions {
  display: flex;
  justify-content: flex-end;
  gap: 8px;
}

.btn-ghost {
  padding: 8px 18px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  background: transparent;
  border: 1px solid #e5e5e3;
  border-radius: 7px;
  color: #78766f;
  cursor: pointer;
  transition: border-color .15s;
}

.btn-ghost:hover { border-color: #b0ada6; }

.btn-danger {
  padding: 8px 18px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  background: #e55050;
  border: none;
  border-radius: 7px;
  color: #fff;
  cursor: pointer;
  transition: background .15s;
}

.btn-danger:hover { background: #cc3c3c; }
</style>