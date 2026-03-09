<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/materialNote.css" rel="stylesheet">
    <link href="css/codeMirror/codemirror.css" rel="stylesheet">
    <link href="css/codeMirror/monokai.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    
    <script type="text/javascript" src="lib/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="lib/materialize.js"></script>
    <script type="text/javascript" src="js/ckMaterializeOverrides.js"></script>

    <script type="text/javascript" src="lib/codeMirror/codemirror.js"></script>
    <script type="text/javascript" src="lib/codeMirror/xml.js"></script>
    <script type="text/javascript" src="js/materialNote.js"></script>
</head>

<body>
    

    <main>
    <?php print_r($_POST);?>
    
    
        <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
            
            <textarea name="description" class="editor" id="first"><?php print_r($_POST['description']);?></textarea>
            
            
                
            </div>
        </div>
        <input type="submit" value="submit">
        </form>
        


    <script type="text/javascript">
        var toolbar = [
            ['style', ['style', 'bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['fonts', ['fontsize', 'fontname']],
            ['color', ['color']],
            ['undo', ['undo', 'redo', 'help']],
            ['ckMedia', ['ckImageUploader', 'ckVideoEmbeeder']],
            ['misc', ['link', 'picture', 'table', 'hr', 'codeview', 'fullscreen']],
            ['para', ['ul', 'ol', 'paragraph', 'leftButton', 'centerButton', 'rightButton', 'justifyButton', 'outdentButton', 'indentButton']],
            ['height', ['lineheight']],
        ];

        $('.editor').materialnote({
            toolbar: toolbar,
            height: 550,
            minHeight: 100,
            defaultBackColor: '#fff'
        });

        $('.editorAir').materialnote({
            airMode: true,
            airPopover: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']]
            ]
        });
    </script> 
</body>
</html>