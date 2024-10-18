$("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'pill wizard'
});
// $("#circle-basic").steps({
//     headerTag: "h3",
//     bodyTag: "section",
//     transitionEffect: "slideLeft",
//     autoFocus: true,
//     cssClass: 'circle wizard'
// });
$("#circle-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'circle wizard',
    onFinished: function (event, currentIndex) {
        // Prevent default form submission behavior
        event.preventDefault();

        // Show loading overlay and freeze the page
        $("#loadingOverlay").fadeIn();

        // Submit the createPost form first
        $.ajax({
            url: $("#createPost").attr('action'),
            type: 'POST',
            data: new FormData($("#createPost")[0]),
            contentType: false,
            processData: false,
            success: function(response) {
                // Once createPost is successfully submitted, submit the uploadImages form
                $.ajax({
                    url: $("#uploadImages").attr('action'),
                    type: 'POST',
                    data: new FormData($("#uploadImages")[0]),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // After both forms are submitted, hide the overlay and redirect
                        $("#loadingOverlay").fadeOut();
                        window.location.href = '/posts/items'; // Replace with your desired redirect URL
                        alert('Both datas saved Successfully');
                    },
                    error: function(xhr) {
                        // Hide the overlay and handle the error
                        $("#loadingOverlay").fadeOut();
                        console.error('Error submitting #uploadImages', xhr);
                        alert('Error uploading images');
                    }
                });
            },
            error: function(xhr) {
                // Hide the overlay and handle the error
                $("#loadingOverlay").fadeOut();
                console.error('Error submitting #createPost', xhr);
                alert('Error submitting post');
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