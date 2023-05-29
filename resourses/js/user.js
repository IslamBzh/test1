
document.onclick = function(event) {
    if (event.target.nodeName != 'A')
        return;

    var a = event.target;

    var act = a.getAttribute('act');

    if(act == 'show')
        a.setAttribute('act', 'hide');
    else
    if(act == 'hide')
        a.setAttribute('act', 'show');
    else
    if(act == 'details'){
        let parent = a.parentElement;
        let details = document.getElementById('details');

        name = a.innerHTML;
        description = parent.querySelector('input[name="description"]').value;
        details.querySelector('.name').innerHTML = name;
        details.querySelector('.description').innerHTML = description;
    }
    else
    if(act == 'close'){
        let details = a.closest('#details');

        details.querySelector('.name').innerHTML = '';
        details.querySelector('.description').innerHTML = '';
    }

    return false;
};