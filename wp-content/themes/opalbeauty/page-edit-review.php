<?php /* Template Name: Edit Review  */ ?>
<?php get_header();?>
<?php header_page(__('Post Review', 'opalbeauty'));
global $wp;

$currentSlug = add_query_arg( 
        array(
            'qid'=> get_query_var('qid'),
            'appt' => 'X'
        ), $wp->request );

// get his posts 'ASC'
$author_post = get_author_question(null, 'review');
$post = [
    'id' => '', 
    'review_detail' => '',
    'review_category' => '',
    'review_before' => '',
    'review_after'=> '',
];

if(count($author_post['post']) > 0){
    
    $post = [
        'id' => $author_post['id'],
        'review_detail' => $author_post['post'][0]->post_content,
        'review_before' => get_field('review_before', $author_post['id']),
        'review_after' => get_field('review_after', $author_post['id']),
    ];

    $post_term = get_the_terms($author_post['id'], 'review_category');
   
    foreach( $post_term as $pt ){
        $post['review_category'][$pt->term_id] = 'checked';
    }

}
?>
<main class="creator-page">

    <form id="form-review-create" class="opal-forms opal-forms4 form-action" method="POST">
    <input type="hidden" name="q_id" value="<?php echo $post['id']?>">
    <a class="prev-step2 sticky-action-btn" href="#"><img src="<?php theme_path('/assets/images/arrow-left.svg') ?>"></a>
        <button id="submit-create-event" type="button"
            class="sticky-action-btn"><?php _e('Share', 'opalbeauty');?></button>
        <a id="next-action" type="button"
            class="sticky-action-btn active">
            <img src="<?php theme_path('/assets/images/arrow-right.svg')?>">
            <img class="img-sub-active" src="<?php theme_path('/assets/images/arrow-right-red.svg')?>">
        </a>
        <div class="form-group">
            <div class="image-col2">
                <?php 
                    $img_question = '<img class="main question-img"
                    src="'.get_theme_path("/assets/images/plus-bg.svg").'">';
                    $classM = '';
                    
                    if($post['review_before']){
                        $img_question = '<img class="main question-img"
                        src="'.$post['review_before'].'">';
                        $classM = 'active';
                    }
                ?>
                <div class="field image-field review_before text-center">
                    <script>
                    function preview_image(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            var img = input.nextElementSibling.children;
                            reader.onload = function(e) {
                                input.parentElement.parentElement.classList.add("active");
                                input.value = '1'
                                img[0].src = e.target.result;
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    </script>

                    <div class="box-item active">
                        <label class="text-center">

                            <input type="file" class="inputfile inputfile-4" name="review_before"
                                accept="image/png, image/gif, image/jpeg" data-src="<?php echo $post['review_before']?>"  onchange="preview_image(this)">
                            <span class="box-square">
                                <?php echo $img_question;?>
                            </span>
                            <p class="sub"><?php _e('Add photo', 'opalbeauty');?></p>
                            <p class="sub-label"><?php _e('Before', 'opalbeauty');?></p>
                        </label>
                        <!-- <p class="mess"></p> -->
                    </div>

                </div>
                <?php 
                    $img_question = '<img class="main question-img"
                    src="'.get_theme_path("/assets/images/plus-bg.svg").'">';
                    $classM = '';
                   
                    if($post['review_after']){
                        $img_question = '<img class="main question-img"
                        src="'.$post['review_after'].'">';
                        $classM = 'active';
                    }
                ?>
                <div class="field image-field review_after text-center">
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

                    <div class="box-item active">
                        <label class="text-center">

                            <input type="file" class="inputfile inputfile-4" name="review_after"
                                accept="image/png, image/gif, image/jpeg" data-src="<?php echo $post['review_after']?>"  onchange="preview_image(this)">
                            <span class="box-square">
                                <?php echo $img_question;?>
                            </span>
                            <p class="sub"><?php _e('Add photo', 'opalbeauty');?></p>
                            <p class="sub-label"><?php _e('After', 'opalbeauty');?></p>
                        </label>
                        <!-- <p class="mess"></p> -->
                    </div>

                </div>
            </div>
        </div>
        <div class="form-group wrap">
            <div class="field textarea-field textarea-field2 review_detail">
                <div>
                    <textarea name="review_detail" id="" cols="30" rows="10"
                        placeholder="<?php _e('Share your experience...', 'opalbeauty');?>"><?php echo $post['review_detail']?></textarea>
                </div>
                <!-- <p class="mess"></p> -->
            </div>
            <div class="field checkbox-field review_category">
                <div>
                    <?php
                    $taxonomies = get_terms( array(
                        'taxonomy' => 'review_category',
                        'orderby' => 'ID',
                        'hide_empty' => false,
                    ) );
                    if ( !empty($taxonomies) ) :
                        foreach( $taxonomies as $tax ) :?>

                    <label><?php echo $tax->name?>
                        <input type="checkbox" name="review_category" value="<?php echo $tax->term_id; ?>"
                        <?php echo !empty($post['review_category'][$tax->term_id]) ? 'checked' : ''?>>
                        <span class="checkmark"></span>
                    </label>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- <p class="mess"></p> -->
                </div>
            </div>
        </div>

    </form>
</main>

<?php get_footer();?>

<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
var formDefault = <?php echo json_encode($post);?>;
function getValidation() {

    return {
        'review_detail': {
            name: 'Detail',
            type: ['required']
        },
        'review_category': {
            name: 'Category',
            type: ['mutiple']
        },
        'review_before': {
            name: 'Image',
            type: ['file']
        },
        'review_after': {
            name: 'Image',
            type: ['file']
        }

    }
}
function handling_arr(valAndValidation, dataInput, keyInput){
    let countCat = 0;
    let validation = getValidation();
   
    for (const key in formDefault[keyInput]) {
        countCat++;
    }
    if(dataInput[keyInput].length != countCat){
       
        valAndValidation['val'][keyInput] = dataInput[keyInput];
        if(validation[keyInput]){
            valAndValidation['validation'][keyInput] = validation[keyInput];
        }
       
    }else{
        
        for (const val of dataInput[keyInput]) {
            if(!formDefault[keyInput][val]){
                valAndValidation['val'][keyInput] = dataInput[keyInput];
                if(validation[keyInput]){
                    valAndValidation['validation'][keyInput] = validation[keyInput]
                }
               
                break;
            }
        }
    }
}
jQuery(document).ready(function() {
    var stepForm = 1;
    
    function handlingForm(form) {
        let arrRequire = [];
        let dataInput = {
            review_category: [],
        };
       
        
        jQuery.each(form.serializeArray(), function(index, obj) {
            if (obj.name == 'review_category') {
                dataInput[obj.name].push(obj.value);
            } else {
                dataInput[obj.name] = obj.value;
            }

        });
        dataInput['review_detail'] = form.find('textarea').val();

        const valAndValidation = {
            'val': {},
            'validation': {}
        }
        for (const val of ['review_detail']) {
            if(formDefault[val] != dataInput[val]){
                valAndValidation['val'][val] = dataInput[val];
                valAndValidation['validation'][val] = getValidation()[val];
            }
        }

        for (const val of ['review_before', 'review_after']) {
            const reviewImg = jQuery(`input[name=${val}]`);
            if(reviewImg[0].files[0]){
                valAndValidation['val'][val] = reviewImg[0].files[0];
                valAndValidation['validation'][val] = getValidation()[val];
            }
        }

        handling_arr(valAndValidation, dataInput, 'review_category');
      
        dataInput = valAndValidation['val'];
        validation = valAndValidation['validation'];
        let checkData = false;

        jQuery('#next-action').remove('active');
        jQuery(`.opal-forms .mess`).removeClass('active');
        const btn = form.find('button');

        btn.prop('disabled', true);
        btn.removeClass('active');

        
        const errors = reqValidator(validation, dataInput);
      


        jQuery('#next-action').removeClass('active');
      
        if(!errors['review_detail'] && !errors['review_before'] && !errors['review_after']){
            jQuery('#next-action').addClass('active');
        }
        for (const key in dataInput) {
            checkData = true;
        }
        if(!checkData){
            return;
        }
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


    jQuery('body').on('change', '#form-review-create', function() {

        const form = jQuery(this);
        const dataInput = handlingForm(form);

        if (!dataInput) {
            return;
        }

        const last_field = jQuery(`.field.interested_in .mess`);

    });
  
    
    jQuery(".prev-step2").on('click',function(e) {
        jQuery(this).closest('form').removeClass('step2');
        jQuery('.back-main').show();
        jQuery('.top-element h2').text("<?php _e('Post review', 'opalbeauty');?>");
    });
    jQuery("#next-action").click(function() {
        if(!jQuery(this).hasClass('active')){
            return;
        }
        jQuery('.top-element h2').text("<?php _e('Choose category', 'opalbeauty');?>");
        jQuery('.back-main').hide();
        jQuery(this).closest('form').addClass('step2');
    });
    jQuery("#submit-create-event").click(function() {
        const form = jQuery("#form-review-create");
        const dataInput = handlingForm(form);
        if (!dataInput) {
            return;
        }
        const formData = new FormData();


        formData.append('action', 'userUpdateReview');
        formData.append('q_id', form.find('input[name=q_id]').val());
        for (const key in dataInput) {
            formData.append(key, dataInput[key])
        }


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
                location.href='<?php create_url_param($currentSlug)?>';
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