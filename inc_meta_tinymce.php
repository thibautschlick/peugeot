<?php
    // si edit, tiny mce editor 
    //if ($page == 'edit')
    if ($page == 'edit' OR $page == 'edit_document')
    {
        ?>
            <script type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
            <script>
               // tinymce.init({ selector:'textarea' });
              //  
              //  tinymce.init({
              //  selector: 'textarea',
              //  height: 500,
              //  //toolbar: 'mybutton',
              //  menubar: false,
              //  setup: function (editor) {
              //    editor.addButton('mybutton', {
              //      text: 'B',
              //      icon: false,
              //      onclick: function () {
              //        //editor.insertContent('&nbsp;<b>It\'s my button!</b>&nbsp;');
              //        editor.insertContent('<b>It\'s my button!</b>');
              //      }
              //    });
              //  },
              //  content_css: [
              //    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
              //    '//www.tinymce.com/css/codepen.min.css'
              //  ]
              //});
                      
                      
                    // pris de https://www.tinymce.com/docs/demo/classic/ et adapté
                      
            tinymce.init({
          selector: "textarea",
		  element_format : 'xhtml', // cf https://www.tinymce.com/docs/configure/content-filtering/
		  forced_root_block : false, // idem // fait un br aux sauts de ligne sinon 'p' pour faire un <p> aux sauts de ligne.
		  
		  entity_encoding : "numeric",
			// named	Characters will be converted into named entities based on the entities option. For example, a non-breaking space could be encoded as &nbsp;. This value is default.
			//numeric	Characters will be converted into numeric entities. For example, a non-breaking space would be encoded as &#160;.
			//raw	All characters will be stored in non-entity form except these XML default entities: & < > "
			

          height: 200,
          plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
          ],
		  //deleted des plugins => fullpage // sinon ajoute html, head, body, p, etc. => http://community.tinymce.com/forum/viewtopic.php?id=30645
        
        // origine
          //toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
          //toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
          //toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
          //
        //personalisation :
          toolbar1: "bold italic | subscript superscript | cut copy paste | bullist numlist | undo redo | link unlink anchor code | nonbreaking",
          //toolbar1: "bold italic | subscript superscript | cut copy paste | undo redo | ",
          //toolbar2: "",
          //toolbar3: "",
        
          menubar: false,
          toolbar_items_size: 'small',
        
        
        
          style_formats: [{
            title: 'Bold text',
            inline: 'b'
          }, {
            title: 'Red text',
            inline: 'span',
            styles: {
              color: '#ff0000'
            }
          }, {
            title: 'Red header',
            block: 'h1',
            styles: {
              color: '#ff0000'
            }
          }, {
            title: 'Example 1',
            inline: 'span',
            classes: 'example1'
          }, {
            title: 'Example 2',
            inline: 'span',
            classes: 'example2'
          }, {
            title: 'Table styles'
          }, {
            title: 'Table row 1',
            selector: 'tr',
            classes: 'tablerow1'
          }],
        
          templates: [{
            title: 'Test template 1',
            content: 'Test 1'
          }, {
            title: 'Test template 2',
            content: 'Test 2'
          }],
          content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
          ]
        });
                      
                      
                      
            </script>
    
        <?php
    }
    ?>



