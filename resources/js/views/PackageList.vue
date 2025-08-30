<template>
  <div>
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Travel Packages</h1>
      <p class="text-gray-600">Discover amazing destinations around the world</p>
    </div>

    <!-- Filters Component -->
    <Filters @filters-changed="handleFiltersChanged" />

    <!-- Loading State -->
    <Loader v-if="loading" message="Loading packages..." />

    <!-- Error State -->
    <div v-else-if="error" class="text-center py-12">
      <div class="text-red-600 mb-4">
        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
        </svg>
      </div>
      <h3 class="text-lg font-medium text-gray-900 mb-2">Something went wrong</h3>
      <p class="text-gray-600 mb-4">{{ error }}</p>
      <button @click="loadPackages" class="btn-primary">
        Try Again
      </button>
    </div>

    <!-- Packages Grid -->
    <div v-else-if="packages && packages.length > 0">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <PackageCard 
          v-for="packageItem in packages" 
          :key="packageItem.id" 
          :package="packageItem" 
        />
      </div>
      
      <!-- Results Count -->
      <div class="mt-8 text-center text-gray-600">
        Showing {{ packages.length }} package{{ packages.length !== 1 ? 's' : '' }}
      </div>
    </div>

    <!-- Empty State -->
    <div v-else class="text-center py-12">
      <div class="text-gray-400 mb-4">
        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
        </svg>
      </div>
      <h3 class="text-lg font-medium text-gray-900 mb-2">No packages found</h3>
      <p class="text-gray-600">Try adjusting your filters or search terms</p>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue'
import { api } from '../services/api'
import Filters from '../components/Filters.vue'
import PackageCard from '../components/PackageCard.vue'
import Loader from '../components/Loader.vue'

export default {
  name: 'PackageList',
  components: {
    Filters,
    PackageCard,
    Loader
  },
  setup() {
    const packages = ref([])
    const loading = ref(false)
    const error = ref(null)
    const currentFilters = reactive({})

    const loadPackages = async (filters = {}) => {
      loading.value = true
      error.value = null
      
      try {
        const response = await api.getPackages(filters)
        console.log('API Response:', response)
        if (response.data && response.data.success && response.data.data) {
          packages.value = response.data.data
        } else {
          console.error('Invalid API response structure:', response.data)
          packages.value = []
          error.value = 'Invalid response from server'
        }
      } catch (err) {
        console.error('Error loading packages:', err)
        error.value = err.response?.data?.message || 'Failed to load packages'
        packages.value = []
      } finally {
        loading.value = false
      }
    }

    const handleFiltersChanged = (filters) => {
      Object.assign(currentFilters, filters)
      loadPackages(currentFilters)
    }

    onMounted(() => {
      loadPackages()
    })

    return {
      packages,
      loading,
      error,
      loadPackages,
      handleFiltersChanged
    }
  }
}
</script>
