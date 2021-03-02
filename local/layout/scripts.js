//system functions
async function JsonRequest(settings) {
    if (settings.url == null) return null;
    var myUrl = settings.url;
    if (myUrl.slice(0, 4) != 'http') myUrl = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + '/' + settings.url;
    var url = new URL(myUrl);
    var params = settings.params || null;
    if (params) url.search = new URLSearchParams(params);
    var methodName = settings.type || 'GET';
    var sender = settings.sender || null;
    var onResult = settings.onResult || null;
    var onSuccessCallback = settings.onSuccess || null;
    var onErrorCallback = settings.onError || null;
    var sendBody = settings.senddata == null ? (settings.ajaxData || null) : JSON.stringify(settings.senddata);
    var jsonHeaders = settings.headers || { 'Content-Type': 'application/json' };
    var isJson = settings.isJson == null ? true : (settings.isJson || false);
    var data;
    try {
        var response = await fetch(url, { method: methodName, headers: jsonHeaders, body: sendBody });
        if (isJson) data = await response.json();
        else data = await response;
        if (onSuccessCallback) onSuccessCallback(settings, data);
        if (onResult) onResult(settings, data);
        return data;
    } catch (e) {
        if (onResult) onResult(settings, data);
        if (onErrorCallback) onErrorCallback(settings, e);
        else alert('Ошибка выполнения асинхронной операции: ' + e);
    }
}


function createElement(type, id, classList, content) {
    if (typeof(type) === "object" && id == null && classList == null && content == null) return createElementExtended(type);
    var elem = document.createElement(type);
    if (id != null && id.toString().length > 0) elem.setAttribute('id', id);
    var ClassArray = classList != null ? (typeof(classList) === "string" ? classList.split(' ') : classList) : new Array();
    for (var i = 0; i < ClassArray.length; i++) {
        var Class = ClassArray[i].split('.').join('').replace(',', '');
        if (Class != null && Class.length > 0) elem.classList.add(Class);
    }
    if (content) {
        if (typeof(content) == "object") elem.appendChild(content);
        else elem.innerHTML = content;
    }
    return elem;
}


function createElementExtended(settings) {
    var tag = settings.tag || 'div';
    var content = settings.content;
    var id = settings.id || null;
    var classList = settings.class;
    var elem = document.createElement(tag);
    if (id != null && id.toString().length > 0) elem.setAttribute('id', id);
    var ClassArray = classList != null ? (typeof(classList) === "string" ? classList.split(' ') : classList) : new Array();
    for (var i = 0; i < ClassArray.length; i++) {
        var Class = ClassArray[i].split('.').join('').replace(',', '');
        if (Class != null && Class.length > 0) elem.classList.add(Class);
    }
    if (settings.title != null) elem.setAttribute('title', settings.title);
    if (settings.type != null) elem.setAttribute('type', settings.type);
    if (settings.href != null) elem.setAttribute('href', settings.href);
    else if (tag === "a") elem.setAttribute('href', '#')
    if (settings.hidden != null) elem.hidden = settings.hidden;
    if (settings.maxlength != null) elem.setAttribute('maxlength', settings.maxlength);
    if (settings.placeholder != null) elem.setAttribute('placeholder', settings.placeholder);
    if (settings.for != null) elem.setAttribute('for', settings.for);
    if (settings.src != null) elem.setAttribute('src', settings.src);
    if (settings.value != null) elem.setAttribute('value', settings.value);
    if (settings.name != null) elem.setAttribute('name', settings.name);
    if (settings.style) elem.setAttribute('style', settings.style);
    if (content) {
        if (typeof(content) == "object") elem.appendChild(content);
        else elem.innerHTML = content;
    }
    //
    var parent = settings.parent != null ? (typeof(settings.parent) === "string" ? document.getElementById(settings.parent) : settings.parent) : null;
    if (parent != null) parent.appendChild(elem);
    return elem;
}

function adjustOwlProducts() {


    $('.gt-owl-products-tabs').owlCarousel({
        margin: 15,
        loop: true,
        autoWidth: true,
        responsiveClass: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 2,
                margin: 20,
            },
            600: {
                items: 3,
                margin: 25,
            },
            1200: {
                items: 4,
                loop: true,
                margin: 14,
            }
        }
    });
}

function clickTab(e, sender) {
    if (e) e.preventDefault();
    var tabID = sender.getAttribute('data-tab');
    var tab = document.getElementById(tabID);
    if (tab == null) return;

    var menu = sender.parentElement.parentElement;

    menu.childNodes.forEach(function(item, index) {
        if (item.nodeType != 1) return;
        item.classList.remove('active');
    });


    var tabControl = menu.parentElement;


    tabControl.childNodes.forEach(function(item, index) {
        if (item.nodeType != 1) return;
        if (hasClass(item, 'gt-tabcontent') == true) item.classList.remove('active');
    });

    tab.classList.add('active');
    sender.parentElement.classList.add('active');
    adjustOwlProducts();
}



