import axios from 'axios'

// Configure axios defaults
// Detect if we're running on the Vite dev server or Laravel server
const isViteDevServer = window.location.port === '3000'
axios.defaults.baseURL = isViteDevServer ? '' : ''
console.log('Current URL:', window.location.href)
console.log('Port:', window.location.port)
console.log('Is Vite Dev Server:', isViteDevServer)
console.log('API Base URL:', axios.defaults.baseURL)
axios.defaults.headers.common['Accept'] = 'application/json'
axios.defaults.headers.common['Content-Type'] = 'application/json'

// Request interceptor for debugging
axios.interceptors.request.use(
  config => {
    console.log('API Request:', config.method?.toUpperCase(), config.url)
    return config
  },
  error => {
    return Promise.reject(error)
  }
)

// Response interceptor for error handling
axios.interceptors.response.use(
  response => {
    return response
  },
  error => {
    console.error('API Error:', error.response?.data || error.message)
    return Promise.reject(error)
  }
)

export const api = {
  // Get all packages with optional filters
  getPackages(filters = {}) {
    const params = new URLSearchParams()
    
    Object.keys(filters).forEach(key => {
      if (filters[key]) {
        params.append(key, filters[key])
      }
    })
    
    return axios.get(`/api/packages?${params.toString()}`)
  },

  // Get single package by ID
  getPackage(id) {
    return axios.get(`/api/packages/${id}`)
  },

  // Get departure cities for filter dropdown
  getDepartureCities() {
    return axios.get('/api/packages/cities')
  }
}

export default api
