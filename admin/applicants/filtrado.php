<?php
require 'vendor/autoload.php';
?>

<script>
    function clasificarcvs(palabrasClave, umbral) {
        // Capa de entrada
        let entrada = palabrasClave;

        // Pesos y conexiones de la capa oculta
        let pesos = [
            [0.2, 0.5, -0.1],
            [0.9, -0.4, 0.6],
            [-0.3, 0.8, 0.7]
        ];

        // Capa oculta
        let oculta = [];
        for (let i = 0; i < pesos.length; i++) {
            let sum = 0;
            for (let j = 0; j < entrada.length; j++) {
                sum += entrada[j] * pesos[i][j];
            }
            oculta.push(sigmoid(sum));
        }

        // Pesos y conexiones de la capa de salida
        let pesosSalida = [0.1, -0.2, 0.5];

        // Capa de salida
        let salida = 0;
        for (let i = 0; i < oculta.length; i++) {
            salida += oculta[i] * pesosSalida[i];
        }
        salida = sigmoid(salida);

        // Verificar la salida con el umbral
        if (salida >= umbral) {
            return true;
        } else {
            return false;
        }
    }

    // Función de activación sigmoide
    function sigmoid(x) {
        return 1 / (1 + Math.exp(-x));
    }
</script>