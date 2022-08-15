<div class="hotline-phone-2">
    <div class="hotline-phone-ring-wrap">
        <div class="hotline-phone-ring">
            <div class="quick-alo-ph-circle"></div>
            <div class="quick-alo-ph-circle-fill"></div>
            <div class="quick-alo-ph-img-circle">
                <a href="tel:" class="pps-btn-img">
                    <img src="https://kiempt.gcodemo.com/icon-phone2.png" alt="Số điện thoại" width="50">
                </a>
            </div>
        </div>
        <div class="hotline-bar d-none d-md-block">
            <a href="tel:<?php dynamic_sidebar('sidebar-1') ?>">
                <span class="text-hotline"><?php dynamic_sidebar('sidebar-1') ?></span>
            </a>
        </div>
    </div>
    <div class="alo-floating alo-floating-zalo">
        <a title="Chat Zalo" rel="nofollow" target="_blank" href="https://zalo.me/<?php dynamic_sidebar('sidebar-1') ?>"><strong>Chat Zalo</strong></a>
    </div>
</div>


<style type="text/css">
    @-webkit-keyframes quick-alo-circle-anim {
        0% {
            -webkit-transform: rotate(0) scale(.5) skew(1deg);
            -webkit-opacity: .1;
        }
        30% {
            -webkit-transform: rotate(0) scale(.7) skew(1deg);
            -webkit-opacity: .5;
        }
        100% {
            -webkit-transform: rotate(0) scale(1) skew(1deg);
            -webkit-opacity: .1;
        }
    }
    @-o-keyframes quick-alo-circle-anim {
        0% {
            -o-transform: rotate(0) scale(.5) skew(1deg);
            -o-opacity: .1;
        }
        30% {
            -o-transform: rotate(0) scale(.7) skew(1deg);
            -o-opacity: .5;
        }
        100% {
            -o-transform: rotate(0) scale(1) skew(1deg);
            -o-opacity: .1;
        }
    }
    @-moz-keyframes quick-alo-circle-fill-anim {
        0% {
            -moz-transform: rotate(0) scale(.7) skew(1deg);
            opacity: .2;
        }
        50% {
            -moz-transform: rotate(0) -moz-scale(1) skew(1deg);
            opacity: .2;
        }
        100% {
            -moz-transform: rotate(0) scale(.7) skew(1deg);
            opacity: .2;
        }
    }
    @-webkit-keyframes quick-alo-circle-fill-anim {
        0% {
            -webkit-transform: rotate(0) scale(.7) skew(1deg);
            opacity: .2;
        }
        50% {
            -webkit-transform: rotate(0) scale(1) skew(1deg);
            opacity: .2;
        }
        100% {
            -webkit-transform: rotate(0) scale(.7) skew(1deg);
            opacity: .2;
        }
    }
    @-o-keyframes quick-alo-circle-fill-anim {
        0% {
            -o-transform: rotate(0) scale(.7) skew(1deg);
            opacity: .2;
        }
        50% {
            -o-transform: rotate(0) scale(1) skew(1deg);
            opacity: .2;
        }
        100% {
            -o-transform: rotate(0) scale(.7) skew(1deg);
            opacity: .2;
        }
    }
    @-moz-keyframes quick-alo-circle-img-anim {
        0% {
            transform: rotate(0) scale(1) skew(1deg);
        }
        10% {
            -moz-transform: rotate(-25deg) scale(1) skew(1deg);
        }
        20% {
            -moz-transform: rotate(25deg) scale(1) skew(1deg);
        }
        30% {
            -moz-transform: rotate(-25deg) scale(1) skew(1deg);
        }
        40% {
            -moz-transform: rotate(25deg) scale(1) skew(1deg);
        }
        50% {
            -moz-transform: rotate(0) scale(1) skew(1deg);
        }
        100% {
            -moz-transform: rotate(0) scale(1) skew(1deg);
        }
    }
    @-webkit-keyframes quick-alo-circle-img-anim {
        0% {
            transform: rotate(0) scale(1) skew(1deg);
        }
        10% {
            -webkit-transform: rotate(-25deg) scale(1) skew(1deg);
        }
        20% {
            -webkit-transform: rotate(25deg) scale(1) skew(1deg);
        }
        30% {
            -webkit-transform: rotate(-25deg) scale(1) skew(1deg);
        }
        40% {
            -webkit-transform: rotate(25deg) scale(1) skew(1deg);
        }
        50% {
            -webkit-transform: rotate(0) scale(1) skew(1deg);
        }
        100% {
            -webkit-transform: rotate(0) scale(1) skew(1deg);
        }
    }
    @-o-keyframes quick-alo-circle-img-anim {
        0% {
            transform: rotate(0) scale(1) skew(1deg);
        }
        10% {
            -o-transform: rotate(-25deg) scale(1) skew(1deg);
        }
        20% {
            -o-transform: rotate(25deg) scale(1) skew(1deg);
        }
        30% {
            -o-transform: rotate(-25deg) scale(1) skew(1deg);
        }
        40% {
            -o-transform: rotate(25deg) scale(1) skew(1deg);
        }
        50% {
            -o-transform: rotate(0) scale(1) skew(1deg);
        }
        100% {
            -o-transform: rotate(0) scale(1) skew(1deg);
        }
    }
    @keyframes quick-alo-circle-img-anim {
        0% {
            transform: rotate(0) scale(1) skew(1deg);
        }
        10% {
            transform: rotate(-25deg) scale(1) skew(1deg);
        }
        20% {
            transform: rotate(25deg) scale(1) skew(1deg);
        }
        30% {
            transform: rotate(-25deg) scale(1) skew(1deg);
        }
        40% {
            transform: rotate(25deg) scale(1) skew(1deg);
        }
        50% {
            transform: rotate(0) scale(1) skew(1deg);
        }
        100% {
            transform: rotate(0) scale(1) skew(1deg);
        }
    }

    /* Style 1 */
    .quick-alo-phone {
        position: fixed;
        visibility: hidden;
        background-color: transparent;
        width: 200px;
        height: 200px;
        cursor: pointer;
        z-index: 200000 !important;
        -webkit-backface-visibility: hidden;
        -webkit-transform: translateZ(0);
        -webkit-transition: visibility .5s;
        -moz-transition: visibility .5s;
        -o-transition: visibility .5s;
        transition: visibility .5s;
        bottom: 20%;
        left: -10px;
    }
    .quick-alo-phone.quick-alo-hover,
    .quick-alo-phone:hover {
        opacity: 1;
    }
    .quick-alo-phone.quick-alo-show {
        visibility: visible;
    }
    .quick-alo-phone.quick-alo-green .quick-alo-ph-circle {
        border-color: #00aff2;
        opacity: .5;
    }
    .quick-alo-ph-circle {
        width: 160px;
        height: 160px;
        top: 20px;
        left: 20px;
        position: absolute;
        background-color: transparent;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid rgba(30, 30, 30, 0.4);
        opacity: .1;
        -webkit-animation: quick-alo-circle-anim 1.2s infinite ease-in-out;
        -moz-animation: quick-alo-circle-anim 1.2s infinite ease-in-out;
        -ms-animation: quick-alo-circle-anim 1.2s infinite ease-in-out;
        -o-animation: quick-alo-circle-anim 1.2s infinite ease-in-out;
        animation: quick-alo-circle-anim 1.2s infinite ease-in-out;
        -webkit-transition: all .5s;
        -moz-transition: all .5s;
        -o-transition: all .5s;
        transition: all .5s;
        -webkit-transform-origin: 50% 50%;
        -moz-transform-origin: 50% 50%;
        -ms-transform-origin: 50% 50%;
        -o-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
    }
    .quick-alo-ph-circle-fill {
        width: 100px;
        height: 100px;
        top: 50px;
        left: 50px;
        position: absolute;
        background-color: #000;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid transparent;
        opacity: .1;
        -webkit-animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
        -moz-animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
        -ms-animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
        -o-animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
        animation: quick-alo-circle-fill-anim 2.3s infinite ease-in-out;
        -webkit-transition: all .5s;
        -moz-transition: all .5s;
        -o-transition: all .5s;
        transition: all .5s;
        -webkit-transform-origin: 50% 50%;
        -moz-transform-origin: 50% 50%;
        -ms-transform-origin: 50% 50%;
        -o-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
    }
    .quick-alo-phone.quick-alo-green .quick-alo-ph-circle-fill {
        background-color: rgba(51, 122, 83, 0.7);
        opacity: .75 !important;
    }
    .quick-alo-phone.quick-alo-green .quick-alo-ph-img-circle {
        background-color: #00aff2;
    }
    .quick-alo-ph-img-circle {
        width: 60px;
        height: 60px;
        top: 70px;
        left: 70px;
        position: absolute;
        background: rgba(30, 30, 30, 0.1) url(https://kiempt.gcodemo.com/icon-phone.png) no-repeat center center;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid transparent;
        opacity: .7;
        -webkit-animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
        -moz-animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
        -ms-animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
        -o-animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
        animation: quick-alo-circle-img-anim 1s infinite ease-in-out;
        -webkit-transform-origin: 50% 50%;
        -moz-transform-origin: 50% 50%;
        -ms-transform-origin: 50% 50%;
        -o-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
    }
    .quick-alo-phone.quick-alo-green.quick-alo-hover .quick-alo-ph-circle-fill,
    .quick-alo-phone.quick-alo-green:hover .quick-alo-ph-circle-fill {
        background-color: rgba(51, 122, 83, 0.7);
        opacity: .75 !important;
    }
    .quick-alo-phone.quick-alo-green.quick-alo-hover .quick-alo-ph-img-circle,
    .quick-alo-phone.quick-alo-green:hover .quick-alo-ph-img-circle {
        background-color: #75eb50;
    }
    .quick-alo-phone.quick-alo-green.quick-alo-hover .quick-alo-ph-circle,
    .quick-alo-phone.quick-alo-green:hover .quick-alo-ph-circle {
        border-color: #75eb50;
        opacity: .5;
    }
    .phone_text {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        background: #ffe800;
        color: #000;
        padding: 2px 9px;
        border-radius: 4px;
        white-space: nowrap;
    }
    .alo-floating {
        display: block;
        left: 10px;
        bottom: 10px;
        position: fixed;
        z-index: 9999;
        text-align: center;
        height: 40px;
        line-height: 40px;
        font-size: 14px;
        text-shadow: 1px 1px 0 #000;
        border-radius: 40px;
        cursor: pointer;
        padding-right: 5px;
        max-width: 250px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        background: #e42222;
        padding: 0 10px;
    }
    .alo-floating a {
        color: #FFF;
    }
    .alo-floating-zalo {
        bottom: 60px;
        padding-left: 45px;
        background: url(https://kiempt.gcodemo.com/icon-zalo.png) 8px center no-repeat, #009dff;
        background-size: 30px auto;
    }

    /* Style 2 */
    .hotline-phone-ring-wrap {
        position: fixed;
        bottom: 0;
        left: 0;
        z-index: 999999;
    }
    .hotline-phone-ring {
        position: relative;
        visibility: visible;
        background-color: transparent;
        width: 110px;
        height: 110px;
        cursor: pointer;
        z-index: 11;
        -webkit-backface-visibility: hidden;
        -webkit-transform: translateZ(0);
        transition: visibility .5s;
        left: 0;
        bottom: 0;
        display: block;
    }
    .hotline-bar {
        position: absolute;
        background: #EA2700;
        height: 45px;
        white-space: nowrap;
        line-height: 40px;
        border-radius: 3px;
        padding: 0 10px;
        background-size: 100%;
        cursor: pointer;
        transition: all 0.8s;
        -webkit-transition: all 0.8s;
        z-index: 9;
        border-radius: 50px !important;
        left: 42px;
        bottom: 31px;
    }
    .hotline-bar > a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        text-indent: 32px;
        letter-spacing: 1px;
        display: block;
        line-height: 45px;
    }
    .hotline-bar > a:hover,
    .hotline-bar > a:active {
        color: #fff;
    }
    .hotline-phone-2 .quick-alo-ph-circle {
        top: 0;
        left: 0;
        width: 110px;
        height: 110px;
    }
    .hotline-phone-2 .quick-alo-ph-circle-fill {
        top: 16px;
        left: 16px;
        width: 80px;
        height: 80px;
        background: rgba(51, 122, 83, 0.7);
    }
    .hotline-phone-2 .quick-alo-ph-img-circle {
        top: 31px;
        left: 31px;
        width: 50px;
        height: 50px;
        background: #EA2700;
        opacity: 1;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hotline-phone-2 .quick-alo-ph-img-circle .pps-btn-img {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
    }
    .hotline-phone-2 .quick-alo-ph-img-circle .pps-btn-img img {
        width: 33px;
        height: 33px;
    }
    .hotline-phone-2 .alo-floating-zalo {
        bottom: 120px;
        left: 30px;
    }
</style>