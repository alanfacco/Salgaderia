$(function() {
    if ($("nav.topo-menu>ul").length) {
        console.log("existe menu topo");
        $("nav.topo-menu").append('<span class="carregando">Carregando...</span>');
        $.getJSON("json/menu.json", function(data) {
            $("nav.topo-menu span.carregando").hide();
            $("nav.topo-menu>ul").html(treeArray(data));
        });
    }
    
    if ($("aside.painel>ul").length) {
        console.log("existe painel");
        $("aside.painel").append('<span class="carregando">Carregando...</span>');
        $.getJSON("json/barra.json", function(data) {
            $("aside.painel span.carregando").hide();
            $("aside.painel>ul").append(treeArray(data));
        });
    }

    if ($("ul.swiper-wrapper").length) {
        console.log("existe destaque");
        $("ul.swiper-wrapper").append('<span class="carregando">Carregando...</span>');
        $.getJSON("json/destaque.json", function(data) {
            $("ul.swiper-wrapper").append(overtopArray(data));

            var mySwiper = new Swiper('.swiper-container', {
                speed: 300,
                mode: 'horizontal',
                autoplay: 10000,
                DOMAnimation: true,
                preventLinks: true,
                keyboardControl: true,
                pagination: '.pagination',
                paginationClickable: true,
                moveStartThreshold: 50
            });
            $("ul.swiper-wrapper span.carregando").hide();
        });
    }

    if ($("#categoria").length) {
        console.log("existe categoria");
        $("#categoria").html('<option class="carregando" disable>Carregando...</option>');
        $.getJSON("../control/json.php?v=categoria", function(data) {
            var lista = "";
            $.each(data, function(k, v) {
                lista += '<option value="' + v['idCategoria'] + '">' + v['categoria'] + '</option>';
            });
            $("#categoria").html(lista);
        });

        $("#categoria").change(function() {
            if ($("#subcategoria").length) {
                console.log("existe subcategoria");
                $("#subcategoria").html('<option class="carregando" disable>Carregando...</option>');
                $.getJSON("../control/json.php?v=subcategoria&id=" + $("#categoria").val(), function(data) {
                    var lista = '';
                    if (Object.keys(data).length > 1) {
                        var lista = '<option value="" selected disabled>Selecione a subcategoria</option>';
                        $.each(data, function(k, v) {
                            lista += '<option value="' + v['idCategoria'] + '">' + v['categoria'] + '</option>';
                        });
                    } else {
                        $.each(data, function(k, v) {
                            lista += '<option value="' + v['idCategoria'] + '">' + v['categoria'] + '</option>';
                        });
                    }
                    $("#subcategoria").html(lista);
                });
            }
        });
    }
    if ($("#ingredientes").length) {
        console.log("existe ingrediente");
        $("#ingredientes").html('<span class="carregando">Carregando...</span>');
        $.getJSON("../control/json.php?v=ingrediente", function(data) {
            var lista = "";
            $.each(data, function(k, v) {
                lista += '<div class="content-half-col">'
                        + '  <input type="checkbox" id="ingrediente' + v['idIngrediente'] + '" name="ingrediente" value="' + v['idIngrediente'] + '">'
                        + '  <label for="ingrediente' + v['idIngrediente'] + '"> ' + v['ingrediente'] + '</label>'
                        + '</div>';
            });
            $("#ingredientes span.carregando").hide();
            $("#ingredientes").append(lista);
        });
    }
});

function treeArray(data) {
    var item = '';
    $.each(data, function(k, v) {
        item += '<li><a href="' + v.link + '">' + v.texto + '</a>';
        if (v.subitem) {
            item += '<ul>';
            item += treeArray(v.subitem);
            item += '</ul>';
        }
        item += '</li>';
    });
    return item;
}

function overtopArray(data) {
    var item = '';
    $.each(data, function(k, v) {
        item += '<li class="swiper-slide">' +
                '<a href="' + v.link + '">' +
                '<div class="destaque-imagem" style="background-image: url(' + v.imagem + ')"></div>' +
                '<h1 class="destaque-titulo destaque-direita">' + v.titulo + '</h1>' +
                '<div class="destaque-detalhe destaque-esquerda">' +
                '<p class="destaque-descricao">' + v.descricao + '</p>' +
                '<p class="destaque-preco">' +
                '<span class="destaque-valor">' + v.precoreal + '</span>' +
                '<span class="destaque-centavos">,' + v.precocentavos + '</span>' +
                '</p>' +
                '</div>' +
                '</a>' +
                '</li>';
    });
    return item;
}