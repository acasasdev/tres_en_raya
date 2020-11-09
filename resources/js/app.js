require('./bootstrap');

const boxes = document.getElementsByClassName("box");
const currentPlayer =  document.getElementById('currentPlayer');
const currentPlayerMsg =  document.getElementById('currentPlayerMsg');
const board =  document.getElementById('board');
let boardId;
let activePlayer = 1;

function startGame() {

    axios.get('/api/createBoard/')
        .then(response => {
            boardId = response.data.id;
            board.setAttribute('data-id',boardId);
            currentPlayer.innerHTML = (activePlayer) + "";
            board.classList.add("startGame");
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

                        }
                        else{
                            currentPlayerMsg.innerHTML = "Gana el jugador "+ (winner + 1);
                        }

                        return;
                    }

                    currentPlayer.innerHTML = (activePlayer === 0 ? 2: 1) + "";
                    board.classList.remove("disabled");

                })
                .catch(error => console.error(error));

        })
        .catch(error => console.error(error));
}

startGame();
