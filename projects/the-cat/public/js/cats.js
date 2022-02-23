var api_url = 'http://127.0.0.1:8000/api/breeds';
var url = 'http://127.0.0.1:8000/';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#buscar").click(function (e) {
    clearBreed();
    var name = $("#name").val();
    var tamanho = name.length;

    if (tamanho < 3) {
        alert('Digite no mínimo 3 letras');
        return false;
    }
    searchDB(name);

    // getCatByBreed(name);
});

function searchDB(name) {
    $.ajax({
        url: api_url,
        type: 'GET',
        dataType: 'JSON',
        contentType: 'application/json',
        data: {'name': name},
        success: function(result){
            if (result.length > 0) {
                for (let index = 0; index < result.length; index++) {
                    const element = result[index];
                    displayBreed(element);
                }
            } else {
                searchAPI(name);
            }
        },
        error: function(error) {
            console.log(error.responseJSON.message);
        }
    });

    return true;
}

function searchAPI(name) {
    ajax_get('https://api.thecatapi.com/v1/breeds/search?q=' + name, function(data) {
        if (data.length == 0) {
            $("#mensagem_erro").append("Nenhuma raça encontrada");
        } else {
            getImageCat(data);
        }
    });
}

function getImageCat(data) {
    for (let index = 0; index < data.length; index++) {
        const element = data[index];
        ajax_get('https://api.thecatapi.com/v1/images/' + element.reference_image_id, function(data) {
            saveCat(data);
            var breed_data = data.breeds[0];
            breed_data.url_image = data.url;

            displayBreed(breed_data);
        });
    }
}

function saveCat(data) {
    $.ajax({
        url: api_url,
        type: 'POST',
        dataType: 'JSON',
        contentType: 'application/json',
        data:JSON.stringify(data),
        success: function(result){
            console.log(result);
        },
        error: function(error) {
            console.log(error.responseJSON.message);
        }
    });
}

// display the breed image and data
function displayBreed(data) {
    $("#resultado").append('<div align="center"><img class="breed_image" src="' + data.url_image + '"/></div>');
    $("#resultado").append('<table class="breed_data_table"></table>');
    $("#resultado").append("<tr><td class='w200'><b>Nome</b></td><td>" + data.name + "</td></tr>");
    $("#resultado").append("<tr><td class='w200'><b>Origem</b></td><td>" + data.origin + "</td></tr>");
    $("#resultado").append("<tr><td class='w200'><b>Peso</b></td><td>" + data.weight_metric + "</td></tr>");
    $("#resultado").append("<tr><td class='w200'><b>Tempo de vida</b></td><td>" + data.life_span + "</td></tr>");
    $("#resultado").append("<tr><td class='w200'><b>Wikipedia</b></td><td><a href='" + data.wikipedia_url + "' target='_blank'>" + data.wikipedia_url + "</a></td></tr>");
    $("#resultado").append("<tr><td class='w200'><b>Descrição</b></td><td>" + data.description + "</td></tr>");
    $("#resultado").append('</table>');
    $("#resultado").append('<hr>');
}

// clear the image and table
function clearBreed() {
    $('#resultado').html('');
    $("#mensagem_erro").html('');
}

// make an Ajax request
function ajax_get(url, callback) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        try {
            var data = JSON.parse(xmlhttp.responseText);
        } catch (err) {
            return;
        }
        callback(data);
        }
    };

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

