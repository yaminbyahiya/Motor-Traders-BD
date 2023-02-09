<!DOCTYPE html>
<html>
<head>
<script src="tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist anchor autolink charmap code colorpicker contextmenu directionality emoticons fullscreen hr",
        "image insertdatetime link lists media nonbreaking pagebreak paste preview print",
        "save searchreplace spellchecker table template textcolor textpattern visualblocks visualchars wordcount"
    ],
    spellchecker_rpc_url: 'spellchecker.php',

    menubar: false,
    toolbar_items_size: 'big',	//small
	toolbar1: "cut copy paste | insertfile undo redo | outdent indent | searchreplace hr | blockquote | bullist numlist | charmap emoticons | preview code",
    toolbar2: "fontsizeselect forecolor backcolor | bold italic underline | alignleft aligncenter alignright alignjustify | link unlink media image",
    // styleselect strikethrough fontselect spellchecker
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
</head>

<body>
<div style="width:650px;"><textarea style="height:500px;"><span style="font-size: 12pt;">&#2437;&#2438;&#2439;&#2440;....</span></textarea></div>
</body>
</html>
