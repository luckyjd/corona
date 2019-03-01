// $('.product-5-point').syncHeight();
// $('.product-1-point').syncHeight();


function mainVisualAnm() {
    var d = this;
    var b = "";
    var a = "";
    var e = "";
    var c = "";
    if (isMobile()) {
        return true;
    }

    $(window).on("scroll resize onMaximize onMinimize", function () {
        b = $(".js-first-section").innerHeight();
        a = $(window).scrollTop();
        var f = $(".js-bg");
        if ((b - a * 1.8) / b >= 0.1) {
            e = (b - a * 1.8) / b
        } else {
            e = 0.1
        }
        if ((b - a / 3) / b > 0.83) {
            c = (b - a / 3) / b
        } else {
            c = 0.83
        }
        f.css({
            opacity: e,
            "-mos-transform": "scale(" + c * 1 + ")",
            "-webkit-transform": "scale(" + c * 1 + ")",
            transform: "scale(" + c * 1 + ")"
        })
    })
};
mainVisualAnm();