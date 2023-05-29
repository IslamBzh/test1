var transfer_id = null;
var transfer_branch = null;

document.onclick = function(event) {
    if (event.target.nodeName != 'A')
        return;

    var a = event.target;

    var act = a.getAttribute('act');
    var parent;

    if(a.getAttribute('no-parent'))
        parent = findParentByClass(a, 'tree');

    else
        parent = findParentByAttr(a, 'branch');

    id = null;

    if(parent.getAttribute('branch'))
        id = parent.getAttribute('branch');

    console.log(act, parent, a.getAttribute('no-parent'));

    if(!transfer_id && act == 'add')
        ajax('act=new&id=' + id, (res) => {
            if(res.success)
                newBranch(parent, res.id);
        });
    else
    if(!transfer_id && act == 'del'){
        if (confirm('Удалить всю ветку?')) {
            ajax('act=del&id=' + id, (res) => {
                if(res.success)
                    delBranch(parent);
            });
        }
    }
    else
    if(act == 'transfer'){
        transfer_id = id;
        transfer_branch = parent;
        parent.classList.add('transfer');
        document.getElementById("tree").classList.add('select');
    }
    if(act == 'close'){
        document.getElementById("tree").classList.remove('select');
        parent.classList.remove('transfer');

        transfer_id = null
        transfer_branch = null;
    }
    if(transfer_id && act == 'select'){
        document.getElementById("tree").classList.remove('select');
        parent.classList.remove('transfer');

        ajax('act=edit&id=' + transfer_id + '&name=parent_id&value=' + id, (res) => {
            console.log(res);
            if(res.success)
                tranferBranch(transfer_branch, parent);

            transfer_id = null
            transfer_branch = null;
        });
    }

    return false;
};


document.onchange = function(event) {
    var el = event.target;

    if (el.nodeName != 'TEXTAREA' && el.nodeName != 'INPUT')
        return;

    var branch = findParentByAttr(el, 'branch');

    var name = el.name;
    if(name != 'description' && name != 'name')
        return;

    var branch_id = branch.getAttribute('branch');
    var value = el.value;

    if(name == 'name' && value.length < 3){
        if(el.oldvalue.length < 3){
            if (confirm('Не сохранять ветку?')) {
                ajax('act=del&id=' + branch_id, (res) => {
                    if(res.success)
                        delBranch(branch);
                });
                return;
            }
            else{
                el.focus();
            }
        }
        el.value = el.oldvalue;
        return;
    }

    ajax('act=edit&id=' + branch_id + '&name=' + name + '&value=' + value, (res) => {
        console.log(res);
        if(!res.success){
            el.value = el.oldvalue;
        }
    });
};