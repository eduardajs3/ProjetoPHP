import axios from 'axios';

const apiURL = import.meta.env.VITE_STREAM_API_URL;

export const stream = axios.create({
  baseURL: apiURL
});
