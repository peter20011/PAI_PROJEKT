const deleteButton=document.querySelector(".ButtonDelate");

async function deleteBand(id){
    console.log("dupa");
    try {
        const request = await fetch(`/delete?id=${id}`, {
            method: 'POST'
        })
        if(!request.ok){
            throw new Error('Delete failed');
        }else{
           console.log("dupa2");
            window.location.href="/homePage";
        }
    }catch (err){}
}