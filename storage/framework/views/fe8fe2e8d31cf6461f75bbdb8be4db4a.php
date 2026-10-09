




<style type="text/css">
    /* merchandising Modero -------------------------------------  */
    #merchandising .mer {
        position: fixed;
        transition: all .3s ease;
        background-color: #e30613;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 50px;
        border-right: none;
        color: #fff;
        font-weight: 700;
        font-size: 20px;
        bottom: 175px;
        right: 20px;
        border: 0;
        z-index: 9999;
        width: 50px;
        height: 50px;
    }

    #merchandising .mer i {
        margin: 0;
        padding: 0;
    }

    #merchandising .mer:hover {
        transform: scale(1.1);
        background-color: #c00510;
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
        background-color: #e30613;
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
        transition: all .3s ease;
        background-color: #25D366;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 50px;
        border-right: none;
        color: #fff;
        font-weight: 700;
        font-size: 30px;
        bottom: 95px;
        right: 20px;
        border: 0;
        z-index: 9999;
        width: 50px;
        height: 50px;
    }

    #whatsapp .wtsapp:hover {
        transform: scale(1.1);
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
<?php /**PATH D:\laragon\www\globalcpa\resources\views/components/whatsapp.blade.php ENDPATH**/ ?>