(function (window, document) {
    
    function fillInputByUrl(input_id, url_regex) {
        var url = window.location.pathname;
        var match = url.match(url_regex);
        if (match != null) {
            document.getElementById(input_id).value = match[1];
        }
    }

    window.onload = function(e) {
        fillInputByUrl("rotation_type", "((stud_tilt)|(stud_twist)|(axle_tilt))");
        fillInputByUrl("rotation_angle", "angle:([0-9\-]+)");
    }

}(this, this.document));