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

    $(window).on('scroll', function () {
        scroll = $(window).scrollTop();

        slideRightBtn(scroll);

        if (document.location.pathname === '/') {
            if (scroll >= 40) {
                return;
            }

            if (scroll <= 1) {
                returnValue($sectionContent, 1);
                // returnValue($returnBg, 1);
            } else {
                animateScale($sectionContent, 400);
                // animateScale($returnBg, 600);
            }
        }
    });

    // обработчик на выполнения скролла top: 0
    $btnTop.on('click', function () {
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
    $(document).on('click', '.record, .record-btn', function (e) {
        e.preventDefault();

        $('.shopping-cart').hide();

        $('body, html').stop(true).animate({
            scrollTop: 0
        }, 400);

        $('html').css('overflow', 'hidden');
        $('.bg-main').css({'opacity': 1, 'z-index': 1});

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
                        $('.block-time').html('<p>' + 'Запись...' + '</p>');
                    },

                    success: function () {
                        $('.content-modal').empty();
                        $('.result-sum').remove();

                        $('.content-modal').append('<p class="success-record">' + 'Запись прошла успешно' + '</p>')
                    },
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
                    'width': settings.width,
                    'height': settings.height,
                });

                modal.center();
                $modal.fadeIn(350);
                $(window).on('resize', modal.center);
            },

            close: function () {
                $modal.fadeOut(350);

                $('.shopping-cart').show();

                $('html').css('overflow', 'visible');
                $('.bg-main').css({'opacity': 0, 'z-index': -1});
            }
        }
    })();

    checkNumberCart();

    function checkNumberCart(total) {
        let productsCart = getProducts();

        if (productsCart['products'].length === 0) {
            $('.shopping-cart').css('display', 'none');
            return false;
        } else {
            $('.shopping-cart').css('display', 'block');
            $('.quantity-in-cart').html(total);
            return true;
        }
    }

    // получение товаров
    function getProducts() {
        return JSON.parse(localStorage.getItem('b-cart'));
    }

    displayProducts();

    function displayProducts() {
        let listProducts = getProducts();

        if (listProducts !== null) {
            $('.modal-cart .order-list').empty();

            for (let product of listProducts.products) {
                $('.modal-cart .order-list').append('<div class="order-item">' +
                    `<img class="image-product-cart" src=${product.img} alt="image">` +
                    '<span class="name-product-cart">' + product.name + '</span>' +
                    '<span class="count-product-cart">' + product.count + '</span>' +
                    '<span class="price-product-cart">' + product.price + ' р.' + '</span>' + '</div>');
            }

            $('.result-sum .sum-products').html(listProducts.amount);
        }
    }

    $('.shopping-cart').on('click', function () {
        $('html').css('overflow', 'hidden');

        $(this).hide();

        modalCart.show({
            width: 650,
            height: 450,
        });
    });

    let modalCart = (function () {
        let $modalCart = $('.modal-cart');
        let $product = $('.add-cart');
        let $orderItem = $('.modal-cart .order-list .order-item');

        $('.modal-cart .close-modal').on('click', function () {
            modalCart.close();
            checkNumberCart();
        });

        if (checkNumberCart()) {
            checkNumberCart(getProducts().total);
        }

        // отрисовка данных с localStorage - b-cart
        checkNumberCart();

        // установка данных в localStorage
        function setProductData(data) {
            localStorage.setItem('b-cart', JSON.stringify(data));
        }

        let cart = getProducts() || {};

        if (cart.products === undefined) {
            cart['amount'] = 0;
            cart['products'] = [];
            cart['total'] = 0;
        }

        $('.modal-cart .clear-cart').on('click', function () {
            // let cartClear = getProducts();

            if (cart !== null) {
                $orderItem.remove();

                cart['products'] = [];
                cart['amount'] = 0;
                cart['total'] = 0;

                setProductData(cart);
                displayProducts();
            }
        });

// обработка по нажатию на товар
        $product.on('click', function () {
            let $parent = $(this).parent('.products-block');

            let idProduct = parseInt($parent.attr('data-id-product'));
            let nameProduct = $parent.children('.name-products').text();
            let priceProduct = parseInt($parent.children('.price').text());
            let imgProduct = $parent.children('.img-product').attr('src');

            if (cart.products !== undefined) {
                for (let currentProduct of cart.products) {
                    if (idProduct === currentProduct.id) {
                        currentProduct.count += 1;
                        currentProduct.amount = currentProduct.price * currentProduct.count;
                        cart.amount += priceProduct;
                        cart.total++;

                        setProductData(cart);
                        checkNumberCart(cart.total);
                        displayProducts();
                        return;
                    }
                }
            }

            cart['products'].push({
                id: parseInt(idProduct),
                name: nameProduct,
                img: imgProduct,
                count: 1,
                price: parseInt(priceProduct),
                amount: parseInt(priceProduct),
            });

            cart.amount += priceProduct;
            cart.total++;

            setProductData(cart);
            checkNumberCart(cart.total);
            displayProducts();
        });

        $('.modal-cart .checkout').on('click', function () {
            let products = getProducts();

            if (products === null) {
                return;
            }

            products.payment = $('.payment-method #cash').val();

            if (products['products'].length !== 0) {
                $.ajax({
                    type: 'POST',
                    url: '/site/products',
                    data: products,

                    success: function (response) {
                        console.log(response);
                    }
                });
            } else {
                alert('Ошибка');
            }
        });

        return {
            center: function () {
                let center = ($(window).width() - $modalCart.width()) / 2;
                let top = (($(window).height() - $modalCart.outerHeight()) / 2) + $(window).scrollTop();

                $modalCart.css({
                    'top': top,
                    'left': center,
                });
            },

            show: function (settings) {
                $modalCart.fadeIn(350);

                $('.bg-main').css({
                    'opacity': 1,
                    'z-index': 1,
                });

                $modalCart.css({
                    'width': settings.width,
                });

                modalCart.center();
                $(window).on('resize', modalCart.center);
            },

            close: function () {
                $modalCart.fadeOut(350);

                $('.shopping-cart').show();

                $('.bg-main').css({
                    'opacity': 0,
                    'z-index': -1,
                });

                $('html').css('overflow', 'visible');
            },
        }
    })
    ();
});