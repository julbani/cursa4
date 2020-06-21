// editing question
var content = $('.question-content');
var title = $('.question-title');

$(".edit-btn").on('click', function() {
    // move text from content and title to the edit inputs
    $('.edit-wrapper').css('display', 'block');
    $('input#edited-title').val(title.html());
    $('input#edited-content').val(content.html());
    title.css('display', 'none');
    content.css('display', 'none');
    $(this).css('display', 'none');
});

$('.save-changes-btn').on('click', function() {
    var questionId = $('.save-changes-btn').parent().parent().data('questionid');
    $.ajax({
        method: 'POST',
        url: editUrl, // editUrl located at question.blade.php
        data: {
            title: $("#edited-title").val(),
            content: $("#edited-content").val(),
            questionId: questionId,
            _token: token // file question.blade.php
        }
    })
    .done(function(msg) {
        title.text(msg['edited_title']);
        content.text(msg['edited_content']);
        title.css('display', 'block');
        content.css('display', 'block');
        $('.edit-wrapper').css('display', 'none');
        $('.edit-btn').css('display', 'block')
    });
});

// prevent an unauthorized user to answer the question
$('.submit-answer-btn').on('click', function() {
    if(!$(this).data('valid-user')) {
        alert('Тільки авторизовані користувачі можуть залишати відповіді.');
        return false;
    }
});

// chosing correct answer by question owner
$(".choose-answer-btn").on('click', function() {
    var btn = $(this);
    if(btn.hasClass('active')) {
        return;
    }
    var answerContainer = btn.parent();
    if(!confirm("Ви впевнені, що хочете обрати цю відповідь і віддати автору "
            + answerContainer.data('points') + " балів")) {
        return false;
    }
    $.ajax({
        method: 'POST',
        url: chooseAnswerUrl,
        data: {
            answer_id: answerContainer.data('answer-id'),
            _token: token
        }
    })
    .done(function(msg) {
        // make button active
        btn.addClass('active');
        // remove other buttons
        $('.choose-answer-btn').each(function(i, btn) {
            if(!$(this).hasClass('active'))
                $(this).remove();
        })
    });
});

document.getElementById("answer-ref").onclick = function() {
    var form = document.getElementById("add-answer-form");
    form.style.display = 'block';
    form.scrollIntoView({block: "center", behavior: "smooth"});
}

// $("#answer-ref").on('click', function() {
//     $('#add-answer-form').css('display', 'block');
//     document.getElementById("add-answer-form").scrollIntoView();
// });