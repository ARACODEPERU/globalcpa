<div id="merchandising">
    <a href="{{ route('web_subscriptions') }}" class="mer">
        <i class="fa fa-briefcase" aria-hidden="true"></i>
    </a>
</div>


<div id="whatsapp">
    <a href="https://wa.link/4bu45u" class="wtsapp">
        <i class="fa fa-whatsapp" aria-hidden="true"></i>
    </a>
</div>

<style type="text/css">
    /* merchandising Modero -------------------------------------  */
    #merchandising .mer {
        position: fixed;
        transform: all .5s ease;
        background-color: #6a4c93;
        display: block;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 50px;
        border-right: none;
        color: #fff;
        font-weight: 700;
        font-size: 20px;
        bottom: 130px;
        right: 20px;
        border: 0;
        z-index: 9999;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    #merchandising .mer:before {
        content: "";
        position: absolute;
        z-index: -1;
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(-50%);
        display: block;
        width: 60px;
        height: 60px;
        background-color: #6a4c93;
        border-radius: 50%;
        -webkit-animation: pulse-border 1500ms ease-out infinite;
        animation: pulse-border 1500ms ease-out infinite;
    }

    #merchandising .mer:focus {
        border: none;
        outline: none;
    }

    #whatsapp .wtsapp {
        position: fixed;
        transform: all .5s ease;
        background-color: #25D366;
        display: block;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 50px;
        border-right: none;
        color: #fff;
        font-weight: 700;
        font-size: 30px;
        bottom: 40px;
        right: 20px;
        border: 0;
        z-index: 9999;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    #whatsapp .wtsapp:before {
        content: "";
        position: absolute;
        z-index: -1;
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(-50%);
        display: block;
        width: 60px;
        height: 60px;
        background-color: #25D366;
        border-radius: 50%;
        -webkit-animation: pulse-border 1500ms ease-out infinite;
        animation: pulse-border 1500ms ease-out infinite;
    }

    #whatsapp .wtsapp:focus {
        border: none;
        outline: none;
    }

    @keyframes pulse-border {
        0% {
            transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
            opacity: 1;
        }

        100% {
            transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
            opacity: 0;
        }
    }


    /* NO BORRAR, ES EL SLIDER */
    .slider {
        position: relative;
        overflow: hidden;
    }

    .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slide {
        min-width: 100%;
    }
</style>
