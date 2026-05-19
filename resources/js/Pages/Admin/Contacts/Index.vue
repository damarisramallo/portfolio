<template>
  <AdminLayout title="Mensajes">
    <div class="page">

      <div class="page-header">
        <div>
          <h2 class="page-title">Mensajes</h2>
          <p class="page-sub">{{ contacts.length }} mensaje{{ contacts.length !== 1 ? 's' : '' }} recibido{{ contacts.length !== 1 ? 's' : '' }}</p>
        </div>
      </div>

      <div class="table-wrap">
        <table class="table" v-if="contacts.length > 0">
          <thead>
            <tr>
              <th>Remitente</th>
              <th>Asunto</th>
              <th>Fecha</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="contact in contacts" :key="contact.id">

              <!-- Remitente -->
              <td>
                <p class="contact-name">{{ contact.name }}</p>
                <p class="contact-email">{{ contact.email }}</p>
              </td>

              <!-- Asunto -->
              <td>
                <p class="contact-subject">{{ contact.subject }}</p>
                <p class="contact-preview">{{ truncate(contact.message) }}</p>
              </td>

              <!-- Fecha -->
              <td class="date-cell">{{ formatDate(contact.created_at) }}</td>

              <!-- Acciones -->
              <td>
                <div class="actions">
                  <button class="btn-delete" @click="confirmDelete(contact)">
                    Eliminar
                  </button>
                </div>
              </td>

            </tr>
          </tbody>
        </table>

        <div v-else class="empty">
          <p>No hay mensajes todavía.</p>
        </div>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Swal from 'sweetalert2'

const props = defineProps({
  contacts: { type: Array, default: () => [] },
})

function truncate(text, length = 80) {
  return text.length > length ? text.slice(0, length) + '...' : text
}

function formatDate(date) {
  return new Date(date).toLocaleDateString('es-AR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  })
}

async function confirmDelete(contact) {
  const result = await Swal.fire({
    title: '¿Eliminar mensaje?',
    text: `El mensaje de "${contact.name}" se eliminará permanentemente.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar',
    confirmButtonColor: '#e3342f',
  })

  if (result.isConfirmed) {
    router.delete(`/admin/contacts/${contact.id}`, {
      onSuccess: () => {
        Swal.fire({
          title: '¡Eliminado!',
          text: 'El mensaje fue eliminado correctamente.',
          icon: 'success',
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
}

.page-title {
  font-size: 18px;
  font-weight: 500;
  color: #1a1a18;
  margin-bottom: 3px;
}

.page-sub { font-size: 13px; color: #9c9a93; }

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

.table thead tr { border-bottom: 1px solid #ece9e4; }

.table th {
  padding: 11px 16px;
  text-align: left;
  font-size: 11px;
  font-weight: 500;
  color: #9c9a93;
  letter-spacing: .06em;
  text-transform: uppercase;
}

.table td {
  padding: 14px 16px;
  border-bottom: 1px solid #f5f4f2;
  vertical-align: middle;
}

.table tbody tr:last-child td { border-bottom: none; }
.table tbody tr:hover td { background: #fdfcfb; }

.contact-name {
  font-size: 13px;
  font-weight: 500;
  color: #1a1a18;
  margin-bottom: 2px;
}

.contact-email {
  font-size: 12px;
  color: #9c9a93;
}

.contact-subject {
  font-size: 13px;
  font-weight: 500;
  color: #1a1a18;
  margin-bottom: 2px;
}

.contact-preview {
  font-size: 12px;
  color: #9c9a93;
}

.date-cell {
  font-size: 13px;
  color: #9c9a93;
  white-space: nowrap;
}

.actions { display: flex; gap: 6px; }

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

.empty {
  padding: 4rem;
  text-align: center;
}

.empty p { font-size: 14px; color: #9c9a93; }
</style>