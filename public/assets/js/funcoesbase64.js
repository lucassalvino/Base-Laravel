function getBase64(file, callbacksuccess, callbackerror) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = callbacksuccess;
    reader.onerror = callbackerror;
}
function uploadPhoto64(e, inputfile, inputphoto, inputmime, pathloadimage) {
    var file = e.target.files[0];
    getBase64(file, loaded, errorfunc);
    function loaded(e) {
        var fileString = e.target.result;
        var part_one = fileString.split("data:")[1];
        var type_mime = part_one.split(";base64")[0];
        var splited = fileString.split("base64,");
        $(inputphoto).val(splited[1]);
        $(inputmime).val(type_mime);
        if (pathloadimage) {
          $(pathloadimage).attr('src', fileString);
        }
    }
    function errorfunc(e) {
        console.log("Error base64 image", e.target.error);
    }
}