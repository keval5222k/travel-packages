<template>
  <div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Filter Packages</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
      <!-- Price Range Filter -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
        <select 
          v-model="filters.price_range" 
          @change="applyFilters"
          class="input-field"
        >
          <option value="">All Prices</option>
          <option value="<50000">Under $50,000</option>
          <option value="50000-100000">$50,000 - $100,000</option>
          <option value=">100000">Over $100,000</option>
        </select>
      </div>

      <!-- Duration Filter -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
        <select 
          v-model="filters.duration" 
          @change="applyFilters"
          class="input-field"
        >
          <option value="">All Durations</option>
          <option value="3-5">3-5 Days</option>
          <option value="6-10">6-10 Days</option>
          <option value=">10">Over 10 Days</option>
        </select>
      </div>

      <!-- Departure City Filter -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Departure City</label>
        <select 
          v-model="filters.departure_city" 
          @change="applyFilters"
          class="input-field"
        >
          <option value="">All Cities</option>
          <option v-for="city in cities" :key="city" :value="city" v-if="cities && cities.length > 0">
            {{ city }}
          </option>
        </select>
      </div>

      <!-- Date Range Filter -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
        <input 
          type="date" 
          v-model="filters.start_date" 
          @change="applyFilters"
          class="input-field"
        />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
        <input 
          type="date" 
          v-model="filters.end_date" 
          @change="applyFilters"
          class="input-field"
        />
      </div>
    </div>

    <!-- Search Bar -->
    <div class="mt-4">
      <label class="block text-sm font-medium text-gray-700 mb-2">Search Packages</label>
      <div class="relative">
        <input 
          type="text" 
          v-model="filters.search" 
          @input="debounceSearch"
          placeholder="Search by package title..."
          class="input-field pl-10"
        />
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </div>
    </div>

    <!-- Clear Filters Button -->
    <div class="mt-4 flex justify-end">
      <button 
        @click="clearFilters" 
        class="btn-secondary"
      >
        Clear All Filters
      </button>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue'
import { api } from '../services/api'

export default {
  name: 'Filters',
  emits: ['filters-changed'],
  setup(props, { emit }) {
    const cities = ref([])
    const filters = reactive({
      price_range: '',
      duration: '',
      departure_city: '',
      start_date: '',
      end_date: '',
      search: ''
    })

    let searchTimeout = null

    const loadCities = async () => {
      try {
        const response = await api.getDepartureCities()
        console.log('Cities API Response:', response)
        if (response.data && response.data.success && response.data.data) {
          cities.value = response.data.data
        } else {
          console.error('Invalid cities API response structure:', response.data)
          cities.value = []
        }
      } catch (error) {
        console.error('Failed to load cities:', error)
        cities.value = []
      }
    }

    const applyFilters = () => {
      emit('filters-changed', { ...filters })
    }

    const debounceSearch = () => {
      clearTimeout(searchTimeout)
      searchTimeout = setTimeout(() => {
        applyFilters()
      }, 300)
    }

    const clearFilters = () => {
      Object.keys(filters).forEach(key => {
        filters[key] = ''
      })
      applyFilters()
    }

    onMounted(() => {
      loadCities()
    })

    return {
      cities,
      filters,
      applyFilters,
      debounceSearch,
      clearFilters
    }
  }
}
</script>
