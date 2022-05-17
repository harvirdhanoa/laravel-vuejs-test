export default function authenticate({ next,router }) {
   // if (!window.localStorage.getItem('token')) {
        return router.push({ name: 'Login' });
    //}

    //return next();
}