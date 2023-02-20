function toogleInput(e){
    const list= document.getElementsByClassName('Input_input_password');
    for( let item of list){
        item.type=e.checked ? 'text': 'password';
    }
}
