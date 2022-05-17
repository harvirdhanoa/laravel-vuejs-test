import axios from 'axios';

class AuthService {

    async signIn(data) {
        const response = await axios
          .post(API_URL+`/api/login`, data);
        return response.data;
    }

    async logout() {
      const response = await axios
        .post(API_URL+`/api/logout`);
      return response.data;
    }
  
}
  
export default new AuthService();