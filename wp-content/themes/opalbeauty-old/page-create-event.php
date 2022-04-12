
<?php get_header();?>

<main class="creator-page">
    
    <form id="form-event-create" class="opal-forms3">
    <section class="service-ticket">
        <div class="header-page">
            <div class="top-element">
                <span onClick="history.back(-1)" class="back-main">
                    <img src="<?php theme_path('/assets/images/arrow-left.svg')?>">
                </span>
                <h2><?php _e('Service & ticket', 'opalbeauty')?></h2>
                <span class="next-action">
                    <img src="<?php theme_path('/assets/images/arrow-right.svg')?>">
                </span>
            </div>
        </div>
        <div class="form-group wrap">
            <h3 class="block-title"><img src="<?php theme_path('/assets/images/service-icon.svg')?>"> <?php _e('Servicet', 'opalbeauty')?></h3>
            <p class="sub">Choose 1 or more services to help everyone to know more about your event.</p>
            <div class="field checkbox-field field_service">
                <div>
                    <?php foreach(field_service() as $key => $value) { ?>
                    <label><?php echo $value?>
                        <input type="checkbox" name="field_service" value="<?php echo $key ?>">
                        <span class="checkmark"></span>
                    </label>
                    <?php } ?>
                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <h3 class="block-title">Event ticket</h3>
            <div class="group-inline-block">
            <div class="field checkbox-field event_ticket_free">
                <p class="sub">Recommended price</p>
                <div>
                    <label>
                        <input type="checkbox" name="event_ticket_free" value="<?php echo $key ?>">
                        <span class="checkmark">Free</span>
                    </label>
                    <!-- <p class="mess"></p> -->
                </div>
            </div>
            <div class="field text-field event_ticket_price">
                <p class="sub">Or enter other price</p>
                <label>
                    <input class="input-form require" name="email" type="email" placeholder="Email">
                </label>
                <!-- <p class="mess"></p> -->
            </div>
            </div>
        </div>
    </section>
    <section class="service-ticket">
        <div class="header-page">
            <div class="top-element">
                <span class="prev-action">
                    <img src="<?php theme_path('/assets/images/arrow-left.svg')?>">
                </span>
                <h2>Event banner</h2>
                <span class="next-action">
                    <img src="<?php theme_path('/assets/images/arrow-right.svg')?>">
                </span>
            </div>
        </div>
        <div class="form-group wrap">
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
                        src="<?php theme_path("/assets/images/upload-icon.svg")?>">
                        </span>
                        <p class="sub">Upload a event banner </p>
                        <!-- <p class="mess"></p> -->
                    </label>
                </div>
            </div>
        </div>
    </section>
   </form>
</main>

<?php get_footer();?>
<script>
    jQuery(document).ready(function() {
        jQuery('[data-toggle="datepicker"]').datepicker({
            //offset: 20,
           
        });
    });


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
                        document.getElementById("filter-events").submit();

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