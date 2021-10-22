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

function preview_thumbailpost1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#post1')
                .attr('src', e.target.result)
                .width(100)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
};

function preview_thumbailpost2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#post2')
                .attr('src', e.target.result)
                .width(100)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
};

function preview_thumbailpost3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#post3')
                .attr('src', e.target.result)
                .width(100)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
};

function preview_thumbailpost4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#post4')
                .attr('src', e.target.result)
                .width(100)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
};

function preview_thumbailpost5(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#post5')
                .attr('src', e.target.result)
                .width(100)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
};

function preview_thumbail_logo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#logo')
                .attr('src', e.target.result)
                .width(100)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
};