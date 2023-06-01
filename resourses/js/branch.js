function BranchElements () {

    this.create = function(parent, id){
        var branch = document.createElement('div');
        branch.innerHTML =
            '<div class="action">' +
                '<a act="add" href="//"></a>'+
            '</div>';

        var leaf = document.createElement('form');
        leaf.classList.add('leaf');
        leaf.innerHTML =
            '<div class="action">' +
                '<input type="checkbox" name="show">' +
                '<a act="del" href="//"></a>'+
            '</div>';

        var input = document.createElement('input');
        input.setAttribute('onfocus', 'this.oldvalue = this.value;');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'name');
        input.setAttribute('data', 'new');
        input.setAttribute('value', 'Новая ветка');
        input.setAttribute('placeholder', 'Введите название');
        leaf.append(input);

        var textarea = document.createElement('textarea');
        textarea.setAttribute('onfocus', 'this.oldvalue = this.value;');
        textarea.setAttribute('name', 'description');
        leaf.append(textarea);

        branch.append(leaf);
        branch.setAttribute('branch', id);

        parent.append(branch);
        parent.querySelector('input[name="show"]').checked = true;
        input.focus();
    };

    this.del = function(branch){

        branch.remove();
    };

    this.tranfer = function(branch, new_branch){
        body = branch;
        branch.remove();
        new_branch.append(body);
    };


    this.getAll = function(){

        return document.querySelectorAll("#tree div[branch]");
    };

    this.getChildsForBranch = function(branch){

        return branch.querySelectorAll(" > div[branch]");
    };

    this.genOptions = function(select, for_branch_id, parent_id) {

        parents = document.querySelectorAll("#tree > div[branch]");
        parents.forEach(function(parent){
            if(parent.getAttribute('branch') != for_branch_id)
                genBodySelect(select, for_branch_id, parent);
        });

        select.querySelector('option[value="' + parent_id + '"]').setAttribute('selected', 'selected');
    };

    function genBodySelect(select, for_branch_id, branch, enclosure = ''){
        var option = document.createElement('option');
        option.setAttribute('value', branch.getAttribute('branch'));
        option.innerHTML = enclosure + branch.querySelector('input[name="name"]').value;
        select.append(option);

        enclosure += '&emsp;';
        Array.prototype.forEach.call(branch.children, child => {
            if(child.hasAttribute('branch') && child.getAttribute('branch') != for_branch_id)
                genBodySelect(select, for_branch_id, child, enclosure);
        });

        return select;
    }
}


function BranchController(branch){
    this.id = branch.getAttribute('branch');
}