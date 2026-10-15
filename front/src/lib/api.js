import axios from 'axios';

const apiURL = import.meta.env.VITE_API_URL;
const token = localStorage.getItem('fluxora.token');

export const api = axios.create({
  baseURL: apiURL
});

if (token) {
  const sessionData = JSON.parse(token);

  api.defaults.headers.Authorization = `Bearer ${sessionData.token}`;
}