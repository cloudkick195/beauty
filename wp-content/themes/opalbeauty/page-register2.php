<?php /* Template Name: Register Step 2  */ ?>
<?php get_header();?>
<?php header_page('');?>
<?php $user = opal_get_current_user();  $role = $user['role'];?>
<main class="user-page wrap register2-page">
    <h1 class="main-title"><?php _e('Enter your credentials to continue', 'opalbeauty')?></h1>
    <section class="form-section">
        <form id="form-user-update" class="opal-forms opal-forms2">

            <div class="field image-field avatar text-center">
                <script>
                function previewLogo(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var img = document.getElementsByClassName('avatar-img');
                        reader.onload = function(e) {
                            img[0].classList.add("active");
                            img[0].src = e.target.result;
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                </script>
                <label class="text-center">
                    <input type="file" class="inputfile inputfile-4" id="upload-avatar" name="avatar"
                        accept="image/png, image/gif, image/jpeg" onchange="previewLogo(this)">
                    <span class="box-circle">
                        <img id="avatar-img" class="main avatar-img"
                            src="<?php theme_path('/assets/images/user-icon.svg')?>" alt="opal user icon">
                        <img class="sub" src="<?php theme_path('/assets/images/camera-icon.svg')?>"
                            alt="opal camera icon">
                    </span>
                    <!-- <p class="mess"></p> -->
                </label>

            </div>
            <?php if($role == 'doctor'):?>
            <div class="field text-field fullname">
                <label for="fullname">
                    <?php _e('Full name', 'opalbeauty')?>
                </label>
                <div>
                    <input class="input-form require" name="fullname" type="text">
                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <?php else:?>
            <div class="field text-field username">
                <label for="username">
                    <?php _e('Username', 'opalbeauty')?>
                </label>
                <div>
                    <?php if($user['username']):?>
                    <span class="not-field"><span><?php echo $user['username']?></span></span>
                    <?php else:?>
                    <input class="input-form require" name="username" type="text">
                    <?php endif;?>

                    <!-- <p class="mess"></p> -->
                </div>
            </div>

            <?php endif;?>

            <div class="field email">
                <label>
                    <?php _e('Email', 'opalbeauty')?>
                </label>
                <div>
                    <span class="not-field"><span><?php echo $user['email']?></span></span>
                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <div class="field select-field gender">
                <label for="gender"><?php _e('Gender', 'opalbeauty')?></label>
                <div>
                    <div class="box-select">
                        <div class="custom-select">
                        <select id="gender" class="form-select require" name="gender">
                            <?php foreach(field_gender() as $key => $value) { ?>
                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    <!-- <p class="mess"></p> -->
                </div>

            </div>
            <div class="field text-field age">
                <label for="age"><?php _e('Age', 'opalbeauty')?></label>
                <div>
                    <input class="input-form require" name="age" type="text">
                    <!-- <p class="mess"></p> -->
                </div>

            </div>
            <?php if($role == 'doctor'):?>
            <div class="field text-field study_at">
                <label for="study_at">
                    <?php _e('Study at', 'opalbeauty')?>
                </label>
                <div>
                    <input class="input-form require" name="study_at" type="text">
                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <div class="field text-field experience">
                <label for="experience">
                    <?php _e('Experience', 'opalbeauty')?>
                </label>
                <div>
                    <div class="add-prefix">
                        <span><span class="this-e"></span><span><?php _e('years', 'opalbeauty')?></span></span>
                        <input class="input-form require" name="experience" type="number">
                    </div>
                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <div class="field text-field surgeries">
                <label for="surgeries">
                    <?php _e('Surgeries', 'opalbeauty')?>
                </label>
                <div>

                    <div class="add-prefix">
                        <span><span class="this-e"></span><span><?php _e('shift', 'opalbeauty')?></span></span>
                        <input class="input-form require" name="surgeries" type="number">
                    </div>
                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <div class="field checkbox-field checkbox-field2 specialist">
                <label for="specialist">
                    <?php _e('Specialist', 'opalbeauty')?>
                </label>
                <div>
                    <div class="box-select">
                        <div class="custom-select2">
                           
                            <?php foreach(field_specialist() as $key => $value) { ?>
                            <label><?php echo $value?>
                                <input type="checkbox" name="specialist" value="<?php echo $key ?>">
                                <span class="checkmark"></span>
                            </label>
                            <?php } ?>
                           
                          
                        </div>
                       
                    </div>

                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <div class="field text-field work_at">
                <label for="work_at">
                    <?php _e('Work at', 'opalbeauty')?>
                </label>
                <div>
                    <input class="input-form require" name="work_at" type="text">
                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <div class="field image-field certificated text-center">
                <script>
                function preview_image_full(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var img = document.getElementsByClassName('certificated-img');
                        reader.onload = function(e) {
                            document.getElementsByClassName('certificated')[0].classList.add("active");
                            img[0].src = e.target.result;
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                </script>
                <div class="box-full">
                    <label class="text-center">
                        <input type="file" class="inputfile inputfile-4" id="upload-certificated" name="certificated"
                            accept="image/png, image/gif, image/jpeg" onchange="preview_image_full(this)">
                        <span class="box-circle">
                            <img id="certificated-img" class="main certificated-img"
                                src="<?php theme_path('/assets/images/stroke-icon.svg')?>" alt="opal user icon">
                        </span>
                        <p class="sub"><?php _e('Update certificated', 'opalbeauty')?></p>
                        <!-- <p class="mess"></p> -->
                    </label>
                </div>
            </div>
            <div class="popup-box">
                <div class="box">
                    <p><?php _e('Your request is being moderated.', 'opalbeauty')?></p>
                    <div><a class="" href="<?php create_url('home')?>"><?php _e('Continue exploring', 'opalbeauty')?> <img
                                src="<?php theme_path('/assets/images/stroke-icon1.svg') ?>" alt="eye icon"></a></div>
                </div>
            </div>
            <?php else:?>

            <div class="field checkbox-field interested_in">
                <label for="interested_in"><?php _e('Interested in', 'opalbeauty')?></label>
                <div>
                    <?php foreach(field_specialist() as $key => $value) { ?>
                    <label><?php echo $value?>
                        <input type="checkbox" name="interested_in" value="<?php echo $key ?>">
                        <span class="checkmark"></span>
                    </label>
                    <?php } ?>
                    <!-- <p class="mess"></p> -->
                </div>

            </div>
            <?php endif;?>
            <div class="wrap-fixed-btn">
            <button id="submit-user-update" type="button" class="btn-style full main-color"><?php _e('Get’s started', 'opalbeauty')?></button>
            </div>
            
        </form>
    </section>
</main>
<?php get_footer();?>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
function getValidation() {
    <?php if($role == 'doctor'):?>

    return {
        'fullname': {
            type: ['required']
        },
        'gender': {
            type: ['required']
        },
        'age': {
            type: ['required']
        },
        'study_at': {
            name: "Study At",
            type: ['required']
        },
        'experience': {
            type: ['required']
        },
        'surgeries': {
            type: ['required']
        },
        'specialist': {
            type: ['mutiple']
        },
        'work_at': {
            name: "Work At",
            type: ['required']
        }

    }
    <?php else:?>
    return {
        'username': {
            type: ['required']
        },
        'gender': {
            type: ['required']
        },
        'age': {
            type: ['required']
        },
        'interested_in': {
            name: "Interested in",
            type: ['mutiple']
        }
    }
    <?php endif;?>
}
jQuery(document).ready(function() {
    var formData = new FormData();

    jQuery('#submit-user-update').prop('disabled', true);
    jQuery(".show-pass").click(function() {
        var input = jQuery(this).parent().find('input');
        if (input.attr('type') == 'password') {
            input.attr('type', 'text');
            return;
        }

        input.attr('type', 'password');
    });

    jQuery('.add-prefix input').on('keyup keydown keypress change', function() {
        jQuery(this).prev('span').children('.this-e').text(jQuery(this).val());
    });
    jQuery('body').on('change', '#form-user-update', function() {

        const form = jQuery(this);
        const arrRequire = [];
        const dataInput = {
            interested_in: [],
            specialist: []
        };

        jQuery.each(form.serializeArray(), function(index, obj) {
            if (obj.name == 'interested_in' || obj.name == 'specialist') {
                dataInput[obj.name].push(obj.value);
            } else {
                dataInput[obj.name] = obj.value;
            }
            

        });
        const validation = getValidation();
        const errors = reqValidator(validation, dataInput);


        jQuery(`.opal-forms .mess`).removeClass('active');
        jQuery('#submit-user-update').removeClass('active');
        if (Object.keys(errors)[0]) {
            for (const keye in errors) {
                const fielde = jQuery(`.field.${keye} .mess`);
                fielde.addClass('active');
                fielde.text(errors[keye]);
            }
            jQuery('#submit-user-update').removeClass('active');
            jQuery('#submit-user-update').prop('disabled', true);
            return;
        }

        const last_field = jQuery(`.field.interested_in .mess`);

        jQuery('#submit-user-update').addClass('active');
        jQuery('#submit-user-update').prop('disabled', false);

    });
    jQuery(".popup-box").on('click', function() {
        window.location = "<?php create_url('home')?>";
    });
    jQuery(".popup-box .box").click(function(e) {
        e.stopPropagation(); // stops the event to bubble up to the parent element.
    });
    jQuery("#submit-user-update").click(function() {
        const form = jQuery("#form-user-update");
        const arrRequire = [];
        const dataInput = {
            interested_in: [],
            specialist: []
        };

        jQuery.each(form.serializeArray(), function(index, obj) {
            if (obj.name == 'interested_in' || obj.name == 'specialist') {
                dataInput[obj.name].push(obj.value);
            } else {
                dataInput[obj.name] = obj.value;
            }

        });

        const validation = getValidation();

        const errors = reqValidator(validation, dataInput);


        jQuery(`.opal-forms .mess`).removeClass('active');

        if (Object.keys(errors)[0]) {
            for (const keye in errors) {
                const fielde = jQuery(`.field.${keye} .mess`);
                fielde.addClass('active');
                fielde.text(errors[keye]);
            }
            jQuery(this).removeClass('loading-btn');
            jQuery(this).prop('disabled', false);
            return;
        }

        const last_field = jQuery(`.field.interested_in .mess`);

        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);

        var formData = new FormData();

        formData.append('action', 'submitRegisterUser')

        formData.append('image', form.find('input[name=avatar]')[0].files[0]);
        <?php if($role == 'doctor'):?>
        formData.append('certificated', form.find('input[name=certificated]')[0].files[0]);
        <?php endif;?>

        for (const key in dataInput) {
            formData.append(key, dataInput[key])
        }

        var btn_submit = jQuery(this);
        jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php');?>',
                contentType: false,
                processData: false,
                data: formData
            })
            .done(function(response) {
                console.log(response);
                if (!response.data) {
                    alert('ERROR');
                }
                if (response.data.success === false) { // user not exists
                    last_field.addClass('active');
                    last_field.text(response.data.message);
                    return
                }
                if (response.data.moderated) {
                    jQuery('.popup-box').addClass('active');
                    return
                }
                window.location = "<?php create_url('home')?>";

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

<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;

if (l > 0) {
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");

        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        a.setAttribute("class", "select-selected s" + selElmnt.options[selElmnt.selectedIndex].value);

        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 0; j < ll; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.setAttribute('select-id', 's' + selElmnt.options[j].value)
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        h.classList.value = 'select-selected';
                        h.classList.add(this.getAttribute('select-id'));

                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");

                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }
}

function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

</script>
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