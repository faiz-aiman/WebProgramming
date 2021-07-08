

//  $("a.edit").on('click', function (e) {
//    var targetPE = $(this).attr('rel')
//    $(this).hide();
//    $("#save-"+targetPE).show();
//     TBox($("#"+targetPE+"-final"));
// });

// $("a.save").on('click', function (e) {
//     var targetPS = $(this).attr('rel')
//     $(this).hide();
//     $("#edit-"+targetPS).show();
//      RBox($("#"+targetPS+"-edit"));
//  });

// function TBox(obj) {
//         var id = $(obj).attr("id");
//         var tid = id.replace("-final", "-edit");
//         var input = $('<input />', { 'type': 'text', 'name': 'n' + tid, 'id': tid, 'class': 'text_box', 'value': $(obj).html() });
//         $(obj).after(input);
//         $(obj).remove();
//         input.focus();
// }
// function RBox(obj) {
//     var id = $(obj).attr("id");
//     var tid = id.replace("-edit", "-final");
//     var input = $('<p />', { 'id': tid, 'class': 'cmtedit', 'html': $(obj).val() });
//     $(obj).after(input);
//     $(obj).remove();
// }

$(".profile-card-nav-btn > a").on('click', function(){
    var targetPT = $(this).attr("rel");
    $("#"+targetPT).removeClass("hide").siblings("div").addClass("hide");

    $("#edit-" + targetPT).removeClass("hide").siblings("button").addClass("hide");

    $(".profile-card-nav-btn a.active").removeClass("active");
    $(this).addClass("active");
});

function saveChanges(){

    $(".profile-input").each(function(){

        if($(this).is("input")){

            if($(this).attr("type") == "radio"){

                if($(this).is(":checked")){
                    var value = $(this).val();
                    $("#" + $(this).attr("name")).text(value);
                }

            }

            else {
                var value = $(this).val();
                $("#" + $(this).attr("name")).text(value);
            }

        }

        else if($(this).is("select")){
            var value = $("#" + $(this).attr("id") + " option:selected").text();
            $("#" + $(this).attr("name")).text(value);
        }

        else if($(this).is("textarea")){
            var value = $(this).val();
            $("#" + $(this).attr("name")).text(value);
        }
    });

};

function editProfile(){

    $(".profile-info").each(function(){


        var target = $(this).attr("id");

        if($("#" + target + "-input").is("input")){

            if($("#" + target + "-input").prop("type") == "radio"){

                    $("#" + target + "-input").val(1);

            }

            else {
                var value = $(this).val();
                $("#" + target + "-input").val(value);
            }

        }

        else if($(this).is("select")){
            $("#" + target + "-input").value(1);
        }

        else if($(this).is("textarea")){
            $("#" + target + "-input").val(value);
        }

    })
};

$(".btn-edit").on('click', function(){

    editProfile();

    var targetPF = $(this).attr("role");
    $("#"+ targetPF).addClass("hide");
    $("#"+ targetPF + "-form").removeClass("hide");

    $(this).addClass("hide");
    $("#save-"+ targetPF).removeClass("hide");

});

$(".btn-save").on('click', function(){

    saveChanges();

    var targetPF = $(this).attr("role");
    $("#"+ targetPF + "-form").addClass("hide");
    $("#"+ targetPF).removeClass("hide");

    $(this).addClass("hide");
    $("#edit-"+ targetPF).removeClass("hide");

});

$("#careerPath-input").change(function(){

    if ($(this).val() == "study") {
        $('#institution-form-label').show();
        $('#institution-input').show();
        $('#institution-input').attr('required', '');
        $('#institution-input').attr('data-error', 'This field is required.');
        $('#occupation-form-label').hide();
        $('#occupation-input').hide();
        $('#occupation-input').removeAttr('required', '');
        $('#occupation-input').removeAttr('data-error', 'This field is required.');
        $('#company-form-label').hide();
        $('#company-input').hide();
        $('#company-input').removeAttr('required', '');
        $('#company-input').removeAttr('data-error', 'This field is required.');
        $('#employment-form-label').hide();
        $('#employment-input').hide();
    } 
    
    else if ($(this).val() == "employed"){
        $('#occupation-form-label').show();
        $('#occupation-input').show();
        $('#occupation-input').attr('required', '');
        $('#occupation-input').attr('data-error', 'This field is required.');
        $('#company-form-label').show();
        $('#company-input').show();
        $('#company-input').attr('required', '');
        $('#company-input').attr('data-error', 'This field is required.');
        $('#institution-form-label').hide();
        $('#institution-input').hide();
        $('#institution-input').removeAttr('required', '');
        $('#institution-input').removeAttr('data-error', 'This field is required.');
        $('#employment-form-label').hide();
        $('#employment-input').hide();
    }

    else if ($(this).val() == "unemployed"){
        $('#employment-form-label').show();
        $('#employment-input').show();
        $('#occupation-form-label').hide();
        $('#occupation-input').hide();
        $('#occupation-input').removeAttr('required', '');
        $('#occupation-input').removeAttr('data-error', 'This field is required.');
        $('#company-form-label').hide();
        $('#company-input').hide();
        $('#company-input').removeAttr('required', '');
        $('#company-input').removeAttr('data-error', 'This field is required.');
        $('#institution-form-label').hide();
        $('#institution-input').hide();
        $('#institution-input').removeAttr('required', '');
        $('#institution-input').removeAttr('data-error', 'This field is required.');
    }

});

$("#careerPath-input").trigger("change");

