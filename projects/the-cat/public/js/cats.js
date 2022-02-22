$("#buscar").click(function (e) {
    var nome = $("#nome").val();
    var tamanho = nome.length;

    if (tamanho < 3) {
        alert('Digite no mínimo 3 letras');
        return false;
    }

    getCatByBreed(nome);

});

function getCatByBreed(breed) {
    // search for images that contain the breed (breed_id=) and attach the breed object (include_breed=1)
    ajax_get('https://api.thecatapi.com/v1/breeds/search?q=' + breed, function(data) {
        if (data.length == 0) {
            clearBreed();
            $("#mensagem_erro").append("Nenhuma raça encontrada");
        } else {
            $("#mensagem_erro").html('');
            getImageCat(data[0].reference_image_id);
        }
    });
}

function getImageCat(image_id) {
    ajax_get('https://api.thecatapi.com/v1/images/' + image_id, function(data) {
        displayBreed(data);
    });
}

// clear the image and table
function clearBreed() {
    $('#breed_image').attr('src', "");
    $("#breed_data_table tr").remove();
    $("#mensagem_erro").html('');
}

// display the breed image and data
function displayBreed(image) {
    $('#breed_image').attr('src', image.url);
    $("#breed_data_table tr").remove();

    var breed_data = image.breeds[0];

    var total = image.breeds.length;

    alert(total);

    $("#breed_data_table").append("<tr><td>Nome</td><td>" + breed_data.name + "</td></tr>");
    $("#breed_data_table").append("<tr><td>Origem</td><td>" + breed_data.origin + "</td></tr>");
    $("#breed_data_table").append("<tr><td>Peso</td><td>" + breed_data.weight.metric + "</td></tr>");
    $("#breed_data_table").append("<tr><td>Tempo de vida</td><td>" + breed_data.life_span + "</td></tr>");
    $("#breed_data_table").append("<tr><td>Descrição</td><td>" + breed_data.description + "</td></tr>");
    $("#breed_data_table").append("<tr><td>Wikipedia</td><td><a href='" + breed_data.wikipedia_url + "' target='_blank'>" + breed_data.wikipedia_url + "</a></td></tr>");

    // $.each(breed_data, function(key, value) {
    //     // as 'weight' and 'height' are objects that contain 'metric' and 'imperial' properties, just use the metric string
    //     if (key == 'weight' || key == 'height') value = value.metric
    //     // add a row to the table
    //     $("#breed_data_table").append("<tr><td>" + key + "</td><td>" + value + "</td></tr>");
    // });
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

