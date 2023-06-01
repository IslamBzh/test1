var transfer_id = null;
var transfer_branch = null;

Branch = new BranchElements();

function setEditForm(doc){
    body = doc.querySelector('.body');
    branch_id = body.querySelector('input[name="id"]').value;
    parent_id = body.querySelector('input[name="parent_id"]').value;
    body.querySelector('input[name="parent_id"]').remove();
    select = body.querySelector('select');

    document.getElementById('popup').append(body);
    Branch.genOptions(select, branch_id, parent_id);
}

document.onclick = function(event) {
    if (event.target.nodeName != 'A')
        return;

    var a = event.target;

    var act = a.getAttribute('act');
    if(act == 'close_popup'){
        document.querySelector('#popup .body').remove();
            return false;
    }
    var parent;

    if(a.getAttribute('no-parent'))
        parent = findParentByClass(a, 'tree');

    else
        parent = findParentByAttr(a, 'branch');

    id = null;

    if(parent.getAttribute('branch'))
        id = parent.getAttribute('branch');

    if(!transfer_id && act == 'add')
        fetch("/ajax/new_branch?hash=" + hash + "&parent_id=" + id)
            .then(function(response) {
                return response.text();
            })
            .then(function(html) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(html, "text/html");
                setEditForm(doc);
            })
            .catch(function(err) {
                return 0;
            });
    else
    if(!transfer_id && act == 'del'){
        if (confirm('Удалить всю ветку?')) {
            ajax('act=del&id=' + id, function(res) {
                if(res.success)
                    Branch.del(parent);
            });
        }
    }
    else
    if(act == 'edit'){
        fetch("/ajax/edit_branch?hash=" + hash + "&id=" + id)
            .then(function(response) {
                return response.text();
            })
            .then(function(html) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(html, "text/html");
                setEditForm(doc);
            })
            .catch(function(err) {
                return 0;
            });
    }

    return false;
};


