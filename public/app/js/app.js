// scroll content
// window.addEventListener('DOMContentLoaded', () => {
//     let scrollPos = 0;
//     const mainNav = document.getElementById('mainNav');
//     const headerHeight = mainNav.clientHeight;
//     window.addEventListener('scroll', function () {
//         const currentTop = document.body.getBoundingClientRect().top * -1;
//         if (currentTop < scrollPos) {
//             // Scrolling Up
//             if (currentTop > 0 && mainNav.classList.contains('is-fixed')) {
//                 mainNav.classList.add('is-visible');
//             } else {
//                 mainNav.classList.remove('is-visible', 'is-fixed');
//             }
//         } else {
//             // Scrolling Down
//             mainNav.classList.remove(['is-visible']);
//             if (currentTop > headerHeight && !mainNav.classList.contains('is-fixed')) {
//                 mainNav.classList.add('is-fixed');
//             }
//         }
//         scrollPos = currentTop;
//     });
// });

// Highlight current page links
const navLinks = document.querySelectorAll('nav ul li a');
const url = window.location.href;

for (let navLink of navLinks) {
    if (url === navLink.href) {
        navLink.classList.add('nav-active');
        // If it is dropdown
        if (navLink.closest('ul').classList.contains('dropdown-menu')) {
            navLink.parentElement.parentElement.parentElement.children[0].classList.add('nav-active');
        }
    } else if (url.slice(0, -1) === navLink.href) {
        navLink.classList.add('nav-active');
    }
}

// Removing erros on input field change
Array.from(document.querySelectorAll('.is-invalid')).forEach(errorElement => {
    errorElement.addEventListener('change', e => e.target.classList.remove('is-invalid'));
});

// constants
const csrfToken = document.querySelector('meta[name="X-CSRF-TOKEN"]').content;
const baseUrl = document.querySelector('meta[name="base-url"]').content;

// // axios helpers
// const getRequest = async (url, params = {}) => {
//     return await axios.get(url, params);
// }

// const postRequest = async (url, params = {}) => {
//     return await axios.post(url, params);
// }

// const subscribeBtn = document.getElementById('subscribe-btn');

// subscribeBtn.addEventListener('click', e => {

//     clearErrorMessages();
//     subscribeBtn.innerText = 'Working ...';
//     subscribeBtn.disabled = true;
//     postRequest(`${baseUrl}/news-letter-subscribe`, {
//         '_token': csrfToken,
//         'email': document.getElementById('newsletter-email').value
//     })
//         .then(res => {
//             console.log(res);
//             subscribeBtn.innerText = 'Subscribe';
//             subscribeBtn.disabled = false;
//             // showMessage(res.data.message);
//             document.getElementById('newsletter-email').value = '';
//             alertify.notify(res.data.message, 'success');
//         })
//         .catch(error => {
//             subscribeBtn.disabled = false;
//             subscribeBtn.innerText = 'Subscribe';
//             alertify.notify(error.response.data.messages.message, 'error');
//             appendErrorMessages(error.response.data.messages.validation);
//             // showMessage('validation Error', 'error');
//         });

// });

// const clearErrorMessages = () => {
//     Array.from(document.querySelectorAll('.is-invalid')).forEach((el) => el.classList.remove('is-invalid'));
//     // Array.from(document.querySelectorAll('.form-control.is-invalid')).forEach((el) => el.classList.remove('is-invalid'));
// }
// const appendErrorMessages = errors => {
//     for (let error in errors) {
//         let element = document.getElementById('newsletter-' + error);
//         element.classList.add('is-invalid');
//         element.nextElementSibling.innerHTML = errors[error];
//     }
//     Array.from(document.querySelectorAll('.is-invalid')).forEach(errorElement => {
//         errorElement.addEventListener('change', e => e.target.classList.remove('is-invalid'));
//     })
// }
