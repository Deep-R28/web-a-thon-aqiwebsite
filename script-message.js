
function closeAlert(element) {
    element.parentElement.style.opacity = '0';
    setTimeout(() => { 
        element.parentElement.style.display = 'none'; 
    }, 500);
}
