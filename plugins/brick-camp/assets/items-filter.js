(function (window, document) {
    
    function fillInputByUrl(input_id, url_regex) {
        var url = window.location.pathname;
        var match = url.match(url_regex);
        if (match != null) {
            match.shift();
            var element = document.getElementById(input_id)
            if (element != null) {
                element.value = match.join("");
                console.log(input_id + ': ' + match.join(""));
            }
        }
    }

    function initAutoSubmit() {
        // autosubmit
        var form = document.forms.namedItem("items-filter");
        var selects = form.getElementsByTagName("select");
        for(i = 0; i < selects.length; i++) {
            selects.item(i).onchange = function(){
                form.submit();
            }
        }

        // hide submit button
        var buttons = form.getElementsByClassName("btn");
        for(i = 0; i < buttons.length; i++) {
            buttons.item(i).style.display = "none";
        }
    }

    window.onload = function(e) {
        if (document.forms.namedItem("items-filter") == null) {
            return;
        }

        fillInputByUrl("rotation_type", "(stud_tilt)|(stud_twist)|(axle_tilt)");
        fillInputByUrl("rotation_angle", "_angle:([0-9\-\_]+)");

        fillInputByUrl("offset_type", "(stud_lift)|(stud_shift)|(axle_shift)");
        fillInputByUrl("offset_length", "_length:([0-9\-\_]+|flex)");

        fillInputByUrl("shape_type", "shape_(2D|3D)");
        fillInputByUrl("shape_type", "shape_(2D|3D)_segments(:[0-9up\_]+)");
        fillInputByUrl("shape_segsize", "_segsize:([0-9up\_]+)");

        fillInputByUrl("pattern_type", "pattern_(1D|2D|3D)");
        fillInputByUrl("pattern_segsize", "_segsize:([0-9up\_]+)");

        fillInputByUrl("order_by", "orderby:([^/]+)");
        fillInputByUrl("order_dir", "orderdir:([^/]+)");

        initAutoSubmit();
    }

}(this, this.document));