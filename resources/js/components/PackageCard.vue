<template>
  <div class="card cursor-pointer" @click="viewPackage">
    <div class="relative">
      <img 
        :src="package.image || '/images/placeholder.jpg'" 
        :alt="package.title"
        class="w-full h-48 object-cover"
        @error="handleImageError"
      />
      <div class="absolute top-4 right-4 bg-primary-600 text-white px-3 py-1 rounded-full text-sm font-medium">
        ${{ formatPrice(package.price) }}
      </div>
    </div>
    
    <div class="p-6">
      <h3 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">
        {{ package.title }}
      </h3>
      
      <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
        <div class="flex items-center">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          {{ package.departure_city }}
        </div>
        <div class="flex items-center">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          {{ package.duration }} days
        </div>
      </div>
      
      <div class="flex items-center justify-between">
        <div class="text-sm text-gray-500">
          {{ formatDate(package.start_date) }} - {{ formatDate(package.end_date) }}
        </div>
        <button class="btn-primary text-sm">
          View Details
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PackageCard',
  props: {
    package: {
      type: Object,
      required: true
    }
  },
  methods: {
    viewPackage() {
      this.$router.push(`/package/${this.package.id}`)
    },
    formatPrice(price) {
      return new Intl.NumberFormat('en-US').format(price)
    },
    formatDate(dateString) {
      return new Date(dateString).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric'
      })
    },
    handleImageError(event) {
      event.target.src = 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=500&h=300&fit=crop'
    }
  }
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
