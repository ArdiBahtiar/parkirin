$("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'pill wizard'
});
$("#edit-circle").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'circle wizard',
    onFinished: function (event, currentIndex) {
        event.preventDefault();

        $("#loadingOverlay").fadeIn();

        var formData = new FormData($("#editPost")[0]);
        formData.append('_method', 'PUT');
        
        $.ajax({
            url: $("#editPost").attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false, 
            success: function(response) {
                $("#loadingOverlay").fadeOut();

                window.location.href = '/posts/items';
                alert('Post and images saved successfully');
            },
            error: function(xhr) {
                $("#loadingOverlay").fadeOut();
                console.error('Error submitting form', xhr);
                alert('Error saving post or images');
            }
        });
    }
});
$("#circle-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'circle wizard',
    onFinished: function (event, currentIndex) {
        event.preventDefault();

        $("#loadingOverlay").fadeIn();

        var formData = new FormData($("#createPost")[0]);

        $.ajax({
            url: $("#createPost").attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false, 
            success: function(response) {
                $("#loadingOverlay").fadeOut();

                window.location.href = '/posts/items';
                alert('Post and images saved successfully');
            },
            error: function(xhr) {
                $("#loadingOverlay").fadeOut();
                console.error('Error submitting form', xhr);
                alert('Error saving post or images');
            }
        });
    }
});
$("#example-vertical").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    cssClass: 'circle wizard',
    titleTemplate: '<span class="number">#index#</span>',
    stepsOrientation: "vertical"
});
$("#pill-vertical").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    cssClass: 'pills wizard',
    titleTemplate: '#title#',
    stepsOrientation: "vertical"
});