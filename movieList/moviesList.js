$(document).ready(function() {
    $('#successModal').on('hidden.bs.modal', function (e) {
        location.reload();
    });

    $('#errorModal').on('hidden.bs.modal', function (e) {
        location.reload(); 
    });
});

function submitForm() {
    var form = $('#movieForm');
    var url = form.attr('action');
    var formData = form.serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function(response) {
            if (response.trim() === "success") {
                $('#successModal').modal('show');
            } else {
                $('#errorText').text(response.trim());
                $('#errorModal').modal('show');
            }
        }
    });

    return false; 
}

    function anaktisi_movies() {
        $.ajax({
            url: 'anaktisi_movies.php',
            type: 'GET',
            success: function (response) {
                $('#moviesList').html(response);
            }
        });
    }

    function closeList() {
        $('#moviesList').empty();
    }

    $(document).on("click", ".delete-movie", function() {
        var movieId = $(this).data("movie-id");
        $('#deleteConfirmationModal').modal('show');

        $('#confirmDeleteButton').click(function() {
            $.ajax({
                url: "delete_movies.php",
                type: "POST",
                data: { id: movieId },
                success: function(response) {
                    alert(response); 
                    location.reload(); 
                }
            });
        });
    });

    $('#cancelDeleteButton').click(function() {
        $('#deleteConfirmationModal').modal('hide');
    });


    function deleteAllMovies() {
        $('#deleteAllConfirmationModal').modal('show');
    }

    $(document).on("click", ".confirm-delete-all", function() {
        $.ajax({
            url: "delete_all_movies.php",
            type: "POST",
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });
    
    function searchAndDisplayImage(title, description, cardElement) {
        var apiKey = 'AIzaSyB4smVusg7hpv8VFkmiUukCW4SGK6emysE';
        var customSearchEngineId = 'a47e78fc0f59145b0';
        var query = title + ' ' + description + ' movie poster';
        var apiUrl = 'https://www.googleapis.com/customsearch/v1?key=' + apiKey + '&cx=' + customSearchEngineId + '&q=' + encodeURIComponent(query) + '&searchType=image';

        $.ajax({
            url: apiUrl,
            type: 'GET',
            success: function(response) {
                if (response.items && response.items.length > 0) {
                    var imageUrl = response.items[0].link;              
                    $('#' + cardElement).html('<img src="' + imageUrl + '" class="img-fluid" style="width: 5cm; margin: auto; display: block; text-align: center;">');
                    } else {
                        $('#' + cardElement).html('<p>No image found for this movie.</p>');
                    }
                                },
            error: function() {
                $('#' + cardElement).html('<p>Error searching for the image.</p>');
            }
        });
    }