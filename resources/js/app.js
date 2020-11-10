require('./bootstrap');

const boxes = document.getElementsByClassName("box");
const currentPlayer =  document.getElementById('currentPlayer');
const currentPlayerMsg =  document.getElementById('currentPlayerMsg');
const board =  document.getElementById('board');
const playAgain =  document.getElementById('playAgain');
let boardId;
let activePlayer = 1;

function startGame() {

    axios.get('/api/createBoard/')
        .then(response => {
            boardId = response.data.gameBoardId;
            board.setAttribute('data-id',boardId);
            currentPlayer.innerHTML = (activePlayer) + "";
            currentPlayerMsg.classList.add("visible");
            board.classList.add("startGame");

            prepareBoard(response.data.gameBoardLastState);
            Array.from(boxes).forEach(function (element) {
                element.addEventListener('click', playerPlay);
            });

    })
    .catch(error => console.error(error));


}

function playerPlay()  {

    let box = this;
    let mark;
    let boxN;

    board.classList.add("disabled");

    axios.get('/api/getPlayer/'+activePlayer)
        .then(response => {

            activePlayer = response.data;
            boxN = parseInt(box.getAttribute("data-box"));

            if (activePlayer === 0) {
                mark = box.querySelector('.cross');
            } else {
                mark = box.querySelector('.circle');
            }

            mark.classList.add("visible");
            box.classList.add("marked");

            axios.post('/api/saveGameState/', {player: activePlayer, position: boxN, board: boardId })
                .then(response => {

                    let winner = response.data.winner;

                    if(winner >= 0){
                        board.classList.add("hidden");

                        if(winner === 2){
                            currentPlayerMsg.innerHTML = "¡Empate!";
                        }
                        else{
                            currentPlayerMsg.innerHTML = "¡Gana el jugador "+ (winner + 1) +"!";
                        }

                        playAgain.classList.add("visible");

                        return;
                    }

                    currentPlayer.innerHTML = (activePlayer === 0 ? 2: 1) + "";
                    board.classList.remove("disabled");

                })
                .catch(error => console.error(error));

        })
        .catch(error => console.error(error));
}

function prepareBoard(board){

    let mark;

    if(typeof board != null && board.length > 0){

        board.forEach(function (element) {

            let box = document.querySelectorAll('[data-box="'+element.position+'"]');
            box = box[0];

            if (element.player === 0) {
                mark = box.querySelector('.cross');
            } else {
                mark = box.querySelector('.circle');
            }

            mark.classList.add("visible");
            box.classList.add("marked");
        });

        activePlayer = board[(board.length - 1)].player;
        currentPlayer.innerHTML = (activePlayer === 0 ? 2: 1) + "";
    }
}

startGame();
