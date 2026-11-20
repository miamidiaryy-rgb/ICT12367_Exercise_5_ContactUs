<script setup>
import { ref } from 'vue'
import ContactList from './components/ContactList.vue'
import AddContact from './components/AddContact.vue'

const currentPage = ref('list')

const handleAdded = () => {
  setTimeout(() => {
    currentPage.value = 'list'
  }, 600)
}
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="#" @click.prevent="currentPage = 'list'">
        ระบบติดต่อเรา (Contact Us)
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a
              href="#"
              class="nav-link"
              :class="{ active: currentPage === 'list', 'fw-semibold': currentPage === 'list' }"
              @click.prevent="currentPage = 'list'"
            >
              แสดงข้อมูลติดต่อเรา
            </a>
          </li>
          <li class="nav-item">
            <a
              href="#"
              class="nav-link"
              :class="{ active: currentPage === 'add', 'fw-semibold': currentPage === 'add' }"
              @click.prevent="currentPage = 'add'"
            >
              เพิ่มข้อมูลติดต่อเรา
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <ContactList v-if="currentPage === 'list'" @go-add="currentPage = 'add'" />
  <AddContact v-else @added="handleAdded" @cancel="currentPage = 'list'" />
</template>

<style>
body {
  font-family: 'Leelawadee UI', Tahoma, sans-serif;
  background-color: #ffffff;
}
</style>
