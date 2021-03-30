const login = document.querySelector('.loginOption');
const create = document.querySelector('.createOption');

const loginContainer = document.querySelector('.loginContainer');
const createContainer = document.querySelector('.createContainer');

let current = login;
document.addEventListener('click', (e) =>{
    if (e.target !== null){
        console.log(current)
        //console.log(e.target === login)
        if (e.target === login && e.target !== current){
            login.classList.add('optionSelected');
            create.classList.remove('optionSelected');
            createContainer.style.display = 'none';
            loginContainer.style.display = 'block';
            current = login;
        }else if (e.target === create && e.target !== current){
            login.classList.remove('optionSelected');
            create.classList.add('optionSelected');
            createContainer.style.display = 'block';
            loginContainer.style.display = 'none';
            current = create;
        }
    }
})