function fn_initJqueyTabControl() {
    $('ul[data-tabmenu=true]').each(function() {
        var tabsClass = $(this).attr('data-tab-class');
        $('.' + tabsClass).css('display', 'none');
        $('.' + tabsClass).first().css('display', '');
    });



    $('ul[data-tabmenu=true] > li').click(function() {
        var id = $(this).attr('data-id') || '';
        if (id == '') return;
        var tabsClass = $(this).parent().attr('data-tab-class');
        $('.' + tabsClass).css('display', 'none');
        $("#" + id).css('display', '');
        $(this).parent().find('li').removeClass('active');
        $(this).addClass('active');
    });


}

function clickCatalogExpand(e, sender) {
    if (e) e.preventDefault();
    var parent = sender.parentElement.parentElement;
    if (hasClass(parent, 'expanded')) {
        parent.classList.remove('expanded');
    } else {
        parent.classList.add('expanded');
    }
}


function adjustRangeSlider(settings) {
    var _min = settings.minValue || 0;
    var _max = settings.maxValue || 0;
    var _id = settings.id;
    var _minObj = '#' + settings.inputMin;
    var _maxObj = '#' + settings.inputMax;
    $("#" + _id).slider({
        range: true,
        min: _min,
        max: _max,
        values: [_min, _max],
        slide: function(event, ui) {
            $(_minObj).val('от: ' + ui.values[0]);
            $(_maxObj).val('до: ' + ui.values[1]);
        }
    });
    if (settings.isAdjustOnInit) {
        $(_minObj).val('от: ' + _min);
        $(_maxObj).val('до: ' + _max);
    }
}

function toggleCatalogFilters(e, isShow, typeID) {
    if (e) e.preventDefault();
    var div = document.getElementById('gt-catalog-filters');
    if (isShow) div.classList.add('expanded');
    else div.classList.remove('expanded');

    var panelName = 'Панель фильтров:';
    if (typeID == 1) panelName = 'Категории:';

    var nameSpan = document.getElementById('gtMobileFilterPanelName');
    if (nameSpan == null) return;
    nameSpan.innerHTML = panelName;
}

class CustomSlider {
    constructor(settings) {
        this.id = settings.id;
        this.parent = settings.parent != null ? (typeof(settings.parent) === "string" ? document.getElementById(settings.parent) : settings.parent) : null;
        this.class = settings.class || '';
        this.args = settings.args || null;
        this.items = settings.items || new Array();
        this.speed = settings.speed || 200;
        this.transitionType = settings.transitionType || 'all';
        this.isShowSliderButtons = settings.isShowSliderButtons || false;
        this.isShowSliderMenu = settings.isShowSliderMenu || false;
        this.adjustMode = settings.adjustMode || false;
        this.isInfiniteCycle = settings.isInfiniteCycle || false;
        this.autoSlideInterval = settings.autoSlideInterval || 0;
        this.contentItems = settings.contentItems || new Array();
        this.contentSettings = settings.contentSettings || new Array();
        //callbacks
        this.onSlideChangeCallback = settings.onSlideChangeCallback || null;
        this.onLoadCallback = settings.onLoadCallback || null;
        //system vars
        this.holder = null;
        this.content = null;
        this.slides = new Array();
        this.slideIndex = -1;
        this.activeSlide = null;
        this.previousSlide = null;
        this.nextSlide = null;
        this.menuHolder = null;
        this.sliderMenu = null;
        this.isInProgress = false;
        this.sliderMenuItems = new Array();
        this.sliderButtonPrev = null;
        this.sliderButtonNext = null;
        this.slideChangeTimeout = null;
        this.slideTransition = 'all 0.2s';
    }

