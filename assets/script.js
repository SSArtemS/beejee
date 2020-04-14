$(document).ready(function () {
    $(".add-task").click(function (e) {
        e.preventDefault();
        var email = document.getElementById('email').value;
        var userName = document.getElementById('userName').value;
        var task = document.getElementById('taskText').value;

        if (validate(email, userName, task)) {
            $.post("/addAjax/", {email, userName, task}, function (data) {
                if (data) {
                    successSave();
                    addRow('tableTasks', [userName, email, task], data);
                    document.getElementById('email').value = "";
                    document.getElementById('userName').value = "";
                    document.getElementById('taskText').value = "";
                }
            });
        } else
            return false;
    });

    $(".btn-auth").click(function (e) {
        e.preventDefault();
        var login = document.getElementById('inputLogin').value;
        var password = document.getElementById('inputPassword').value;

        if (login == '' || password == '')
            $('.text-danger').text('Заполните все поля');
        else {
            $.post("/auth/auth", {login, password}, function (data) {
                if (data) {
                    location.href = '/';
                } else {
                    $('.text-danger').text('Введенные данные неверные');
                }
            });
        }
    });

    $(".table").on('click', ".checkTask", function (elem) {
        var id = elem.target.closest('tr').getAttribute('id');
        $.post("/checked/", {id})
    });

    $(".textTask").blur(function (elem) {
        var id = elem.target.closest('tr').getAttribute('id');
        var text = elem.target.value;
        $.post("/changeTaskText/", {id, text}, function (data) {
            if (data) {
                successSave();
            }
        })
    })

    $('.sort').click(function (elem) {

        sort = elem.target.dataset.sort;

        urlArr = window.location.href.split('?')

        order = 'asc';

        if (urlArr[1]) {
            sortArr = urlArr[1].split('=');

            if (sortArr[0] == sort && sortArr[1] == 'asc')
                order = 'desc';
        }

        url = urlArr[0] + '?' + sort + '=' + order;

        window.location.href = url;
    })

    function successSave() {
        $('.alert-success').text("Задание успешно сохранено");
        $('.alert-success').show("slow");
        setTimeout(() => $('.alert-success').hide(500), 2000);
    }

    function validate(email, userName, task) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        var address = email;
        if (userName == '' || task == '') {
            $('.text-danger').text('Заполните все поля');
            return false;
        }

        if (reg.test(address) == false) {
            $('.text-danger').text('Неверный емейл');
            return false;
        } else
            return true;
    }

    function addRow(tableID, elements, id = false) {

        var tableRef = document.getElementById(tableID);
        var colCount = tableRef.rows[0].cells.length;

        var newRow = tableRef.insertRow(-1);

        if (id)
            newRow.setAttribute('id', id);

        elements.forEach(function (element) {

            var newCell = newRow.insertCell(-1);

            var newText = document.createTextNode(element);

            newCell.appendChild(newText);
        })

        if (colCount == 6) {
            var newCell = newRow.insertCell(-1);

            var newText = document.createTextNode('');

            newCell.appendChild(newText);

            var newCell = newRow.insertCell(-1);

            var newTag = document.createElement('INPUT');
            newTag.setAttribute("class", 'checkTask');
            newTag.setAttribute("type", "checkbox");

            newCell.appendChild(newTag);
        }

        var newCell = newRow.insertCell(-1);

        var newText = document.createTextNode('Не выполнено');

        newCell.appendChild(newText);
    }

    form.addEventListener("focus", () => $('.text-danger').text(''), true);

});