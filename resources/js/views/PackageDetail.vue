<template>
  <div>
    <!-- Loading State -->
    <Loader v-if="loading" message="Loading package details..." />

    <!-- Error State -->
    <div v-else-if="error" class="text-center py-12">
      <div class="text-red-600 mb-4">
        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
        </svg>
      </div>
      <h3 class="text-lg font-medium text-gray-900 mb-2">Package not found</h3>
      <p class="text-gray-600 mb-4">{{ error }}</p>
      <router-link to="/" class="btn-primary">
        Back to Packages
      </router-link>
    </div>

    <!-- Package Details -->
    <div v-else-if="package" class="max-w-4xl mx-auto">
      <!-- Back Button -->
      <div class="mb-6">
        <router-link to="/" class="inline-flex items-center text-primary-600 hover:text-primary-700">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
          Back to Packages
        </router-link>
      </div>

      <!-- Package Header -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="relative">
          <img 
            :src="package.image || '/images/placeholder.jpg'" 
            :alt="package.title"
            class="w-full h-96 object-cover"
            @error="handleImageError"
          />
          <div class="absolute top-6 right-6 bg-primary-600 text-white px-4 py-2 rounded-full text-lg font-bold">
            ${{ formatPrice(package.price) }}
          </div>
        </div>
        
        <div class="p-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ package.title }}</h1>
          
          <!-- Package Info Grid -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="flex items-center">
              <svg class="w-6 h-6 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <div>
                <p class="text-sm text-gray-500">Departure City</p>
                <p class="font-medium">{{ package.departure_city }}</p>
              </div>
            </div>
            
            <div class="flex items-center">
              <svg class="w-6 h-6 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <div>
                <p class="text-sm text-gray-500">Duration</p>
                <p class="font-medium">{{ package.duration }} days</p>
              </div>
            </div>
            
            <div class="flex items-center">
              <svg class="w-6 h-6 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              <div>
                <p class="text-sm text-gray-500">Travel Dates</p>
                <p class="font-medium">{{ formatDate(package.start_date) }} - {{ formatDate(package.end_date) }}</p>
              </div>
            </div>
          </div>

          <!-- Description -->
          <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-3">About This Package</h2>
            <p class="text-gray-700 leading-relaxed">{{ package.description }}</p>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-4">
            <button class="btn-primary flex-1">
              Book Now
            </button>
            <button class="btn-secondary flex-1">
              Contact Us
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import { api } from '../services/api'
import Loader from '../components/Loader.vue'

export default {
  name: 'PackageDetail',
  components: {
    Loader
  },
  props: {
    id: {
      type: [String, Number],
      required: true
    }
  },
  setup(props) {
    const packageData = ref(null)
    const loading = ref(false)
    const error = ref(null)

    const loadPackage = async () => {
      loading.value = true
      error.value = null
      
      try {
        const response = await api.getPackage(props.id)
        packageData.value = response.data.data
      } catch (err) {
        if (err.response?.status === 404) {
          error.value = 'This package could not be found or may have been removed.'
        } else {
          error.value = err.response?.data?.message || 'Failed to load package details'
        }
        console.error('Error loading package:', err)
      } finally {
        loading.value = false
      }
    }

    const formatPrice = (price) => {
      return new Intl.NumberFormat('en-US').format(price)
    }

    const formatDate = (dateString) => {
      return new Date(dateString).toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      })
    }

    const handleImageError = (event) => {
      event.target.src = 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800&h=400&fit=crop'
    }

    onMounted(() => {
      loadPackage()
    })

    return {
      package: packageData,
      loading,
      error,
      formatPrice,
      formatDate,
      handleImageError
    }
  }
}
</script>
