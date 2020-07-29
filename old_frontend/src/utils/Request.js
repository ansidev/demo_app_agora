import axios from 'axios'

const request = axios.create({
  baseURL: process.env.BASE_API_URL,
  timeout: 6000
})

const errorHandler = (error) => {
  if (error.response) {
    const data = error.response.data
    // Get saved token from localStorage
    // const token = storage.get(ACCESS_TOKEN)
    if (error.response.status === 403) {
      console.error('Forbidden', data.message)
    }
    if (error.response.status === 401 && data.success && data.success === false) {
      console.error('Unauthorized', 'Authorization verification failed')
      // if (token) {
      //   store.dispatch('Logout').then(() => {
      //     setTimeout(() => {
      //       window.location.reload()
      //     }, 1500)
      //   })
      // }
    }
  }
  return Promise.reject(error)
}

// request interceptor
request.interceptors.request.use(config => {
  // const token = storage.get(ACCESS_TOKEN)
  const token = null
  if (token) {
    config.headers['Authorization'] = 'Bearer ' + token
  }
  return config
}, errorHandler)

// response interceptor
request.interceptors.response.use((response) => {
  return response.data
}, errorHandler)

export default request
