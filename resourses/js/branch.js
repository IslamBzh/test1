

function newBranch(parent, id){
    let branch = document.createElement('div');
    branch.innerHTML =
        '<div class="action">' +
            '<a act="add" href="//"></a>'+
        '</div>';

    let leaf = document.createElement('form');
    leaf.classList.add('leaf');
    leaf.innerHTML =
        '<div class="action">' +
            '<input type="checkbox" name="show">' +
            '<a act="del" href="//"></a>'+
        '</div>';

    let input = document.createElement('input');
    input.setAttribute('onfocus', 'this.oldvalue = this.value;');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'name');
    input.setAttribute('data', 'new');
    input.setAttribute('value', 'Новая ветка');
    input.setAttribute('placeholder', 'Введите название');
    leaf.append(input);

    let textarea = document.createElement('textarea');
    textarea.setAttribute('onfocus', 'this.oldvalue = this.value;');
    textarea.setAttribute('name', 'description');
    leaf.append(textarea);

    branch.append(leaf);
    branch.setAttribute('branch', id);

    parent.append(branch);
    parent.querySelector('input[name="show"]').checked = true;
    input.focus();
}

function delBranch(branch){

    branch.parentNode.removeChild(branch);
}

function tranferBranch(branch, new_branch){
    console.log(branch);
    console.log(new_branch);

    body = branch;
    branch.remove();
    new_branch.append(body);
}
