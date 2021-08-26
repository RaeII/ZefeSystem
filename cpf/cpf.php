
<?php

    function verificarCpf($cpf)
    {

        if (strlen($cpf) == 11) {
            $soma = 0;
            $a = $cpf;

            for ($i = 0; $i < 11; $i++) {
                $soma += $cpf[$i];
                $x[$i] = $cpf[$i];
                
            }

            $dig1 = ((string)abs($soma))[0];
            $dig2 = ((string)abs($soma))[1];

            if (count(array_unique($x)) > 1) {
                if ($dig1 == $dig2) {
                    return $a;
                } else {return false;}
            }else{return false;}
        } else {return false;}
    }
?>