function deleteUser() {
    const confirmacao = confirm('Você tem certeza que deseja deletar este usuário?');
    return confirmacao;
}

function deleteProject(e) {
    e.preventDefault();
    
    const submitForm = document.getElementById('delete');
    const confirmacao = confirm('Você tem certeza que deseja deletar este projeto?');

    if (confirmacao === true) {
        submitForm.submit();
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