    buildTemplate() {
        if (this.id != null) this.main = document.getElementById(this.id);
        var child = null;
        if (this.main != null && this.parent == null) {
            child = (this.main.firstElementChild || this.main.firstChild);
            if (child == null) return;
            this.holder = child;
            var hasClass = this.hasClass.bind(this);
            if (!hasClass(this.main, 'custom-slider')) this.main.classList.add('custom-slider');
            if (hasClass(child, 'slides') == false) return;

        } else {
            this.main = createElement({ parent: this.parent, id: this.id, class: 'custom-slider ' + this.class });
            this.holder = createElement({ parent: this.main, class: 'slides' });
        }
        this.menuHolder = createElement({ tag: 'div', parent: this.main, class: 'slider-menu' });
        if (this.isShowSliderButtons) {
            this.sliderButtonPrev = createElement({ parent: this.menuHolder, class: 'icon-change prev' });
            this.sliderButtonPrev.addEventListener("click", (e) => this.setPrevSlide());
        }
        if (this.isShowSliderMenu) this.sliderMenu = createElement({ tag: 'ul', parent: this.menuHolder });
        if (this.isShowSliderButtons) {
            this.sliderButtonNext = createElement({ parent: this.menuHolder, class: 'icon-change next' });
            this.sliderButtonNext.addEventListener("click", (e) => this.setNextSlide());
        }
        if (child != null) {
            var append = this.appendSlideArray.bind(this);
            child.childNodes.forEach(function(item, index) {
                if (item.nodeType != 1) return;
                if (hasClass(item, 'slide') == false) item.classList.add('slide');
                append(item);
            });
        }

        if (this.items.length > 0) {
            var addSlide = this.addSlide.bind(this);
            this.items.forEach(function(item, index, array) { addSlide(item) });
        }



        this.buildSlidesByContentItems();
        if (this.autoSlideInterval > 0) this.checkAutoSlideInterval();
        if (this.onLoadCallback) this.onLoadCallback(this, { index: this.slideIndex, slide: this.activeSlide });
        if (this.speed != 200) {
            this.slideTransition = this.transitionType + ' ' + this.speed + 'ms';
        }
    }

    addSlide(settings) {
        var slide = createElement({
            parent: this.holder,
            id: settings.id,
            class: 'slide ' + (settings.class || ''),
            content: settings.content
        });
        this.appendSlideArray(slide);
        if (settings.isAutoOpen) setTimeout(this.toggleSlide.bind(this), 50, 'next'); //, settings
    }

    appendSlideArray(slide) {
        var li = null;
        var index = this.slides.length;
        slide.setAttribute('data-index', index);
        this.slides.push(slide);
        if (this.isShowSliderMenu) {
            li = createElement({ tag: 'li', parent: this.sliderMenu });
            li.addEventListener("click", (e) => this.toggleSlide(index));
            this.sliderMenuItems.push({ index: index, li: li, slide: slide })
        }
        if (this.slideIndex === -1) {
            this.slideIndex = 0;
            this.activeSlide = this.slides[this.slideIndex];
            slide.style.left = '0px';
            if (li != null) li.classList.add('active')
            this.adjustSlider();
        }


    }

    setPrevSlide(settings) {
        if (this.isInProgress == true) return;
        if (this.slideIndex <= 0) {
            if (this.isInfiniteCycle) {
                this.changeSlide((this.slides.length - 1), settings, 'prev');
            }
            return;
        }
        this.changeSlide(this.slideIndex - 1, settings);
    }

    setNextSlide(settings) {
        if (this.isInProgress == true) return;
        if (this.slideIndex >= this.slides.length - 1) {
            if (this.isInfiniteCycle) {
                this.changeSlide(0, settings, 'next');
            }
            return;
        }
        this.changeSlide(this.slideIndex + 1, settings);
    }


    adjustSlider() {
        if (!this.adjustMode) return;
        if (this.activeSlide.childNodes.length == 0) return;
        var childNode = null;
        for (var i = 0; i < this.activeSlide.childNodes.length; i++) {
            if (this.activeSlide.childNodes[i].nodeType == 1) {
                childNode = this.activeSlide.childNodes[i];
                break;
            }
        }
        if (childNode == null) return;
        var H = childNode.offsetHeight || 0;
        if (H == 0) return;
        this.holder.style.height = (H + 70) + 'px';
    }


    setSlideVisible(slide, isVisible, settings) {
        if (settings != null && settings.isRemoveSlide && !isVisible) {
            this.removeSlide(settings.beforeIndex);
        } else {
            slide.style.display = isVisible ? '' : 'none';
        }
    }


    setSliderTogglerEnabled() {
        this.isInProgress = false;
        if (this.autoSlideInterval > 0) this.checkAutoSlideInterval();
    }


    toggleSlide(slide, settings) {
        if (this.isInProgress) return;
        if (typeof(slide === 'string')) {
            switch (slide) {
                case 'next':
                    this.setNextSlide(settings);
                    slide = null;
                    break;

                case 'prev':
                    this.setPrevSlide(settings);
                    slide = null;
                    break;
            }
        }


        if (slide == null) return;
        if (isNaN(slide)) return;
        var index = parseInt(slide) || 0;
        if (index == -1) return;
        this.changeSlide(index, settings);
    }


