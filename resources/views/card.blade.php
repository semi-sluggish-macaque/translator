<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizlet Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f8f9fa;
    }

    .card-container {
        width: 700px;
        height: 500px;
        perspective: 1000px;
        position: relative;
        margin-bottom: 20px;
    }

    .card {
        width: 100%;
        height: 100%;
        position: absolute;
        transform-style: preserve-3d;
        transition: transform 0.8s;
        cursor: pointer;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .card.flipped {
        transform: rotateY(180deg);
    }

    .card-face {
        width: 100%;
        height: 100%;
        position: absolute;
        backface-visibility: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        padding: 20px;
        box-sizing: border-box;
    }

    .card-face.front {
        background-color: #fff;
    }
    .hide {
        display: none;
    }

    .card-face.back {
        background-color: #007bff;
        color: #fff;
        transform: rotateY(180deg);
    }

    .navigation {
        display: flex;
        justify-content: space-between;
        width: 700px;
    }

    .hidden {
        display: none;
    }
    .transform-in {
        transform: translateY(30px);
        transition: transform 0.3s ease-out;
    }

    .card-container:not(.hidden) .transform-in {
        transform: translateY(0);
    }
    /*.animate__fadeIn {*/
    /*    animation-name: fadeIn;*/
    /*    animation-duration: 1s;*/
    /*    animation-fill-mode: forwards;*/
    /*}*/

    /*@keyframes fadeIn {*/
    /*    from {*/
    /*        opacity: 0;*/
    /*    }*/
    /*    to {*/
    /*        opacity: 1;*/
    /*    }*/
    /*}*/
    @media screen and (max-width: 768px) {
        .card-container {
            width: 400px;
            height: 200px;
            perspective: 1000px;
            position: relative;
            margin-bottom: 20px;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            width: 400px;
        }
    }
</style>
</head>
<body>
<div class="container">
    <h1>Карточки</h1>
    <div class="navigation">
        <button id="prevCard" class="btn btn-secondary">&larr;</button>
        <button id="nextCard" class="btn btn-secondary">&rarr;</button>
    </div>
    @foreach ($data as $index => $item)
        <div class="card-container hidden transform-in" id="card-{{ $index }}">
            <div class="card">
                <div class="card-face front">
                    {{ $item[0] }}
                </div>
                <div class="card-face back">
                    {{ $item[1] }}
                </div>
            </div>
        </div>
    @endforeach
    <div class="mt-4" style="color: gold; ">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.card-container');
        let currentCardIndex = 0;

        function updateCardNavigation() {
            document.getElementById('prevCard').disabled = currentCardIndex === 0;
            document.getElementById('nextCard').disabled = currentCardIndex === cards.length - 1;
        }

        function showCard(index) {
            cards.forEach((card, idx) => {
                if (idx === index) {
                    card.classList.remove('hidden');

                } else {
                    card.classList.add('hidden');
                }
            });
        }

        cards.forEach(card => {
            const cardElement = card.querySelector('.card');
            // const frontElement = card.querySelector('.front');
            // console.log(frontElement);
            // frontElement.addEventListener('click', () => {
            //     frontElement.classList.add('hide');
            // });
            cardElement.addEventListener('click', () => {
                cardElement.classList.toggle('flipped');
            });
        });

        document.getElementById('prevCard').addEventListener('click', () => {
            currentCardIndex--;
            showCard(currentCardIndex);
            updateCardNavigation();
        });

        document.getElementById('nextCard').addEventListener('click', () => {
            currentCardIndex++;
            showCard(currentCardIndex);
            updateCardNavigation();
        });

        showCard(currentCardIndex);
        updateCardNavigation();
    });

</script>
</body>
</html>
