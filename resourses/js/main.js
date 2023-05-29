

function findParentByClass(el, cl) {
    while ((el = el.parentNode) && el.className.indexOf(cl) < 0);
    return el;
}
function findParentByAttr(el, name) {
    while ((el = el.parentNode) && !el.hasAttribute(name));
    return el;
}

function ajax(get_params, callback){
    fetch("/ajax?hash=" + hash + "&" + get_params)
    .then(function(response) {
        return response.json();
    })
    .then(callback);
}