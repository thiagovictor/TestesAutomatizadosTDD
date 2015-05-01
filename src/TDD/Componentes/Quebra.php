<?php

namespace TDD\Componentes;

use TDD\Interfaces\ComponenteInterface;

class Quebra implements ComponenteInterface {

    public function render() {
        return "<br>";
    }
}
