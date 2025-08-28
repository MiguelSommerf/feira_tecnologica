document.addEventListener('DOMContentLoaded', function timer() {
    const tempoDeReenvio = 60;
    const horaAtual = Math.floor(Date.now() / 1000);
    let tempoDecorrido = horaAtual - hashcodeTime;
    let tempoRestante = tempoDeReenvio - tempoDecorrido;

    const timerElement = document.getElementById('timerReenvio');
    const reenviarLink = document.getElementById('reenviar');

    function atualizarTimer() {
        if (tempoRestante > 0) {
            reenviarLink.style.pointerEvents = 'none';
            timerElement.textContent = "Reenvie após " + tempoRestante + " segundos";
            tempoRestante--;
        } else {
            reenviarLink.style.pointerEvents = 'auto';
            timerElement.style.display = 'none';
            clearInterval(intervalo);
        }
    }

    const intervalo = setInterval(atualizarTimer, 1000);
});