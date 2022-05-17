import axios from 'axios';
import authHeader from './auth-header';

class ProductService {

  async getProduct(data) {
    const config = {
      headers: authHeader()
    };
    const response = await axios
      .post(API_URL+`/api/getProducts`, data, config);
    return response.data;
  }

}

export default new ProductService();