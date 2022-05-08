import axios from 'axios';

export const basePath = "http://localhost:8000/"
const axiosInstance = axios.create({
  baseURL: basePath,
  headers: { "Content-Type": "application/x-www-form-urlencoded" },
});

export default axiosInstance;
