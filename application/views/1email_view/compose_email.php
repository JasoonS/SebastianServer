<link href="<?php echo THEME_ASSETS;?>css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<link href="<?php echo THEME_ASSETS;?>css/email/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS;?>css/animate.min.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS;?>css/email/custom.css" rel="stylesheet">
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<link href="<?php echo THEME_ASSETS;?>css/email/icheck/flat/green.css" rel="stylesheet">	
<script src="<?php echo THEME_ASSETS;?>/js/email.js"></script>
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS;?>css/editor/index.css" rel="stylesheet">
 <script src="<?php echo THEME_ASSETS;?>js/editor/bootstrap-wysiwyg.js"></script>
 <script src="<?php echo THEME_ASSETS;?>js/editor/external/jquery.hotkeys.js"></script>
 <script src="<?php echo THEME_ASSETS;?>js/editor/external/google-code-prettify/prettify.js"></script>
  <script src="<?php echo THEME_ASSETS;?>js/editor/char_counter.min.js"></script>
<div class="right_col" role="main"  id="email">
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Compose Email</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">


                                <div id="alerts"></div>
								<div class="form-group row">
										<label class="col-sm-2" for="inputTo">To</label>
										<div class="col-sm-10"><input class="form-control" id="inputTo" placeholder="comma separated list of recipients" type="email"></div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2" for="inputSubject">Subject</label>
									<div class="col-sm-10"><input class="form-control" id="inputSubject" placeholder="subject" type="text"></div>
								</div>
                                <div class="form-group row">
									
									
								<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa icon-font"></i><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a data-edit="fontSize 5"><p style="font-size:17px">Huge</p></a>
                                            </li>
                                            <li><a data-edit="fontSize 3"><p style="font-size:14px">Normal</p></a>
                                            </li>
                                            <li><a data-edit="fontSize 1"><p style="font-size:11px">Small</p></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
                                        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
                                        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
                                        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
                                        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
                                        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
                                        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
                                        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
                                        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
                                        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
                                        <div class="dropdown-menu input-append">
                                            <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                            <button class="btn" type="button">Add</button>
                                        </div>
                                        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>

                                    </div>

                                    <!--<div class="btn-group">
                                        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
                                        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                                    </div>-->
                                    <div class="btn-group">
                                        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
                                        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
                                    </div>
                                </div>
                             
                                <div id="editor" >
                                    
                                </div>
                                <textarea name="descr" id="descr" style="display:none;"></textarea>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="compose-btn pull-right" id="send" >
									<a class="btn btn-sm btn-primary" href="#" onclick="sendEmail();"><i class="fa fa-reply"></i> Send </a>
                               

								</div>
                               

                            </div>
                        </div>
                    </div>	
        </div>
</div>
 <!-- editor -->
        <script>
            $(document).ready(function () {
                $('.xcxc').click(function () {
                    $('#descr').val($('#editor').html());
                });
            });

            $(function () {
                function initToolbarBootstrapBindings() {
                    var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'],
                        fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                    $.each(fonts, function (idx, fontName) {
                        fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                    });
                    $('a[title]').tooltip({
                        container: 'body'
                    });
                    $('.dropdown-menu input').click(function () {
                            return false;
                        })
                        .change(function () {
                            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                        })
                        .keydown('esc', function () {
                            this.value = '';
                            $(this).change();
                        });

                    $('[data-role=magic-overlay]').each(function () {
                        var overlay = $(this),
                            target = $(overlay.data('target'));
                        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                    });
                    if ("onwebkitspeechchange" in document.createElement("input")) {
                        var editorOffset = $('#editor').offset();
                        $('#voiceBtn').css('position', 'absolute').offset({
                            top: editorOffset.top,
                            left: editorOffset.left + $('#editor').innerWidth() - 35
                        });
                    } else {
                        $('#voiceBtn').hide();
                    }
                };

                function showErrorAlert(reason, detail) {
                    var msg = '';
                    if (reason === 'unsupported-file-type') {
                        msg = "Unsupported format " + detail;
                    } else {
                        console.log("error uploading file", reason, detail);
                    }
                    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
                };
                initToolbarBootstrapBindings();
                $('#editor').wysiwyg({
                    fileUploadError: showErrorAlert
                });
                window.prettyPrint && prettyPrint();
			
            });
	function sendEmail()
	{
		alert($("#editor").html().length);
		
		alert($("#inputTo").val());
		alert($("#inputSubject").val());
		$.ajax({
					url: request_url,
					type:"post",
					data:{flag:"28","email_message":$("#editor").html(),"inputTo":$("#inputTo").val(),"inputSubject":$("#inputSubject").val()},
					dataType:"json",
					async: "false",
					success:function(msg){
								var data = msg;
								console.log("HERE");
							},
					error:function(msg){
						console.log("failuer");
					}
				});
        				
	}
			
</script>