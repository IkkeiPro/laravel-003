// filepath: /home/student/re-idea-app/resources/js/bootstrap.js
import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.defaults.baseURL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000';
