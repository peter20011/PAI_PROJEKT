function toogleInput(e){
    var list= document.getElementsByClassName('Input_input_password');
    console.log(list);
    for( let item of list){
        item.type=e.checked ? 'text': 'password';
    }
}
