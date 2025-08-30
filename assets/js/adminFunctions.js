function deleteUser(e) {
    e.preventDefault();

    const form = e.target.parentNode;
    const confirmacao = confirm('Você tem certeza que deseja deletar este usuário?');

    if (confirmacao === true) {
        form.submit();
    }
}


function adminFunction() {
    const confirmacao = confirm('Você tem certeza que deseja tornar este usuário administrador?');
    return confirmacao;
}

function standardFunction() {
    const confirmacao = confirm('Você tem certeza que deseja tornar este administrador um usuário padrão?');
    return confirmacao;
}