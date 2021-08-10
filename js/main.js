$(document).ready(function() {
	$("#capture").click(function(event) {			
		/* Act on the event */
		$(".hide-modal").click();
			Webcam.set({
			width: 240,
			height: 220,
			dest_width: 240,
			dest_height: 240,
			image_format: 'png',
			jpeg_quality: 100				
		});
		Webcam.attach( '#my-pic');
	});


	$("#snap").click(function(event) {
		/* Act on the event */

		Webcam.snap( function(data_uri) {
			//document.getElementById('my_result').innerHTML = '<img src="'++'"/>';
			$("#img").attr('src', data_uri);
		} );
		$(".close-modal").click();
		Webcam.reset();
		//$("#browse").hide();
	});

	$("#browse").click(function(event) {
		/* Act on the event */
		$("#picture").click();
	});

	$("#picture").change(function(event) {
		/* Act on the event */
		readURL(this,"#img");
	});
});

function readURL(input,link) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(link).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}