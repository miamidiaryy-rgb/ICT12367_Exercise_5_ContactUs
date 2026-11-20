<script setup>
import { ref, computed, onMounted } from 'vue'
import { API_BASE_URL } from '../config'

const emit = defineEmits(['go-add'])

const contacts = ref([])
const loading = ref(false)
const errorMsg = ref('')
const searchText = ref('')

const fetchContacts = async () => {
  loading.value = true
  errorMsg.value = ''
  try {
    const res = await fetch(`${API_BASE_URL}/show_contacts.php`)
    const result = await res.json()
    if (result.success) {
      contacts.value = result.data
    } else {
      errorMsg.value = result.message || 'ไม่สามารถโหลดข้อมูลได้'
    }
  } catch (err) {
    errorMsg.value = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ PHP API ได้'
  } finally {
    loading.value = false
  }
}

const filteredContacts = computed(() => {
  const kw = searchText.value.trim().toLowerCase()
  if (!kw) return contacts.value
  return contacts.value.filter(
    (item) =>
      item.subject.toLowerCase().includes(kw) ||
      item.detail.toLowerCase().includes(kw) ||
      item.fullname.toLowerCase().includes(kw) ||
      item.email.toLowerCase().includes(kw)
  )
})

onMounted(fetchContacts)
</script>

<template>
  <div class="container mt-4 mb-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
      <h4 class="mb-0">รายการข้อมูลติดต่อเรา (Contact Us)</h4>

      <div class="d-flex gap-2">
        <input
          v-model="searchText"
          type="text"
          class="form-control form-control-sm"
          placeholder="ค้นหาหัวข้อ ชื่อ หรืออีเมล..."
          style="width: 230px"
        />
        <button class="btn btn-primary btn-sm" @click="emit('go-add')">
          + เพิ่มข้อมูลติดต่อเรา
        </button>
      </div>
    </div>

    <div v-if="errorMsg" class="alert alert-danger py-2">{{ errorMsg }}</div>

    <div v-if="loading" class="text-muted py-3">กำลังโหลดข้อมูล...</div>

    <div v-else class="table-responsive">
      <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th class="text-center" style="width: 75px">รหัส</th>
            <th style="width: 20%">หัวข้อ</th>
            <th style="width: 30%">รายละเอียด</th>
            <th>ชื่อ-นามสกุล</th>
            <th>อีเมล</th>
            <th style="width: 165px">วันเวลาที่เพิ่มข้อมูล</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in filteredContacts" :key="item.contact_id">
            <td class="text-center">{{ item.contact_id }}</td>
            <td>{{ item.subject }}</td>
            <td>{{ item.detail }}</td>
            <td>{{ item.fullname }}</td>
            <td>{{ item.email }}</td>
            <td>{{ item.created_at }}</td>
          </tr>
          <tr v-if="filteredContacts.length === 0">
            <td colspan="6" class="text-center text-muted py-3">ไม่พบข้อมูลติดต่อเรา</td>
          </tr>
        </tbody>
      </table>
    </div>

    <p class="text-muted small mb-0">
      แสดงข้อมูลทั้งหมด {{ filteredContacts.length }} รายการ
    </p>
  </div>
</template>
