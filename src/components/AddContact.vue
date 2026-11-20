<script setup>
import { ref } from 'vue'
import { API_BASE_URL } from '../config'

const emit = defineEmits(['added', 'cancel'])

const form = ref({
  subject: '',
  detail: '',
  fullname: '',
  email: '',
})

const submitting = ref(false)
const successMsg = ref('')
const errorMsg = ref('')

const resetForm = () => {
  form.value = {
    subject: '',
    detail: '',
    fullname: '',
    email: '',
  }
}

const handleSubmit = async () => {
  successMsg.value = ''
  errorMsg.value = ''
  submitting.value = true

  try {
    const res = await fetch(`${API_BASE_URL}/add_contact.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(form.value),
    })
    const result = await res.json()

    if (result.success) {
      successMsg.value = result.message || 'บันทึกข้อมูลติดต่อเราเรียบร้อยแล้ว'
      resetForm()
      emit('added')
    } else {
      errorMsg.value = result.message || 'ไม่สามารถบันทึกข้อมูลได้'
    }
  } catch (err) {
    errorMsg.value = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ PHP API ได้'
  } finally {
    submitting.value = false
  }
}
</script>

<template>
  <div class="container mt-4 mb-5">
    <div class="card mx-auto" style="max-width: 650px">
      <div class="card-header bg-light">
        <h5 class="mb-0">ติดต่อเรา (Contact Us)</h5>
      </div>
      <div class="card-body">
        <div v-if="successMsg" class="alert alert-success py-2">{{ successMsg }}</div>
        <div v-if="errorMsg" class="alert alert-danger py-2">{{ errorMsg }}</div>

        <form @submit.prevent="handleSubmit">
          <div class="mb-3">
            <label class="form-label">หัวข้อ <span class="text-danger">*</span></label>
            <input
              v-model="form.subject"
              type="text"
              class="form-control"
              placeholder="กรอกหัวข้อที่ต้องการติดต่อ"
              required
            />
          </div>

          <div class="mb-3">
            <label class="form-label">รายละเอียด <span class="text-danger">*</span></label>
            <textarea
              v-model="form.detail"
              rows="4"
              class="form-control"
              placeholder="กรอกรายละเอียดข้อความ..."
              required
            ></textarea>
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <label class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
              <input
                v-model="form.fullname"
                type="text"
                class="form-control"
                placeholder="กรอกชื่อ-นามสกุล"
                required
              />
            </div>
            <div class="col-md-6">
              <label class="form-label">อีเมล <span class="text-danger">*</span></label>
              <input
                v-model="form.email"
                type="email"
                class="form-control"
                placeholder="example@gmail.com"
                required
              />
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary" @click="emit('cancel')">
              กลับไปหน้าแสดงข้อมูล
            </button>
            <button type="submit" class="btn btn-primary" :disabled="submitting">
              {{ submitting ? 'กำลังบันทึก...' : 'ส่งข้อมูล' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
