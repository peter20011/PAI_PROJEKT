 async function logout() {
     console.log('start');
     try {
         const resp = await fetch('logout', {method: 'POST'});
         console.log(resp);
         if (!resp.ok) throw new Error('Logout failed');
     } catch (err) {
     }
     console.log('dupa');

 }
