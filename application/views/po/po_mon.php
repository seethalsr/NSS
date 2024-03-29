<!doctype html>
<html>
<head>
<title>Proper Title</title>
<style>
    #selectedFiles img {
        max-width: 125px;
        max-height: 125px;
        float: left;
        margin-bottom:10px;
    }
</style>
</head>
    
<body>
    
    <form id="myForm" method="post" enctype="multipart/form-data">

        Files: <input type="file" id="files" name="files" multiple accept="image/*"><br/>

        <div id="selectedFiles"></div>

        <input type="submit">
    </form>

    <script>
    var selDiv = "";
        
    document.addEventListener("DOMContentLoaded", init, false);
    
    function init() {
        document.querySelector('#files').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }
        
    function handleFileSelect(e) {
        
        if(!e.target.files || !window.FileReader) return;

        selDiv.innerHTML = "";
        
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function(f) {
            var f = files[i];
            if(!f.type.match("image.*")) {
                return;
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                var html = "<img src=\"" + e.target.result + "\">" + f.name + "<br clear=\"left\"/>";
                selDiv.innerHTML += html;               
            }
            reader.readAsDataURL(f); 
        });
        
    }
    </script>

</body>
</html>