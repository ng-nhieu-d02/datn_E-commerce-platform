function btnFilter() {
    var x = document.getElementById("filter--show");
    if (x.style.display === "none") {
      x.style.display = "flex";
    } else {
      x.style.display = "none";
    }
}
function NotifyToast({
    title = '',
    message = '',
    type = '',
    duration = 6000
}) {
    const main = document.getElementById('notify--toast');
    if (main){
        const toast = document.createElement('div');

        const autoRemoveId = setTimeout(function(){
            main.removeChild(toast);
        }, duration + 2000 );

        toast.onclick = function(e){
            if(e.target.closest('.toast--close')){
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        }
        const icons ={
            success: 'fa fa-check-circle',
            error: 'fa fa-circle-exclamation',
            info: 'fa fa-info-circle',
            warring: 'fa fa-exclamation-triangle',
        }
        const delay = (duration / 1000).toFixed(2);
        const icon = icons[type];
        toast.classList.add('notify--toast', `toast--${type}`);
        toast.style.animation = `slideInLeft ease .3s, fadeOut linear 10s 30s forwards`;
        toast.innerHTML =   `
                                <div class="toast--head">
                                    <div class="toast--icon px-3 py-1">
                                        <i class="${icon}" aria-hidden="true"></i>
                                    </div>
                                    <div class="toast--title px-3 py-1 my-auto">
                                        <span class="toast--title fw-bolder">${title}</span>
                                    </div>
                                    <div class="toast--time px-3 py-1 my-auto">
                                        <span class="text-secondary fs-5">5 giây trước</span>
                                    </div>  
                                    <div class="toast--close px-3 py-1">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </div>  
                                </div>
                                <div class="toast--foot">
                                    <p class="toast--msg px-5 fs-4">${message}</p>
                                </div>
                            `;
        main.appendChild(toast);
    }
}