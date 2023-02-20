const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const nickInput = form.querySelector('input[name="username"]');
const confirmedPasswordInput=form.querySelector('input[name="password2"]');
const scheduleLink=form.querySelector('input[name="schedule"]');
const ytLink=form.querySelector('input[name="yt"]');
const fbLink=form.querySelector('input[name="fb"]');
const bandDescription=form.querySelector('textarea[name="description"]')

function isEmail(email){
    return /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email);
}

function isPassword(password){
    return /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password);
}

function isNick(username){
    return /[A-Za-z\d]{5,64}$/.test(username);
}

function arePasswordSame(password, pass2){
    return password===pass2;
}

function markValidation(element, condition) {
    !condition ? element.classList.add("no-valid") : element.classList.remove("no-valid");
}

function validateEmail (){
    setTimeout(
        function(){
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000);
}

emailInput.addEventListener('keyup', validateEmail);

function validatePassword(){
    setTimeout(
        function(){
            markValidation(passwordInput, isPassword(passwordInput.value));
        },
        1000);
}

passwordInput.addEventListener('keyup', validatePassword);

function validateNick(){
    setTimeout(
        function(){
            markValidation(nickInput, isNick(nickInput.value));
        },
        1000);
}

passwordInput.addEventListener('keyup', validateNick);



function validatePassword2(){
    setTimeout(
        function(){
            markValidation(confirmedPasswordInput, arePasswordSame(
                passwordInput.value,
                confirmedPasswordInput.value
            ));
        },
        1000);
}

confirmedPasswordInput.addEventListener('keyup', validatePassword2);

function isURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
     return pattern.test(str);
}

function validateURL(element){
    setTimeout(
        function(){
            markValidation(element, isURL(element.value));
        },
        1000);
}


scheduleLink.addEventListener('change',()=>validateURL(scheduleLink));
ytLink.addEventListener('change',()=>validateURL(ytLink));
fbLink.addEventListener('change',()=>validateURL(fbLink));

function required(str)
{
    if (str.length == 0)
    {
        return false;
    }

    return true;
}

function validateDescription(element){
    setTimeout(
        function(){
            markValidation(element, required(element.value));
        },
        1000);
}

bandDescription.addEventListener("keyup",()=>validateDescription(bandDescription))
