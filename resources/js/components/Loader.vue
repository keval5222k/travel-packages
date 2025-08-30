<template>
  <div class="flex justify-center items-center py-8">
    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600"></div>
    <span class="ml-3 text-gray-600">{{ message || 'Loading...' }}</span>
  </div>
</template>

<script>
export default {
  name: 'Loader',
  props: {
    message: {
      type: String,
      default: ''
    }
  }
}
</script>