    changeSlide(index, settings, forcedName) {
        if (this.isInProgress) return;
        if (this.slideIndex == index) return;
        this.isInProgress = true;
        var isPrev = this.slideIndex > index;
        var currentSlide = this.slides[this.slideIndex];
        var nextSlide = this.slides[index];

        if (forcedName === 'prev') {
            isPrev = true;
        } else if (forcedName === 'next') {
            isPrev = false;
        }
        nextSlide.style.transition = 'none'
        nextSlide.style.left = isPrev ? '-100%' : '100%';
        var transition = this.slideTransition;
        if (isPrev) {

            this.setSlideVisible(nextSlide, true);
            setTimeout(function() {
                currentSlide.style.transition = transition;
                currentSlide.style.left = '100%';
                nextSlide.style.transition = transition;
                nextSlide.style.left = '0%'
            }, 50, nextSlide, transition, currentSlide);
            if (settings) settings.beforeIndex = this.slideIndex;
            this.slideIndex = index;
            this.activeSlide = this.slides[this.slideIndex];
            this.previousSlide = ((this.slideIndex - 1) < 0) ? null : this.slides[this.slideIndex - 1];
            this.nextSlide = this.slides[this.slideIndex + 1];

        } else {

            this.setSlideVisible(nextSlide, true);
            setTimeout(function() {
                currentSlide.style.transition = transition;
                currentSlide.style.left = '-100%';
                nextSlide.style.transition = transition;
                nextSlide.style.left = '0%'
            }, 50, nextSlide, transition, currentSlide);
            if (settings) settings.beforeIndex = this.slideIndex;
            this.slideIndex = index;
            this.activeSlide = this.slides[this.slideIndex];
            this.previousSlide = this.slides[this.slideIndex - 1];
            this.nextSlide = (this.slideIndex + 1 >= (this.slides.length - 1)) ? null : this.slides[this.slideIndex + 1];
        }
        if (this.onSlideChangeCallback) this.onSlideChangeCallback(this, { slideIndex: this.slideIndex, slide: this.activeSlide }, this.args);
        setTimeout(this.setSlideVisible.bind(this), this.speed + 10, currentSlide, false, settings);
        this.adjustSlider();

        if (this.sliderMenuItems.length > 0) {
            this.sliderMenuItems.forEach(item => item.li.classList.remove('active'));
            this.sliderMenuItems[index].li.classList.add('active');
        }
        setTimeout(this.setSliderTogglerEnabled.bind(this), this.speed + 50);
    }

    removeSlide(index) {
        var slide = this.slides[index];
        if (slide == null) return;
        slide.remove();
        this.slides.splice(index, 1);
    }


    clearSlidesState(isPrev) {
        for (var i = 0; i < this.slides.length; i++) {
            if (i == this.slideIndex) continue;
            this.slides[i].style.left = isPrev ? '-105%' : '105%';
            this.slides[i].style.display = 'none';
        }
    }





    checkAutoSlideInterval() {
        if (this.slideChangeTimeout != null) clearTimeout(this.slideChangeTimeout);
        this.slideChangeTimeout = setTimeout(this.autoSlideTimeout.bind(this), this.autoSlideInterval);
    }

    autoSlideTimeout() {
        this.setNextSlide();
    }


    addContentItem(settings) {



    }


    buildSlidesByContentItems(isRebuild) {
        if (this.contentItems == null || this.contentItems.length == 0) return;
        if (this.contentSettings == null || this.contentSettings.length == 0) this.contentSettings.push({ minWidth: 0, maxWidth: 10000, count: 0 });
        var myWidth = this.holder.offsetWidth || 0;
        if (myWidth == 0) return;

        var setting = this.contentSettings.find(item => myWidth >= item.minWidth && myWidth <= item.maxWidth);
        if (setting == null || setting.length == 0) return;
        var itemsOnSlide = setting.count || 0;
        var content = '';
        var count = 0;
        for (var i = 0; i < this.contentItems.length; i++) {
            count++;
            var c = this.contentItems[i].content;
            content += (typeof(c) == "object" ? c.innerHTML : c);
            if (count == itemsOnSlide) {
                this.addSlide({ content: content });
                content = '';
                count = 0;
            }
        }

        if (count > 0) {
            this.addSlide({ content: content });
        }


        //console.log('content width: ', myWidth);
    }

    clear() {
        this.holder.innerHTML = '';
        this.slides = new Array();
        this.slideIndex = -1;
        this.activeSlide = null;
        this.previousSlide = null;
        this.nextSlide = null;
        this.menuHolder = null;
        this.isInProgress = false;
        this.sliderMenuItems = new Array();
        if (this.slideChangeTimeout != null) clearTimeout(this.slideChangeTimeout);
    }

    hasClass(ObjID, name) {
        let element = typeof(FillElementID) === "string" ? document.getElementById(ObjID) : ObjID;
        if (element === null) return false;
        var arr = element.className.split(" ");
        if (arr.indexOf(name) == -1) {
            return false;
        }
        return true;
    }
}

function hasClass(ObjID, name) {
    let element = typeof(FillElementID) === "string" ? document.getElementById(ObjID) : ObjID;
    if (element === null) return false;
    var arr = element.className.split(" ");
    if (arr.indexOf(name) == -1) {
        return false;
    }
    return true;
}