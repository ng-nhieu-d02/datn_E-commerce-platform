
function toast({
    title = '',
    message = '',
    type = 'info',
    duration = 3000
}) {
    const main = document.getElementById('toast');
    if (main){
        const toast = document.createElement('div');

        const autoRemoveId = setTimeout(function(){
            main.removeChild(toast);
        }, duration + 2000 );

        toast.onclick = function(e){
            if(e.target.closest('.toast__close')){
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        }
        const icons ={
            success: 'fas fa-check',
            error: 'fas fa-circle-exclamation'
        }
        const delay = (duration / 1000).toFixed(2);
        const icon = icons[type];
        toast.classList.add('toast', `toast--${type}`);
        toast.style.animation = `slideInLeft ease .3s, fadeOut linear 10s 30s forwards`;
        toast.innerHTML = `
            <div class="toast__icon">
                <i class="${icon}"></i>
            </div>
            <div class="toast__body">
                <h3 class="toast__title">${title}</h3>
                <p class="toast__msg">${message}</p>
            </div>
            <div class="toast__close">
                <i class="fa fa-times"></i>
            </div>  
            `;
        main.appendChild(toast);
    }
}