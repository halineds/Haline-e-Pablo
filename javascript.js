function salvar(){
    if(validar()){
        document.getElementById("codAluno").value = '';
        document.getElementById("acao").value = 'SALVAR';
        document.getElementById("cadAluno").submit();
    }
}

function editar(id){
    document.getElementById("acao").value = 'EDITAR';
    document.getElementById("codAluno").value = id;
    document.getElementById("cadAluno").submit();
}

function excluir(id){
    document.getElementById("acao").value = 'EXCLUIR';
    document.getElementById("codAluno").value = id;  
    document.getElementById("cadAluno").submit();
}

function limpar(){
    document.getElementById("acao").value = '';
    document.getElementById("codAluno").value = '';
    document.getElementById("nome").value = '';
    document.getElementById("nome").style.backgroundColor = '#fff';
    document.getElementById("email").value = '';
    document.getElementById("email").style.backgroundColor = '#fff';
    document.getElementById("celular").value = '';
    document.getElementById("celular").style.backgroundColor = '#fff';
    document.getElementById("mensagem").innerHTML = "";
}

function validar(){

    if(document.getElementById("nome").value == ''){
        //alert("Campo Nome é Obrigatório!");
        document.getElementById("nome").style.backgroundColor = 'yellow';
        document.getElementById("mensagem").innerHTML = "Campo Nome é Obrigatório!";
        return false;
    }

    if(document.getElementById("email").value == ''){
        //alert("Campo E-mail é Obrigatório!");
        document.getElementById("email").style.backgroundColor = 'yellow';
        document.getElementById("mensagem").innerHTML = "Campo E-mail é Obrigatório!";
        return false;
    }

    if(document.getElementById("celular").value == ''){
        //alert("Campo Celular é Obrigatório!");
        document.getElementById("celular").style.backgroundColor = 'yellow';
        document.getElementById("mensagem").innerHTML = "Campo Celular é Obrigatório!";
        return false;
    }

    return true;
}
