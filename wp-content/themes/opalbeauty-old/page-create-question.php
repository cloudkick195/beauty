<?php /* Template Name: Create Question  */ ?>

<?php get_header();?>
<?php header_page('Post question');?>
<main class="creator-page">
    
    <form id="form-event-create" class="opal-forms forms-vertical form-action" method="POST">
        
        <button id="submit-create-event" type="button"
                class="sticky-action-btn">
                <img src="<?php theme_path('/assets/images/arrow-right.svg')?>">
                <img class="img-sub-active" src="<?php theme_path('/assets/images/arrow-right-red.svg')?>">
            </button>
        <div class="form-group wrap">
            <div class="field text-field question_title">
                <div>
                    <label>
                        <?php _e('Title', 'opalbeauty')?>
                    </label>
                    <input class="input-form require" name="question_title" type="text" value="">
                </div>
                <!-- <p class="mess"></p> -->
            </div>
            <div class="field textarea-field question_detail">
                <div>
                    <label>
                        <?php _e('Question detail', 'opalbeauty')?>
                        
                    </label>
                    <textarea name="question_detail" id="" cols="30" rows="10"></textarea>
                </div>
                <!-- <p class="mess"></p> -->
            </div>
            <div class="field checkbox-field checkbox-field2 question_category">
                <label for="specialist">
                    <?php _e('Category', 'opalbeauty')?>
                </label>
                <div>
                    <div class="box-select">
                        <div class="custom-select2">
                        <?php
                            $taxonomies = get_terms( array(
                                'taxonomy' => 'question_category',
                                'hide_empty' => false,
                            ) );
                            if ( !empty($taxonomies) ) :
                                foreach( $taxonomies as $tax ) :?>
                           
                            <label><?php echo $tax->name?>
                                <input type="checkbox" name="question_category" value="<?php echo $tax->term_id; ?>">
                                <span class="checkmark"></span>
                            </label>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <?php 
                $img_question = '
                    <img class="main question-img"
                        src="'.get_theme_path("/assets/images/plus-gray.svg").'">
                ';
                $classM = '';
                // if($user['question']){
                //     $img_question = ' <img id="question-img" class="main question-img"
                //     src="'.$user['question'].'">';
                //     $classM = 'active';
                // }
            ?>
            <div class="field image-field question_image">
                <script>
                function preview_image(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var img = input.nextElementSibling.children;
                        reader.onload = function(e) {
                            input.parentElement.parentElement.classList.add("active");
                            img[0].src = e.target.result;
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                </script>
                 
                <div class="box-mutiple">
                    <div class="box-item">
                        <label class="text-center">
                            
                            <input type="file" class="inputfile inputfile-4" name="question_image[]"
                                accept="image/png, image/gif, image/jpeg" onchange="preview_image(this)">
                            <span class="box-square">
                                <?php echo $img_question;?>
                                <p class="sub"><?php _e('Add photo', 'opalbeauty')?></p>
                                
                            </span>
                            
                           
                        </label>
                        <img class="remove-img" src="<?php theme_path('/assets/images/x-icon.svg')?>">
                        <!-- <p class="mess"></p> -->
                    </div>
                    
                    
                </div>
            </div>
        </div>

   </form>
</main>

<?php get_footer();?>
<script>
var x, i, j, l, ll, selElmnt, a, b, c, sc, selElmntC, selElmntC, selElmntP;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select2");
l = x.length;

if (l > 0) {
    for (i = 0; i < l; i++) {
        selElmnt = x[i].querySelectorAll('input');

        ll = selElmnt.length;
       
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        selElmntC = x[i].querySelectorAll('input:checked');
        sc = selElmntC.length;
       
        if(sc > 0){
            a.innerHTML = selElmntC[0].parentElement.innerText;
            for (var k = 1; k < sc; k++) {
                a.innerHTML += ' | ' + selElmntC[k].parentElement.innerText;
            }
        }
      
        a.setAttribute("class", "select-selected2");

        x[i].parentElement.appendChild(a);
        x[i].classList.add("select-hide");
        /*for each element, create a new DIV that will contain the option list:*/
        x[i].addEventListener("click", function(e) {
            var selElmntC = this.querySelectorAll('input:checked');
            var sc = selElmntC.length;
            if(sc > 0){
                a.innerHTML = selElmntC[0].parentElement.innerText;
                for (var k = 1; k < sc; k++) {
                    a.innerHTML += ' | ' + selElmntC[k].parentElement.innerText;
                }
            }else{
                a.innerHTML = '';
            }
        });
        //x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            
            this.previousElementSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }
}

</script>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
function getValidation() {
   
    return {
        'question_title': {
            name: 'Title',
            type: ['required']
        },
        'question_detail': {
            name: 'Detail',
            type: ['required']
        },
        'question_category': {
            name: 'Category',
            type: ['mutiple']
        }
        ,
        'question_image': {
            name: 'Images',
            type: ['mutiple']
        }

    }
}
jQuery(document).ready(function() {
    function handlingForm(form) {
        const arrRequire = [];
        const dataInput = {
            question_category: [],
            question_image: []
        };
      
        jQuery.each(form.serializeArray(), function(index, obj) {
            if (obj.name == 'question_category') {
                dataInput[obj.name].push(obj.value);
            } else {
                dataInput[obj.name] = obj.value;
            }

        });
        form.find("input[name='question_image[]']").each(function() {
            if(jQuery(this).val()){
                dataInput['question_image'].push(jQuery(this)[0].files[0]);
            }
        });
      
        const validation = getValidation();
      
        const errors = reqValidator(validation, dataInput);
        

        jQuery(`.opal-forms .mess`).removeClass('active');
       
        const btn = form.find('button');
        
        btn.prop('disabled', true);
        btn.removeClass('active');
        if (Object.keys(errors)[0]) {
            for (const keye in errors) {
                const fielde = jQuery(`.field.${keye} .mess`);
                fielde.addClass('active');
                fielde.text(errors[keye]);
            }
            btn.removeClass('loading-btn');
            return;
        }
       
        btn.addClass('active');
        btn.prop('disabled', false);
        
       return dataInput;
    }
    
    jQuery('body').on('change', ".box-item:last-of-type input[name='question_image[]']", function() {
        if(!jQuery(this).val()){
            jQuery(this).remove()
            return;
        }
        var box_item = jQuery(this).closest('.box-item');
        var box_clone = box_item.clone();
        box_clone.find("input").val('');

        jQuery( box_clone ).insertAfter( box_item  );
        
    });
    jQuery('body').on('click', ".box-item .remove-img", function(e) {
        e.stopPropagation();

        jQuery(this).closest('.box-item').remove();
        jQuery( "form" ).first().trigger( "change" );
    });

    
   
    jQuery('body').on('change', '#form-event-create', function() {

        const form = jQuery(this);
        const dataInput = handlingForm(form);
       
        if(!dataInput){
            return;
        }

        const last_field = jQuery(`.field.interested_in .mess`);

    });

    
    jQuery("#submit-create-event").click(function() {
        const form = jQuery("#form-event-create");
        const dataInput = handlingForm(form);
        if(!dataInput){
            return;
        }
        const formData = new FormData();
        
        
        formData.append('action', 'userCreateQuestion');
        for (const key in dataInput) {
            formData.append(key, dataInput[key])
        }
        dataInput.question_image.forEach(function(obj) {
            formData.append('question_image[]', obj);
        });
       
        
     
        const last_field = jQuery(`.field.field_service .mess`);

        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);

        var btn_submit = jQuery(this);
        jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php');?>',
                contentType: false,
                processData: false,
                data: formData
            })
            .done(function(response) {
                
                if (!response.data) {
                    alert('ERROR');
                }
                if (response.data.success === false) { // user not exists
                    last_field.addClass('active');
                    last_field.text(response.data.message);
                    return
                }
                window.location = "<?php create_url('question')?>";
            })
            .fail(function(jqXHR, textStatus) {
                alert('ERROR');
            })
            .always(function() {
                btn_submit.removeClass('loading-btn');
                btn_submit.prop('disabled', false);
            })
    });
});
</script>