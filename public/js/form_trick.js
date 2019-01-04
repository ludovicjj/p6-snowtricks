let $videoWrapper = $('.wrapper-video');

/* -------------------------- Video -------------------------- */

// Evenemnt click pour supprimer un Form Video
$(document).on('click', '.remove-video', function(e) {
    e.preventDefault();
    let videoContainer = $(this).closest($(".video-container"));
    videoContainer.remove();
});

// Evenement click pour ajouter un form Video
$(document).on('click', '.video-add', function(e) {
    e.preventDefault();
    let prototype = $videoWrapper.data('prototype');
    let index = $videoWrapper.data('index');
    let newFormVideo = prototype.replace(/__name__/g, (index+1));


    $videoWrapper.data('index' , index + 1);
    $(this).parent().after(newFormVideo);
});