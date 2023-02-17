 async function logout() {
     console.log('start');
     try {
         const resp = await fetch('/logout', {method: 'POST'});
         console.log(resp);
         if (!resp.ok) {
             throw new Error('Logout failed');
         }else{
             window.location.href="/login";
         }
     } catch (err) {
     }
 }
