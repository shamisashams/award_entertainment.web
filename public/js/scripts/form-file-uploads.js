$(document).ready(function(){
    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove:  'Supprimer',
            error:   'Désolé, le fichier trop volumineux'
        }
    });

    // Used events
    var drEvent = $('.dropify-event').dropify();
    var dropvent = $('.dropify').dropify();

    drEvent.on('dropify.beforeClear', function(event, element){
        return confirm("Do you really want to delete \"" + element.filename + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element){
        alert('File deleted');
    });

    dropvent.on('dropify.afterClear', function (event, elemtn) {
        let image = document.querySelector('#old-main');
        image.value = "";
    });

    $("#input-file-now").change(function () {
        let image = document.querySelector('#old-main');
        image.value = "";
    });
});
