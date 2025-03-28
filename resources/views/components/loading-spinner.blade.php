<div class="loader-wrapper">
    <div class="loader"></div>
</div>

<style>
    .loader-wrapper {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* .loader {
        width: 60px;
        aspect-ratio: 2;
        --_g: no-repeat radial-gradient(circle closest-side, #60a5fa 90%, #0000);
        background:
            var(--_g) 0% 50%,
            var(--_g) 50% 50%,
            var(--_g) 100% 50%;
        background-size: calc(100%/3) 50%;
        animation: l3 1s infinite linear;
    }

    @keyframes l3 {
        20% {
            background-position: 0% 0%, 50% 50%, 100% 50%
        }

        40% {
            background-position: 0% 100%, 50% 0%, 100% 50%
        }

        60% {
            background-position: 0% 50%, 50% 100%, 100% 0%
        }

        80% {
            background-position: 0% 50%, 50% 50%, 100% 100%
        }
    } */

    /* HTML: <div class="loader"></div> */
    .loader {
        height: 15px;
        aspect-ratio: 4;
        --_g: no-repeat radial-gradient(farthest-side, #60a5fa 90%, #0000);
        background:
            var(--_g) left,
            var(--_g) right;
        background-size: 25% 100%;
        display: grid;
    }

    .loader:before,
    .loader:after {
        content: "";
        height: inherit;
        aspect-ratio: 1;
        grid-area: 1/1;
        margin: auto;
        border-radius: 50%;
        transform-origin: -100% 50%;
        background: #60a5fa;
        animation: l49 1s infinite linear;
    }

    .loader:after {
        transform-origin: 200% 50%;
        --s: -1;
        animation-delay: -.5s;
    }

    @keyframes l49 {

        58%,
        100% {
            transform: rotate(calc(var(--s, 1)*1turn))
        }
    }
</style>
