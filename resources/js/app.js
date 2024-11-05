import './bootstrap';

Echo.private("notifications")
    .listen("UserSessionChanged", (e) =>{
        const notiElement = document.getElementById('notification')

        notiElement.innerText = e.messge;
        // console.log (e.messge)
        notiElement.classList.remove('invisible');` `
        notiElement.classList.remove('alert-success');
        notiElement.classList.remove('alert-danger');
        notiElement.classList.add('alert-'+e.type)
    })
