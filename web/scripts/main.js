$(function () {
    let scroll;

    let $sectionContent = $('.section-content');

    let $btnTop = $('#slide-top');

    if ($(window).scrollTop() > 0) {
        animateScale($sectionContent, 400);
    }

    if ($(window).scrollTop() > 100) {
        slideRightBtn();
    }

    // смена фона
    // console.log(slideBackground());

    let intervalSlide = setInterval(slideBackground, 10000);

    let $returnBg = '.bg-image';

    function slideBackground() {
        let $background = $('#fx-background');

        let $bgOne = $('.bg-image');
        let $bgTwo = $('.bg-image2');

        if ($background.hasClass('active')) {
            $bgTwo.css({
                'opacity': '1'
            });
            $bgOne.removeClass('active');

            $returnBg = '.bg-image2';
        } else {
            $bgTwo.css({
                'opacity': '0'
            });

            $bgOne.css({
                'opacity': '1'
            });
            $bgOne.addClass('active');

            $returnBg = '.bg-image';
        }
    }

    $(window).on('scroll', function () {
        scroll = $(window).scrollTop();

        slideRightBtn(scroll);

        if (document.location.pathname === '/') {
            if (scroll >= 40) {
                return;
            }

            if (scroll <= 1) {
                returnValue($sectionContent, 1);
                returnValue($returnBg, 1);
            } else {
                animateScale($sectionContent, 400);
                animateScale($returnBg, 600);
            }
        }
    });

    // обработчик на выполнения скролла top: 0
    $btnTop.mousedown(function () {
        $('body, html').stop(true).animate({
            scrollTop: 0
        }, 400);
    });

    // слайд кнопки top
    function slideRightBtn(scroll) {
        if (scroll < 100) {
            $btnTop.css({'right': '-50px'});
        } else {
            $btnTop.css({'right': '50px'});
        }
    }

    // анимация скейла фона
    function animateScale(element, scaleSize) {
        $(element).css({
            transform: 'scale(' + (100 + scaleSize / 100) / 100 + ')'
        });
    }

    // возврат значения заднего фона
    function returnValue(element, value) {
        $(element).css({
            transform: 'scale(' + value + ')'
        });
    }

    // ajax отправка формы регистрации
    $('#form-register').on('submit', function () {
        let data = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/site/register',
            data: data,

            fail: function () {
                $('.register-form').empty().append('<p class="error-register">' + 'Ошибка регистрации' + '</p>');
            }
        });
    });

    $('#form-login').on('submit', function () {
        let data = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/site/login',
            data: data,

            success: function (response) {
                console.log(response)
            },

            fail: function () {
                console.log('error');
            }
        });
    });

    // отобразить модальное окно с записью
    $('.record').on('click', function (e) {
        e.preventDefault();

        $('html').css('overflow', 'hidden');
        $('.bg-main').css('opacity', '1');

        modal.show({
            width: 650,
            height: 450,
        });
    });

    let modal = (function () {

        // объект сбора данных о записи
        let dataRecordObj = {
            hairdresserId: null,
            serviceId: [],
            date: '',
            time: '',
        };

        function openList(selector, container) {
            if (container.is(':hidden')) {
                $(selector + ' .fa-chevron-down').css({
                    'transform': 'rotate(180deg)',
                    'padding': '0 10px 2px 0',
                });
            } else {
                $(selector + ' .fa-chevron-down').css({
                    'transform': 'rotate(0)',
                    'padding': '2px 0 0 10px',
                });
            }

            container.slideToggle();
        }

        dataRecordObj.clientId = 1;

        let $modal = $('.modal-record');

        let listSelects = [],
            numSelectedServices = 0;

        let $iconSelect = $('.fa-circle');
        let resultSum = 0;

        let $masterBlock = $('.master');
        let listSelectedMaster = [];

        // закрытие модального окна
        $('.close-modal').on('click', function () {
            modal.close();
        });

        $('.open-list').on('click', function () {
            openList('.open-list', $('.container-services'));
        });

        $('.open-employees').on('click', function () {
            openList('.open-employees', $('.block-masters'));
        });

        // выбор услуг
        $iconSelect.on('click', function () {
            dataRecordObj.serviceId.push($(this).attr('data-service-id'));

            listSelects.push({
                price: $(this).children('.price-service').text(),
            });

            numSelectedServices = listSelects.length;

            $('.list-select').append('<p class="selected-service-txt">' + $(this).children('.name-service').text() + '</p>');

            if (listSelects.length > 0) {
                $('.selected-services').css({
                    'display': 'block'
                });
            }

            // сумма набранных услуг
            resultSum += parseInt($(this).children('.price-service').text().replace(/[^\d]/g, ''));

            $('.result-sum .sum').html(resultSum);
            $('.result-sum .number').html(numSelectedServices);

            $(this).parent('.service-card').remove(); // удаление блока с услугой
        });

        $masterBlock.on('click', function () {
            dataRecordObj.hairdresserId = $(this).attr('data-master-id');

            listSelectedMaster.push({
                id: $(this).attr('data-master-id'),
                name: $(this).attr('data-master-name'),
            });

            if (listSelectedMaster.length > 0) {
                $('.text-employee').css({
                    'display': 'block'
                });

                $('.employee-selection').remove();
            }

            $('.selected-master').append('<p>' + listSelectedMaster[0].name + '</p>')

            // Отрисовка доступного времени для записи
            $.ajax({
                type: 'GET',
                url: '/site/index/',
                data: 'id=' + $(this).attr('data-master-id'),

                success: function (data) {
                    let resultObject = JSON.parse(data);

                    for (let value of resultObject) {
                        $('.block-time').append(`<span class="element-time" data-time=${value}>` + value + `</span>`);
                    }
                },

                fail: function () {
                    console.log('error');
                }
            });
        });

        // выбор времени для записи
        $(document).on('click', '.element-time', function () {
            let selectedTime = $(this).attr('data-time');
            dataRecordObj.time = selectedTime;

            $('.selected-time').css('display', 'inline');

            $('.result-time-show').html(selectedTime);
            $('.timing').remove();
        })

        // отправка данных
        $('.model-btn-record').on('click', function (e) {
            e.preventDefault();
            dataRecordObj.date = $('.date-picker #date').val();

            if (dataRecordObj.clientId !== '' && dataRecordObj.hairdresserId !== '' && dataRecordObj.date !== '' &&
                dataRecordObj.serviceId.length !== 0 && dataRecordObj.time !== '') {

                $.ajax({
                    type: 'GET',
                    url: '/site/index/',
                    data: 'record=' + JSON.stringify(dataRecordObj),

                    beforeSend: function () {
                        $('.block-time').html('<p>' + 'Отправка...' + '</p>');
                    },

                    success: function () {
                        $('.content-modal').empty();
                        $('.result-sum').remove();

                        $('.content-modal').append('<p class="success-record">' + 'Запись прошла успешно' + '</p>')
                    },

                    fail: function () {
                        console.log('fail');
                    }
                });
            }
        });

        return {
            center: function () {
                let top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
                let center = ($(window).width() - $modal.width()) / 2;

                $modal.css({
                    'top': top,
                    'left': center,
                });
            },

            show: function (settings) {
                $modal.css({
                    'display': 'block',
                    'width': settings.width,
                    'height': settings.height,
                    'opacity': '1',
                });
                modal.center();
                $(window).on('resize', modal.center);
            },

            close: function () {
                $modal.hide();

                $('html').css('overflow', 'visible');
                $('.bg-main').css('opacity', '0');
            }
        }
    })();
});