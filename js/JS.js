$(function () {
    effectsDemo2 = 'rain,stairs,fade';
    var demoSlider_2 = Sliderman.slider({
        container: 'SliderName_2', width: $(window).width(), height: 800, effects: effectsDemo2,
        display: {
            autoplay: 5000,
            loading: { background: '#000000', opacity: 0.5, image: 'img/loading.gif' },
            buttons: { hide: true, opacity: 1, prev: { className: 'SliderNamePrev_2', label: '' }, next: { className: 'SliderNameNext_2', label: '' } },
            description: { hide: true, background: '#000000', opacity: 0.4, height: 50, position: 'bottom' },
            navigation: { container: 'SliderNameNavigation_2', label: '<img src="img/clear.gif" />' }
           
        }
    });
    $('#SliderNameNavigation_2').css('left',($(window).width() -64) / 2);    
});