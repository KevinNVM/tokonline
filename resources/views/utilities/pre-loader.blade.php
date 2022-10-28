<script defer>
    $(window).on('load', () => {
        $('.loader-container').fadeOut(500);
    })
</script>
<div class="loader-container">
    <div class="lds-hourglass"></div>
</div>
<style>
    .loader-container {
        width: 100%;
        height: 100vh;
        background: linear-gradient(to bottom left, #86efac, #c4ffd9) no-repeat;
        display: grid;
        place-items: center;
        position: absolute;
        z-index: 1000;
        top: 0;
        left: 0;
    }

    .lds-hourglass {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-hourglass:after {
        content: " ";
        display: block;
        border-radius: 50%;
        width: 0;
        height: 0;
        margin: 8px;
        box-sizing: border-box;
        border: 32px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-hourglass 1.2s infinite;
    }

    @keyframes lds-hourglass {
        0% {
            transform: rotate(0);
            animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
        }

        50% {
            transform: rotate(900deg);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        100% {
            transform: rotate(1800deg);
        }
    }
</style>
