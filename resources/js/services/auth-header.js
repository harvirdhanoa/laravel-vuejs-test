export default function authHeader() {
  let authToken = window.localStorage.getItem('token');
  if (authToken) {
    return {
      Authorization: 'Bearer ' + authToken,
      Accept: 'application/json',
    };
  } else {
    return {};
  }
}