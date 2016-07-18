<script src="uploader.js"></script>
<script type="text/javascript">
window.addEventListener("load", function() {
    var input = document.getElementById("material");
    //var img = document.getElementById("material");
    //var previewBtn = document.getElementById("preview");
    /*previewBtn.addEventListener("click", function() {
        img.src = input.files[0].getAsDataURL();
    }, false);*/

    //var form = document.getElementsByTagName("form")[0];
	var form = document.getElementById("marketing_product")[0];
    var uploader = new Uploader(form);
    var uploadBtn = document.getElementById("formsubmit");

    uploadBtn.addEventListener("click", function() {
        uploader.send();
    }, false);

}, false);
</script>
<script type="text/javascript">
function showformmaterial(id)
{
	alert(id);
	document.getElementById('material_id').value=id;
}

$('#formsubmitss').click(function (e) {
    
	var data;
	var formData = new FormData($('#marketing_product')[0]);
	//alert(formData.l_id);
   // data = new FormData(var formData = new FormData($('*formId*')[0]););
    //formData.append('file', $('#material')[0].files[0]);
	alert(formData.l_id);
    $.ajax({
        url: 'submit.php',
        data: formData,
        processData: false,
        type: 'POST',

        // This will override the content type header, 
        // regardless of whether content is actually sent.
        // Defaults to 'application/x-www-form-urlencoded'
        contentType: 'multipart/form-data', 

        //Before 1.5.1 you had to do this:
        beforeSend: function (x) {
            if (x && x.overrideMimeType) {
                x.overrideMimeType("multipart/form-data");
            }
        },
        // Now you should be able to do this:
        mimeType: 'multipart/form-data',    //Property added in 1.5.1

        success: function (data) {
            alert(data);
        }
    });

    e.preventDefault();
});
</script>