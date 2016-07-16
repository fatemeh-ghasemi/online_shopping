
    $('#search').click(function () {
        $('#search').css('left', $(window).width() - 200);
        $('#jewel').css('display', 'none');
        $(':text').css({ left: 10, top: 30, width: 800, 'border-width': '1px' });
        $('#shopping').css('display', 'none');
        $('span').css('display', 'none');
        $('<img/>').attr('src', 'img/close47.png').attr('id', 'close').css('width', '16px').appendTo('#head').click(function () {
            $('#search').css('left', 50);
            $('#jewel').css('display', 'block');
            $('#shopping').css('display', 'block');
            $(':text').css({ width: 0, 'border-width': 0 });
            $('span').css('display', 'block');
            $('#close').remove();
        });
    });
   