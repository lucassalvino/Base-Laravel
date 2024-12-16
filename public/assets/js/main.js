$(document).ready(function () {
    switch (paginajsimport) {
        case 'cobranca':
            $.getScript("/assets/js/paginas/internaCobranca.js");
            break;
    }
});

function formatarMoeda(campo) {
    let valor = campo.value;
    valor = valor.replace(/[\D\s]/g, "");
    if (valor === "00") {
        campo.value = "";
        return;
    }
    valor = (valor / 100).toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL"
    });
    campo.value = valor.replace(/\s/g, "");
}

function mascaraCpfCnpj(component) {
    const input = component
    let valor = input.value.replace(/\D/g, "");
    if (valor.length <= 11) {
        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
        valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    } else {
        valor = valor.replace(/^(\d{2})(\d)/, "$1.$2");
        valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        valor = valor.replace(/\.(\d{3})(\d)/, ".$1/$2");
        valor = valor.replace(/(\d{4})(\d{1,2})$/, "$1-$2");
    }
    input.value = valor;
}