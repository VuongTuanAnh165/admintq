function preview_thumbail(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#anh')
                .attr('src', e.target.result)
                .width(100)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
};

function preview_thumbail1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#anh1')
                .attr('src', e.target.result)
                .width(100)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
};